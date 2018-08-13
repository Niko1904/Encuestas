<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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

class ClientsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function users()
    {
        $users = User::all();
        return view('admin.admins.clients', compact('users'));
        
    }
}
