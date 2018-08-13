<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Poll;
use App\Question;
use App\Answer;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
    public function index(Request $request)
    {
       //  esto debe ir en el metodo show, se debe cambiar el enlace en el index de encuestas
       /*$poll = Poll::find($request->poll_id);
       $questions = Question::where('poll_id', '=', $request->poll_id)
            ->get();
        deberi ir un return redirect toroute questions index con un id en el req 
       return view('admin.questions.index',compact('poll', 'questions')*/
    }

    
    public function create(Request $request)
    {
        $poll = Poll::find($request->poll_id);
        return view('admin.questions.create', compact('poll'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['name' => 'required' ]);
        
        $poll = Poll::find($request->poll_id);

        $question = Question::create($request->all());

        //verificar si a la encuesta se le deben agregar respuestas automaticamente
        if ($poll->category->answers_yes_or_not) {
            $answer_yes = new Answer([
                'name' => 'Si',
                'value' => 1,
                'question_id' => $question->id,
                'poll_id' => $poll->id
            ]);
            $answer_not = new Answer([
                'name' => 'No',
                'value' => 0,
                'question_id' => $question->id,
                'poll_id' => $poll->id
            ]);
        }


        Session::flash('message', 'Pregunta guardada!');
        Session::flash('status', 'success');

        $questions = Question::where('poll_id', '=', $request->poll_id)
             ->get();
        //deberi ir un return redirect toroute questions index con un id en el req 

        //return view('admin.questions.index',compact('poll', 'questions'));
        return redirect()->route('questions.show', ['id' => $request->poll_id]);
             

    }
    

    public function show($id)
    {
        //dd($request->all());
        $poll = Poll::find($id);
        $questions = Question::where('poll_id', '=', $id)
             ->get();
         //deberi ir un return redirect toroute questions index con un id en el req 
        //return redirect()->route('questions.show', ['id' => $id]);
        return view('admin.questions.index', compact('poll', 'questions'));

    }

    
    public function edit($id)
    {
        $question = Question::find($id);
        //dd($question);
        return view('admin.questions.edit', compact('question'));
    }

    
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, ['name' => 'required' ]);

        $question = Question::findOrFail($id);
        $question->update($request->all());

        Session::flash('message', 'Pregunta actualizada!');
        Session::flash('status', 'success');

        $poll = Poll::find($request->poll_id);
        $questions = Question::where('poll_id', '=', $request->poll_id)
             ->get();
        //deberi ir un return redirect toroute questions index con un id en el req 

        return view('admin.questions.index',compact('poll', 'questions'));
    }

    
    public function destroy($id)
    {
        $categories = Category::all();
        $question = Question::findOrFail($id);
        $poll = Poll::find($question->poll_id);

        $question->delete();

        Session::flash('message', 'question deleted!');
        Session::flash('status', 'success');

        $questions = Question::where('poll_id', '=', $poll->id)->get();

        return redirect('admin/polls/'.$poll->id.'/edit');

        //return view('admin.polls'.$poll->id.'/edit', compact('poll', 'questions'));
    }

    public function showquestions($id)
    {
        //return $id;
        $encuesta = Poll::find($id);
        $preguntas = Question::where('poll_id', '=', $encuesta->id)
            ->get();
        
        return view('admin.questions.create', compact('encuesta', 'preguntas'));
        
    }

    public function createquestion(Request $request){
        return $request->all();
        //dd( $request->all());
        $rules = array (
                    'name' => 'required'
            );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $data = new Question ();
            $data->name = $request->name;
            $data->poll_id = $request->poll_id;
            $data->save ();

            $poll = Poll::find($request->poll_id);
            //verificar si a la encuesta se le deben agregar respuestas automaticamente
            if ($poll->category->answers_yes_or_not) {
                $answer_yes = new Answer([
                    'name' => 'Si',
                    'value' => 1,
                    'question_id' => $data->id,
                    'poll_id' => $request->poll_id
                ]);
                $answer_not = new Answer([
                    'name' => 'No',
                    'value' => 0,
                    'question_id' => $data->id,
                    'poll_id' => $request->poll_id
                ]);
            }
            return response ()->json ( $data );
        }
    }

    public function deletequestion(Request $request)
    {
        Question::where('id', $request->id)->delete();
        return $request->all();
    }

    public function updatequestion(Request $request)
    {
        $question = Question::find($request->id);
        $question->name = $request->name;
        $question->save();
        
        return $request->all();
    }
    
    
    
    public function createanswer(Request $request){
        //return $request->all();
        //dd( $request->all());
        $rules = array (
                    'name' => 'required',
                    'value' => 'required'
            );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $data = new Answer ();
            $data->name = $request->name;
            $data->value = $request->value;
            $data->question_id = $request->question_id;
            $data->poll_id = $request->poll_id;
            $data->save ();
            return response ()->json ( $data );
        }
    }

    public function deleteanswer(Request $request)
    {
        Question::where('id', $request->id)->delete();
        return $request->all();
    }

    public function updateanswer(Request $request)
    {
        $question = Question::find($request->id);
        $question->name = $request->name;
        $question->save();
        
        return $request->all();
    }


    //NUEVOS METODOS
    public function buscar(Request $request, $id)
    {
        $questions = Question::select('multiple_answers', 'name', 'id', 'poll_id')->where('id', '=', $id)->first();
        
        exit(json_encode([
            's'         => 's', 
            'questions' => $questions
        ]));
    }

    public function guardar(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required' ]);

        $question = Question::create($request->all());

        $poll = Poll::find($request->poll_id);
        //verificar si a la encuesta se le deben agregar respuestas automaticamente
        if ($poll->category->answers_yes_or_not) {
            $answer_yes =  Answer::create([
                'name' => 'Si',
                'value' => 1,
                'question_id' => $question->id,
                'poll_id' => $request->poll_id
            ]);
            $answer_not =  Answer::create([
                'name' => 'No',
                'value' => 0,
                'question_id' => $question->id,
                'poll_id' => $request->poll_id
            ]);
            
        }

        exit(json_encode([
            's'         => 's', 
            'msj'       => '*-* Pregunta agregada satisfactoriamente'
        ]));
    }


    public function actualizar(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required' ]);

        $question = Question::findOrFail($id);
        $question->update($request->all());

        exit(json_encode([
            's'         => 's', 
            'msj'       => 'Pregunta actualizada satisfactoriamente'
        ]));
    }
}
