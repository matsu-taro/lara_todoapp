<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRequest;
use App\Models\Todo;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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
    $owner_todos = Todo::where('user_id', $id)->paginate(10);

    return view('todos.owner_index', compact('users', 'owner_todos'));
  }


  public function create()
  {
    $users = User::all();
    return view('todos.create', compact('users'));
  }


  public function store(StoreRequest $request)
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
      ->paginate(10);

    return view('todos.dashboard', compact('my_todos'));
  }


  public function edit(string $id)
  {
    $todo = Todo::findOrFail($id);
    $users = User::all();

    $files = $todo->files;

    return view('todos.edit', compact('todo', 'users', 'files'));
  }


  public function update(StoreRequest $request, string $id)
  {
    $update_todo = Todo::find($id);
    $update_user = User::where('name', $request->owner_name)->first();

    $update_todo->user_id = $update_user->id;
    $update_todo->title = $request->title;
    $update_todo->content = $request->content;
    $update_todo->owner_name = $request->owner_name;
    $update_todo->status = $request->status;

    if ($request->hasFile('files')) {
      $files = $request->file('files');

      foreach ($files as $file) {
        $randFileName = uniqid();
        $extension = $file->getClientOriginalExtension();
        $originalFileName = $randFileName . '.' . $extension;

        $path = $file->storeAs('public/' . $originalFileName);

        File::create([
          'todo_id' => $update_todo->id,
          'original_file_name' => $originalFileName,
          'path' => $path,
        ]);
      };
    };

    $update_todo->save();

    return to_route('todos.index');
  }


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

  public function dustBoxClear(string $id)
  {
    $todo = Todo::onlyTrashed()->findOrFail($id);
    $paths = $todo->files()->pluck('path');

    foreach ($paths as $path) {
      if (Storage::exists($path)) {
        Storage::delete($path);
      }
    }

    $todo = Todo::onlyTrashed()->findOrFail($id)->forceDelete();

    return to_route('todos.dust-box');
  }

  public function restore($id)
  {
    $todo = Todo::onlyTrashed()->find($id);
    $todo->restore();

    return to_route('todos.dust-box');
  }
}
