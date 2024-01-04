<x-app-layout>
  <main class="main">
    <div class="main__title">
      <p>
        詳細を確認・編集する
      </p>
    </div>

    @if ($errors->any())
      <div class="validation">
        <ul class="font-medium text-red-600">
          @foreach ($errors->all() as $error)
            <li>・{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('todos.update', ['todo' => $todo->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div class="todo--title">
        <input type="text" name="title" placeholder="タイトル" value="{{ $todo->title }}"
          style="border-radius: 4px; border:4px solid antiquewhite;">
      </div>
      <div class="todo--textarea">
        <textarea name="content" id="content" value="" cols="100%" rows="10" placeholder="内容を入力する">{{ $todo->content }}</textarea>
      </div>

      <div class="todo--owner_name">
        <input type="hidden" name="new_owner_name" value="{{ old('new_owner_name') }}" class="w-1/6"
          style="border-radius: 4px; border:4px solid antiquewhite;">
        <label for="owner_name" class="leading-7 text-md text-black-600">担当者</label><br>
        <select name="owner_name" class="w-1/6">
          @foreach ($users as $user)
            <option value="{{ $user->name }}" @if ($todo->user_id == $user->id) selected @endif>{{ $user->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="todo--status mt-6">
        <select name="status" class="w-1/6">
          <option value="0" @if ($todo->status === 0) selected @endif>未対応</option>
          <option value="1" @if ($todo->status === 1) selected @endif>対応中</option>
          <option value="2" @if ($todo->status === 2) selected @endif>完了</option>
        </select>
      </div>

      <div class="w-1/6 mt-6">
        <div class="relative">
          <input type="file" name="files[]" multiple accept=".png,.jpeg,.jpg,.pdf,.xlsx,.docx,.txt"
            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </div>
        <ul class="mt-4">

          @foreach ($files as $file)
            <li class="mt-4">・
              <a href="{{ Storage::url($file->path) }}" class="text-blue-500" target="_blank" rel="noopener noreferrer">
                {{ $file->original_file_name }}
              </a>
              <a href="{{ route('files.destroy', ['file' => $file->id]) }}" class="text-red-500 ml-10 border p-1">
                削除
              </a>
            </li>
          @endforeach

        </ul>
      </div>

      <div class="p-2 w-full flex my-8 gap-10">
        <button type="submit"
          class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新する</button>
        <button type="button" onClick="history.back()"
          class=" bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
      </div>
    </form>
  </main>
</x-app-layout>
