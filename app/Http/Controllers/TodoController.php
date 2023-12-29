<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\File;
use App\Models\User;

class TodoController extends Controller
{

  public function index()
  {
    $todos = Todo::paginate(10);
    $users = User::all();

    return view('todos.index', compact('todos', 'users'));
  }

  public function ownerIndex(string $id)
  {
    $users = User::all();
    $owner_todos = Todo::where('user_id', $id)->get();

    return view('todos.owner_index', compact('users', 'owner_todos'));
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

      $todo = Todo::create([
        'user_id' => $user->id,
        'title' => $request->title,
        'content' => $request->content,
        'owner_name' => $newOwnerName,
        'status' => $request->status,
      ]);
    } elseif ($newOwnerName == null && $selectedOwnerName !== 0) {

      $user = User::where('name', $selectedOwnerName)->first();

      if ($user) {
        $todo = Todo::create([
          'user_id' => $user->id,
          'title' => $request->title,
          'content' => $request->content,
          'owner_name' => $selectedOwnerName,
          'status' => $request->status,
        ]);
      }
    };

    if ($request->hasFile('files')) {
      $files = $request->file('files');

      foreach ($files as $file) {
        $randFileName = uniqid();
        $extension = $file->getClientOriginalExtension(); //拡張子を抽出
        $originalFileName = $randFileName . '.' . $extension;

        $path = $file->storeAs('public/' . $originalFileName);

        File::create([
          'todo_id' => $todo->id,
          'original_file_name' => $originalFileName,
          'path' => $path,
        ]);
      };
    };

    return to_route('todos.index');
  }


  public function dashBoard()
  {
    $my_todos = Todo::where('user_id', Auth::id())
      ->get();

    return view('todos.dashboard', compact('my_todos'));
  }


  public function edit(string $id)
  {
    $todo = Todo::findOrFail($id);
    $users = User::all();

    return view('todos.edit', compact('todo', 'users'));
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
    Todo::findOrFail($id)
      ->delete();

    return to_route('todos.dashboard');
  }

  public function dustBox()
  {
    $deletedTodos = Todo::onlyTrashed()->get();

    return view('todos.dust-box', compact('deletedTodos'));
  }
}
