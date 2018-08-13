<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Answer;
use App\Poll;
use App\Range;
use Response;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class RangeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        //$polls = Poll::all();
        $respuestas = Answer::where('id', '>', 0)
            ->distinct('poll_id')
            ->pluck('poll_id');
        $polls = Poll::find($respuestas);
        return view('admin.ranges.index', compact('polls'));
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //return $request->all();
        //dd( $request->all());
        $rules = array (
                    'from' => 'required',
                    'to' => 'required',
                    'text' => 'required',
            );
        $validator = Validator::make ( Input::all (), $rules );
        //validar que desde sea menor que hasta
        if ($request->from >= $request->to) {
            return Response::json ( array (
                'errors' => 'desde debe ser menor que hasta'
            ));
        }
        if ($validator->fails ())
            return Response::json ( array (
                'errors' => $validator->getMessageBag ()->toArray ()
                
            ) );
        else {
            $data = new Range ();
            $data->from = $request->from;
            $data->to = $request->to;
            $data->text = $request->text;
            $data->poll_id = $request->poll_id;
            $data->save ();
            return response ()->json ( $data );
        }
    }

   
    public function show($id)
    {
        $poll = Poll::find($id);

        if ( $poll->category->answers_yes_or_not == 1 && $poll->category->percentage_values == 1 ) {
            //return "una vista especial";
        }
         //return $id;
        $ranges = Range::where('poll_id', '=', $poll->id)
            ->get();
         
        return view('admin.ranges.show', compact('poll', 'ranges'));
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
        $range = DB::table('ranges')->where('poll_id', '=', $id)->delete();
        return redirect('admin/ranges');

    }
}
