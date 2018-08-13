<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Question;
use App\Answer;
use App\AplicationPoll;
use Session;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AnswerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        //
    }

    
    public function create(Request $request)
    {
        //dd($request->all());
        $poll = Poll::find($request->poll_id);
        $question = Question::find($request->question_id);
        return view('admin.answers.create', compact('poll', 'question'));
        
    }

    
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['name' => 'required' ]);

        $answer = Answer::create($request->all());

        Session::flash('message', 'answer added!');
        Session::flash('status', 'success');

        $poll = Poll::find($request->poll_id);
        $questions = Question::where('poll_id', '=', $request->poll_id)
             ->get();
        //return view('admin.questions.index',compact('poll', 'questions'));
        return redirect()->route('questions.show', ['id' => $request->poll_id]);
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }

    public function guardar(Request $request, $id)
    {
        //validar que los valores del rango no sean <=0
        if (intval($request->value) < 0){
            exit(json_encode([
                's'         => 'n', 
                'msj'       => 'Valor no pueder ser menor a cero (0)'
            ]));
        }

        $valor_anterior = 0;
        $valor_anterior = DB::table('answers')->max('Value');
                   
        // El valor debe ser mayor al ultimo id de las preguntas de la encuesta (Answers)
        /* if (intval($request->value) <= $valor_anterior) {
           exit(json_encode([
              's'         => 'n', 
              'msj'       => 'Valor de la pregunta debe ser mayor que el valor anterior de la ultima respuesta...'
           ]));
        } */

        $this->validate($request, ['name' => 'required' ]);

        $answer = Answer::create($request->all());

        exit(json_encode([
            's'         => 's', 
            'msj'       => 'Respuesta agregada satisfactoriamente',
            'respuesta' => $answer
        ]));
    }
    

    public function eliminar(Request $request, $id)
    {
        $answer = AplicationPoll::where('answer_id', '=', $id)->first();
        $salida = array("s" => "n", "msj" => "Al menos un usuario ha utilizado esta respuesta, no se ha podido eliminar");

        if(!is_object($answer)){
            Answer::where('id', '=', $id)->delete();
            $salida = array("s" => "s", "msj" => "Respuesta Eliminada Satisfactoriamente");
        }

        exit(json_encode($salida));
    }
}
