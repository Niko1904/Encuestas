<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\GeneralDefinitions;

class GeneralDefinitionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){

        $generaldefinitions = GeneralDefinitions::all();
        
        $puede_crear = GeneralDefinitions::where('id', '>', 0)->first();
    	
    	return view('admin.general_definitions.index',compact('generaldefinitions', 'puede_crear'));
    }

    public function create()
    {
        return view('admin.general_definitions.create');
        
    }

   
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'required' ]);

        $store = GeneralDefinitions::create($request->all());

        Session::flash('message', 'Informacion Agregada!');
        
        Session::flash('status', 'success');

        return redirect('admin/general_definitions');

    }

    public function edit($id)
    {
        $generaldefinitions = GeneralDefinitions::findOrFail($id);
               
        return view('admin.general_definitions.edit',compact('generaldefinitions'));
    }

    public function update(Request $request, $id)
    {
                
        $generaldefinitions = GeneralDefinitions::findOrFail($request->id);
                               
        $this->validate($request, ['name' => 'required', 'description' => 'required' ]);

        $generaldefinitions->update($request->all());

        Session::flash('message', 'Informacion actualizada!');

        Session::flash('status', 'success');

        return redirect('admin/general_definitions');
    }

    public function destroy($id)
    {
        
        $generaldefinitions = GeneralDefinitions::find($id);

        $generaldefinitions->delete();

        Session::flash('message', 'Informacion eliminada!');

        Session::flash('status', 'success');
         
        return redirect('admin/general_definitions');

    }

}
