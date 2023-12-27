<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\User;

class TodoController extends Controller
{

  public function index()
  {
    $todos = Todo::get();
    $users = User::all();

    return view('todos.index', compact('todos','users'));
  }

  public function ownerIndex(string $id)
  {
    $owner_todos = Todo::findOrFail($id)->get();
    $memos = Todo::where('id', $id)->orderBy('updated_at', 'desc');

    return view('todos.owner_index', compact('owner_todos'));
  }


  public function create()
  {
    // $user = Auth::user();
    $users = User::all();
    return view('todos.create', compact('users'));
  }


  public function store(Request $request)
  {
    $newOwnerName = $request->new_owner_name;
    $selectedOwnerName = $request->owner_name;

    if ($newOwnerName && $selectedOwnerName == 0) {
      $user = User::create([
        'name' => $newOwnerName,
        'email' => 'test@test.com',
        'password' => 'password'
      ]);

      Todo::create([
        'user_id' => $user->id,
        'title' => $request->title,
        'content' => $request->content,
        'owner_name' => $newOwnerName,
        'status' => $request->status,
      ]);

    } elseif ($newOwnerName == null && $selectedOwnerName !== 0) {
      
      $user = User::where('name', $selectedOwnerName)->first();

      if ($user) {
        Todo::create([
          'user_id' => $user->id,
          'title' => $request->title,
          'content' => $request->content,
          'owner_name' => $selectedOwnerName,
          'status' => $request->status,
        ]);
      }
    };

    return to_route('todos.index');
  }


  public function show()
  {
    $my_todos = Todo::where('user_id', Auth::id())
      ->get();

    return view('todos.dashboard', compact('my_todos'));
  }


  public function edit(string $id)
  {
    $todo = Todo::findOrFail($id);
    $user = Auth::user();

    return view('todos.edit', compact('todo', 'user'));
  }

 
  public function update(Request $request, string $id)
  {
    $update = Todo::find($id);

    $update->title = $request->title;
    $update->content = $request->content;
    $update->owner_name = $request->owner_name;
    $update->status = $request->status;

    $update->save();

    return to_route('todos.index');
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
