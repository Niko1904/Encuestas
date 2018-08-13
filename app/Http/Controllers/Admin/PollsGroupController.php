<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poll;
use App\Category;
use App\AplicationPoll;
use App\Question;
use App\Answer;
use App\Range;


class PollsGroupController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        //
    }

 
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {

        //dd($request);
        //dd($request->all());
        //$questions =App\Questions::table('questions');
        //$questions= DB::table('questions')->get();

        $letras = ['a','b','c','d'];
        $i = 0;
        $c = 0;
        $salir = false;
        $array = $request->input('grupo');
        //dd($request->all());
        //*************************************
        foreach ($array  as $key => $a) {
           foreach ($a as $key_1 => $aa) {
                if(isset($aa)) $c++;
           }
        }
        
        //if($c==0) return;
        // Verificar que el grupo de preguntas sea de 4
        if(!($c % 4) == 0){
           return response()->json(['mensaje' => 'Error..., Cada Pregunta debe de tener cuatro(4) subpreguntas' ], 422);
        }
        //*************************************
        
        DB::beginTransaction();
        try {
          //DB::table('questions')->where('poll_id','=',$request->input('poll_id'))->delete();
            foreach ($array  as $key => $a) {
                foreach ($a as $key_1 => $aa) {
                    $questions = new Question();
                    $buscar = Question::where('group_name','=',$letras[$key_1])
                              ->where('group_number','=',$key)->first();

                    if ((isset($aa)) && ($buscar == null)){
                        $questions->name = $aa;
                        $questions->poll_id = $request->input('poll_id');
                        $questions->multiple_answers = 1;
                        $questions->group_name = $letras[$key_1];
                        $questions->group_number = $key;
                        $questions->save();
                        $c++;
                    }else{
                        $buscar->name = $aa;
                        $buscar->save();
                    }
                    DB::commit();
                    // if (!isset($aa)){
                    //    DB::rollback();
                    //    $salir = true;
                    //    break;
                    // }
                } // foreach interno
                
            }// foreach principal
            
        } catch (\Exception $e) {
             $success = false;
             $error = $e->getMessage();
             DB::rollback();
        }

        return response()->json(['mensaje' => 'Exito..., asd' ], 200);
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id,$hay_registros)
    {
        $categories = Category::all();
        $poll = Poll::findOrFail($id);
        $questions = Question::where('poll_id', '=', $id)->get();
        $groups_numbers = (Question::where('poll_id', '=', $id)->count()) / 4;
        //dd($groups_numbers);
        if ( $groups_numbers == 0 ) { $groups_numbers = "x"; }
        $letras = ['a','b','c','d'];
        
        return view('admin.polls_group.edit',compact('poll', 'categories', 'questions', 
                    'groups_numbers','letras','hay_registros'));
    }

    public function add( $count, $poll_id)
    {
        
        $poll = Poll::find($poll_id);
        $questions= DB::table('questions')
                   ->where('poll_id','=',$poll_id);

        $hay_registros = false;
        if (!$questions == null){
           $hay_registros = 1;
        }

        return redirect()->route('polls-group.edit', ['id' => $poll_id,'hay_registros' =>$hay_registros]);
    }

  
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
