<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AplicationPoll;
use App\Answer;
use App\Category;
use App\GeneralDefinitions;
use App\Poll;
use App\Range;
use App\Resume;
use App\MasterAplication;
use App\DetailAplication;
use App\Question;


class EncuestasController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth'/*,  ['except' => ['index'] ]*/);
    }
   
    public function index()
    {
        /*$polls = Poll::all();
        return view('user.encuestas.index', compact('polls'));*/
        //$respuestas = Answer::where('id', '>', 0)->distinct('poll_id')->pluck('poll_id');
        //$polls = Poll::find($respuestas);
        $aprobadas =  DB::table('poll__users')->where('user_id', '=',  Auth::user()->id)
            ->get();
        //obtenemos los ids de las encuestas que tienen preguntas
        $respuestas = Answer::where('id', '>', 0)
            ->distinct('poll_id')
            //->where('')
            ->pluck('poll_id');
        //dd($respuestas);
        $encuestas_con_preguntas = Poll::find($respuestas);
        $polls = [];
        foreach ($encuestas_con_preguntas as $encuesta) {
            foreach ($aprobadas as  $key => $apro) {
                if ($encuesta->id == $apro->poll_id) {
                    //dd($apro);
                    $polls[$key] = $encuesta; 
                }
            }
        }
        //dd($encuestas_con_preguntas);       
        return view('user.encuestas.index', compact('polls'));
    }
  
    public function create()
    {
        //  
    }
    
    public function store(Request $request){
        //dd($request->all());
        //return " store";       

        $st = Session::get('start_date');

        MasterAplication::where('user_id', '=', Auth::user()->id)
            ->where('poll_id', '=', $request->poll_id)
            ->delete();

        $master_aplication = new MasterAplication();
        $master_aplication->start_date = $st; 
        $master_aplication->user_id = Auth::user()->id;
        $master_aplication->poll_id = $request->poll_id;;
        $master_aplication->status = 0;
        $master_aplication->poll_closed = 1;// Encuesta cerrada
        $master_aplication->save();
     
        $encuesta = Poll::find($request->poll_id);
        $preguntas = Question::where('poll_id', '=', $request->poll_id)->get();
        //$respuestas = Answer::where('poll_id', $encuesta->id)->get();
        $total = 0;

        AplicationPoll::where('user_id', '=', Auth::user()->id)
            ->where('poll_id', '=', $request->poll_id)
            ->delete();
        if(isset($request->id_respuestas) && count($request->id_respuestas) > 0)
            foreach ($request->id_respuestas as $key => $value) {
                //print_r('llave: '.$key .' valor: '. $value. ' ');
                $aplication_poll = new AplicationPoll();
                $total += Answer::where('id', $value)->first()->value;
                $answer = Answer::find($value);
                $aplication_poll->start = $st;
                $aplication_poll->end = Carbon::now();
                $aplication_poll->value = $answer->value;
                $aplication_poll->user_id = Auth::user()->id;
                $aplication_poll->poll_id = $request->poll_id;
                $aplication_poll->question_id = $answer->question_id;
                $aplication_poll->answer_id = $answer->id;
                $aplication_poll->save();
            }        
        // cuando la encuesta es por porcentaje y con 2 respuestas
        $yes_or_not = false;
        $resume = new \stdClass();
        $resume->text = null;
        $ranges = Range::where('poll_id', '=', $request->poll_id)->get();
        $rangos = array();
        $rango_usuario = array();

        if ( $encuesta->category->answers_yes_or_not == 1 && $encuesta->category->percentage_values == 1 ) {
            $yes_or_not = true;
            $numero_preguntas = Question::where('poll_id', '=', $encuesta->id)->count();
            $preguntas_contestadas = $total;
            $total = 0;
            $total = ($preguntas_contestadas * 100 ) /  $numero_preguntas; 
            //dd($total);
        }
        //***************************************************************** */
        
        if(count($ranges) > 0)
            foreach ($ranges as $key => $value) {
                $rangos[] = array(
                    'name'      => $value->text,
                    'y'         => $value->to,
                    'drilldown' => $value->text
                );
                if ( $total >= $value->from && $total <= $value->to) {
                    $range = $value;
                    $resume = new Resume();
                    $resume->user_id = Auth::user()->id;
                    $resume->poll_id = $request->poll_id;
                    $resume->total = $total;
                    $resume->from = $value->from;
                    $resume->to = $value->to;
                    $resume->text = $value->text;
                    $resume->save();

                    $rango_usuario = array(
                        'name'      => 'Su rango',
                        'y'         => $value->to,
                        'drilldown' => 'Su rango'
                    );
                }
            }

        $rangos[] = $rango_usuario;

        $rangos = json_encode($rangos);

        //desvincular encuesta de usuario para que no la vuelva a aplicar
        $this->desvincular(Auth::user()->id, $request->poll_id);
        if ($yes_or_not) $total = $total . ' %';
        return view('user.encuestas.resultados.resultado', compact('resume', 'total', 'encuesta', 'rangos'));
    }

    public function individualStore(Request $request)
    {
        //return "individual store";
        $encuesta = Poll::find($request->poll_id);

        if($request->id_respuestas == null) {
            if($encuesta->category->timer_type != 2)
                return redirect()->back()->with('message', 'Debes responder al menos 1 pregunta!');
        }
        
        $st = Session::get('start_date');
        $master_aplication = new MasterAplication();
        $master_aplication->start_date = $st; 
        $master_aplication->user_id = Auth::user()->id;
        $master_aplication->poll_id = $request->poll_id;;
        $master_aplication->status = 0;
        $master_aplication->save();

        $preguntas = Question::where('poll_id', '=', $request->poll_id)->get();
        $total = 0;

        AplicationPoll::where('user_id', '=', Auth::user()->id)
            ->where('poll_id', '=', $request->poll_id)
            ->delete();

        if(isset($request->id_respuestas) && count($request->id_respuestas) > 0)
            foreach ($request->id_respuestas as $key => $value) {
                $aplication_poll = new AplicationPoll();
                $total += Answer::where('id', $value)->first()->value;
                $answer = Answer::find($value);
                $aplication_poll->start = Carbon::now();
                $aplication_poll->end = Carbon::now();
                $aplication_poll->value = $answer->value;
                $aplication_poll->user_id = Auth::user()->id;
                $aplication_poll->poll_id = $request->poll_id;
                $aplication_poll->question_id = $answer->question_id;
                $aplication_poll->answer_id = $answer->id;
                $aplication_poll->save();
            }

        $resume = new \stdClass();
        $resume->text = null;
        $ranges = Range::where('poll_id', '=', $request->poll_id)->get();
        $rangos = array();
        $rango_usuario = array();
        foreach ($ranges as $key => $value) {
            $rangos[] = array(
                'name'      => $value->text,
                'y'         => $value->to,
                'drilldown' => $value->text
            );
            
            if ( $total >= $value->from && $total <= $value->to) {
                $range = $value;
                $resume = new Resume();
                $resume->user_id = Auth::user()->id;
                $resume->poll_id = $request->poll_id;
                $resume->total = $total;
                $resume->from = $value->from;
                $resume->to = $value->to;
                $resume->text = $value->text;
                $resume->save();

                $rango_usuario = array(
                    'name'      => 'Su rango',
                    'y'         => $value->to,
                    'drilldown' => 'Su rango'
                );
            }
        } 
        $rangos[] = $rango_usuario;

        $rangos = json_encode($rangos);

        $this->desvincular(Auth::user()->id, $request->poll_id);

        return view('user.encuestas.resultados.resultado', compact('resume', 'total', 'encuesta', 'rangos'));
    }
   
    public function show($id)
    {

        //validar que la encuesta tengas sus rangos
        /*
        select a.poll_id,count(*) from answers a, ranges b 
	        where a.poll_id = b.poll_id and b.`from` > 0 and b.`to` > 0
        */
        $contestadas = null;
        $generaldefinitions = GeneralDefinitions::where('id', '>',0)->first();

        $master_aplication = MasterAplication::where('poll_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->where('status', '=', 0)
            ->first();
        
        $encuesta   = Poll::findOrFail($id);
        $preguntas  = Question::where('poll_id', '=', $encuesta->id)->get();
        $detail_aplication = [];

        if ($master_aplication) // si ha guardado la encuesta anteriormente
            $detail_aplication = DetailAplication::where('master_aplication_id', '=', $master_aplication->id)->get();

        Session::put('start_date', Carbon::now()->format('Y-m-d H:i:s'));

        $numero_preguntas = Question::where('poll_id', '=', $encuesta->id)->count();
        //return $encuesta->category->timer_type;
        if($encuesta->category->timer_type == 2){ // Cuando es tiempo por pregunta
            if ($encuesta->category->show_all_questions == 0) 
                //return $generaldefinitions;
                return view('user.encuestas.individual.tiempo_pregunta_individual', compact('encuesta', 'preguntas', 'contestadas', 'numero_preguntas', 'generaldefinitions'));
            
            return view('user.encuestas.general.tiempo_pregunta', compact('encuesta', 'preguntas', 'detail_aplication', 'contestadas', 'generaldefinitions'));
        }else{
            // tiempo por pregunta y mostrar una sola pregunta
            if ($encuesta->category->show_all_questions == 0) 
                //return $generaldefinitions;
                return view('user.encuestas.individual.ajax', compact('encuesta', 'preguntas', 'contestadas', 'numero_preguntas', 'generaldefinitions'));
            //tiempo general
            return view('user.encuestas.general.show', compact('encuesta', 'preguntas', 'detail_aplication', 'contestadas', 'generaldefinitions'));
        }
    }

    public function reanudar($id){
        //dd($id);
        $generaldefinitions = GeneralDefinitions::where('id', '>',0)->first();
        $contestadas = AplicationPoll::where('poll_id', '=', $id)
            //->where('user_id', '=', Auth::user()->id)
            ->get();
        //dd($contestadas);
        $encuesta = Poll::find($id);

        $preguntas = Question::where('poll_id', '=', $encuesta->id)
            ->get();
        return view('user.encuestas.general.show', compact('encuesta', 'preguntas', 'contestadas', 'generaldefinitions'));

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
    
    public function desvincular($id, $poll_id)
    {
        //desvincular encuesta de usuario para que no la vuelva a aplicar
        $poll__users =  DB::table('poll__users')
            ->where('user_id', '=',  $id)
            ->where('poll_id', '=',  $poll_id)
            ->delete();
        
        return;
    }
}
