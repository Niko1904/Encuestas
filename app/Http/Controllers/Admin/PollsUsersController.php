<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\AplicationPoll;
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


class PollsUsersController extends Controller
{

  public function __construct()
  {
    $this->middleware( 'auth:admin', ['except' => ['search']] );
  }

  public function index()
  {
      //$respuestas = Answer::where('id', '>', 0)->distinct('poll_id')->pluck('poll_id');
      //$polls = Poll::find($respuestas);
      $polls = Poll::all();
      $users = User::all();
      
      return view('admin.polls_users.index', compact('polls', 'users'));
  }

  public function search($id)
  {
      $user = User::find($id);
      $asig = Poll_User::where('user_id', '=', $id)->get();
      return $asig;
  }

  public function save(Request $request)
  {
      $asig = Poll_User::where('user_id', '=', $request->user_id);
      if (!$asig == null) {
        $asig->delete();
      }

      if (!$request->polls_chk == null) {
        foreach ($request->polls_chk as $key => $value) {
          $new_asig = new Poll_User();
          $new_asig->user_id = $request->user_id;
          $new_asig->poll_id = $value;
          $new_asig->save();
        }
      }     
      
      //DB::beginTransaction();
      /* try
      {
          if (!$asig == null)
          {
              $asig->delete();
          }
          if (!$request->polls_chk == null) {
            foreach ($request->polls_chk as $key => $value) {
              $new_asig = new Poll_User();
              $new_asig->user_id = $request->user_id;
              $new_asig->poll_id = $value;
              $new_asig->save();
          }
          DB::commit();
      }
      catch(Exception $e)
      {
          DB::rollback();
      } */        
      /* try {          
          if (!$asig == null) {
            $asig->delete();
          }
          if (!$request->polls_chk == null) {
            foreach ($request->polls_chk as $key => $value) {
              $new_asig = new Poll_User();
              $new_asig->user_id = $request->user_id;
              $new_asig->poll_id = $value;
              $new_asig->save();
            }
          }         
      }
      catch(\Exception $e)
      {
          DB::rollback();
          return $e->getMessage();
      } */

      Session::flash('flash_message', 'Asignacion actualizada!');
      return redirect('admin/pollsusers/index');
  }

}
