<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Poll;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    
    public function index()
    {
        $polls = Poll::all();
        return view('user.encuestas.test', compact('polls'));
    }

    
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $poll = Poll::create($request->all());

        return Response::json($poll);
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

}
