<x-app-layout>
  <main class="main">
    <div class="main__title">
      <p>
        新規作成
      </p>
    </div>

    <form action="{{ route('todos.store') }}" method="post">
      @csrf

      {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}

      <div class="todo--title">
        <input type="text" name="title" placeholder="タイトル" value="{{ old('title') }}"
          style="border-radius: 4px; border:4px solid antiquewhite;">
      </div>
      <div class="todo--textarea">
        <textarea name="content" id="content" value="" cols="100%" rows="10" placeholder="内容を入力する">{{ old('content') }}</textarea>
      </div>

      <div class="todo--owner_name">
        <label for="new_owner_name" class="leading-7 text-md text-black-600">担当者</label><br>
        <input type="text" name="new_owner_name" placeholder="新しく追加する" value="{{ old('new_owner_name') }}" class="w-1/6"
          style="border-radius: 4px; border:4px solid antiquewhite;">
      </div>
      <div class="todo--owner_name">
        <select name="owner_name" class="w-1/6">
          <option value="0">担当者を選ぶ</option>
          @foreach ($users as $user)
            <option value="{{ $user->name }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="todo--status mt-6">
        <select name="status" class="w-1/6">
          <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>未対応</option>
          <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>対応中</option>
          <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>完了</option>
        </select>
      </div>

      <div class="w-1/6 mt-6">
        <div class="relative">
          <input type="file" name="files[]" multiple accept="image/png,image/jpeg,image/jpg"
            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </div>
      </div>

      <div class="p-2 w-full flex my-8 gap-10">
        <button type="submit"
          class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">作成する</button>
        <button type="button" onClick="history.back()"
          class=" bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
      </div>
    </form>
  </main>
</x-app-layout>
