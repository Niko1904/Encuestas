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


class PollsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $polls = Poll::all();
        $cantidadEncuestas = Poll::all()->count();
        
        return view('admin.polls.index', compact('polls', 'cantidadEncuestas'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('admin.polls.create', compact('categories'));        
    }

    
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required' ]);

        $poll = Poll::create($request->all());

        Session::flash('message', 'Encuesta guardada!');
        Session::flash('status', 'success');

        return redirect('admin/polls');

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $categories = Category::all();
        $poll = Poll::findOrFail($id);
        $questions = Question::where('poll_id', '=', $id)->get();
        
        return view('admin.polls.edit',compact('poll', 'categories', 'questions'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required' ]);

        $polls = Poll::findOrFail($id);
        $polls->update($request->all());

        Session::flash('message', 'Encuesta actualizada!');
        Session::flash('status', 'success');

        return redirect('admin/polls');
    }

    
    public function destroy($id)
    {
        dd("-->" . $id);/*
        $polls = Poll::findOrFail($id);

        $encuestas_aplicadas = AplicationPoll::where('poll_id', '=', $polls->id)->get();
        if (! $encuestas_aplicadas == null) {
            return redirect()->back()->with('message', 'Debido a que hay encuestas aplicadas, no puedes editar o eliminar!');
        }

        $polls->delete();

        Session::flash('message', 'Poll deleted!');
        Session::flash('status', 'success');

        return redirect('admin/polls');
        */
    }
    public function eliminar(Request $request, $id)
    {
        //dd($request->all());
        $polls = Poll::findOrFail($request->poll_id);

        $encuestas_aplicadas = AplicationPoll::where('question_id', '=', $id)->count();
        $salida = array("s" => "n", "msj" => "No se ha podido eliminar");
        if ($encuestas_aplicadas > 0) {
            $salida = array("s" => "n", "msj" => "Debido a que hay encuestas aplicadas, no puedes editar o eliminar!");
            exit(json_encode($salida));
        }

        if(Question::where('id', $request->question_id)->delete()){
            $Answer = Answer::where('question_id', $id)->count();
            if ($Answer > 0){
                $resp = Answer::where('question_id', $id)->delete();
            }
            $salida = array("s" => "s", "msj" => "Pregunta Eliminada Satisfactoriamente");
        }
        exit(json_encode($salida));
    }
}
