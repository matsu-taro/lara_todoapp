<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::get();

        return view('todos.index', compact('todos'));
    }


    public function create()
    {
        $user = Auth::user();
        return view('todos.create', compact('user'));
    }


    public function store(Request $request)
    {
        Todo::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'content' => $request->content,
            'owner_name' => $request->owner_name,
            'status' => $request->status,
        ]);

        return to_route('todos.index');
    }


    public function show()
    {
        // $user = Auth::user();
        $my_todos = Todo::where('user_id', Auth::id())
            ->get();

        return view('todos.dashboard', compact('my_todos'));
    }

    
    public function edit(string $id)
    {
        $todo = Todo::findOrFail($id);
        $user = Auth::user();

        return view('todos.edit' ,compact('todo','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dustBox()
    {
        return view('todos.dust-box');
    }
}
