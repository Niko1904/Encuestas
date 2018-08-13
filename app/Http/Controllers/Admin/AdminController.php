<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AplicationPoll;
use App\Admin;
use App\Answer;
use App\Category;
use App\DetailAplication;
use App\MasterAplication;
use App\Range;
use App\Resume;
use App\Poll;
use App\Poll_User;
use App\Question;
use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

   
    public function index()
    {
        if ( Auth::user()->level > 1){
           
            Session::flash('message', 'no tienes acceso!');
            Session::flash('status', 'success');
            return redirect('admin/polls');
        }
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    
    public function create()
    {
        
        return view('admin.admins.create');
    }

   
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password',
            'level' => 'required',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->level = $request->level;

        $admin->save();     
        Session::flash('message', 'Usuario guardado!');
        Session::flash('status', 'success');
        return redirect('admin/admins');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
  
    }

    
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password',
            'level' => 'required',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $admin->email;
        $admin->password = bcrypt($request->password);
        $admin->level = $request->level;

        $admin->save();

        Session::flash('message', 'Usuario actualizado!');
        Session::flash('status', 'success');

        return redirect('admin/admins');
    }


    public function perfil()
    {
        $id = Auth::user()->id;
        $admin = Admin::find($id);
       
        return view('admin.admins.profile', compact('admin'));
    }

   
    public function destroy($id)
    {
        //return $id;
        $admin = Admin::find($id);
        $admin->delete();
        Session::flash('message', 'usuario eliminado con exito!');
        Session::flash('status', 'success');
        return redirect('/admin/admins');
    }

    public function perfilUpdate(Request $request)
    {
         $this->validate($request, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            /* 'email' => 'required|string|email|max:255|unique:users', */
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password',
            /* 'type' => 'required', */
            'picture' => 'required',

            'dni' => 'required',
            'country' => 'required',
            'province' => 'required',
        ]);

        $id = Auth::user()->id;
        $admin = Admin::find($id);
        // picture
        $files = Input::file('picture');
        if(!file_exists(public_path() . '/admin/admins/images')){
            mkdir(public_path() . '/admin/admins/images',0777);
        }
        $destinationPath = public_path() . '/admin/admins/images'; // upload folder in public directory
        $now = new DateTime();
        $timestring = $now->format('s');
        $picture = $timestring . $files->getClientOriginalName();
        $img = Image::make($files->getRealPath());
        //$img->resize(320, 240);
        $img->save( public_path() . '/admin/admins/images/'. $picture );

        $admin->picture = '/admin/admins/images/' . $picture;

        $admin->name = $request->name;
        $admin->lastname = $request->lastname;
        //$admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->dni = $request->dni;
        $admin->type = $request->type;
        $admin->pais_id = $request->pais_id;
        $admin->provincia_id = $request->provincia_id;
        $admin->type = $request->type;
        $admin->save();

        return view('admin.admins.profile', compact('admin'));
    }

}
