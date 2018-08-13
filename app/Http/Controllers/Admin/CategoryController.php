<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\AplicationPoll;
use App\Poll;
use App\Range;
use App\Resume;
use App\MasterAplication;

class CategoryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

   
    public function create()
    {
        return view('admin.categories.create');
        
    }

   
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['name' => 'required', 'pausable' => 'required' ]);

        $store = Category::create($request->all());

        Session::flash('message', 'Categoria guardada!');
        Session::flash('status', 'success');

        return redirect('admin/categories');

    }

  
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //en caso de no poder editar y/o eliminar
        $encuestas = Poll::where('category_id', '=', $id)->get();
        //dd($encuestas);
        foreach ($encuestas as $encuesta) {
            $encuestas_aplicadas = AplicationPoll::where('poll_id', '=', $encuesta->id)->first();
            if (! $encuestas_aplicadas == null) {
                return redirect()->back()->with('message', 'Debido a que hay encuestas pendientes relacionadas a esta categoria, no puedes editar o eliminar!');
            }
        }
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));

    }

    
    public function update(Request $request, $id)
    {
        //dd($request->all());
        //en caso de no poder editar y/o eliminar
        $encuestas = Poll::where('category_id', '=', $request->id)->get();
        //dd($encuestas);
        foreach ($encuestas as $encuesta) {
            $encuestas_aplicadas = AplicationPoll::where('poll_id', '=', $encuesta->id)->first();
            if (! $encuestas_aplicadas == null) {
                return redirect()->back()->with('message', 'Debido a que hay encuestas pendientes relacionadas a esta categoria, no puedes editar!');
            }
        }
       
        $this->validate($request, ['name' => 'required', 'pausable' => 'required' ]);

        $categories = Category::findOrFail($id);
        $categories->update($request->all());

        Session::flash('message', 'Categoria actualizada!');
        Session::flash('status', 'success');

        return redirect('admin/categories');
    }

   
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        //en caso de no poder editar y/o eliminar
        $encuestas = Poll::where('category_id', '=', $id)->get();
        //dd($encuestas);
        foreach ($encuestas as $encuesta) {
            $encuestas_aplicadas = AplicationPoll::where('poll_id', '=', $encuesta->id)->first();
            if (! $encuestas_aplicadas == null) {
                return redirect()->back()->with('message', 'Debido a que hay encuestas pendientes relacionadas a esta categoria, no puedes editar o eliminar!');
            }
        }

        $categories->delete();

        Session::flash('message', 'Categoria eliminada');
        Session::flash('status', 'success');

        return redirect('admin/categories');
    }
}
