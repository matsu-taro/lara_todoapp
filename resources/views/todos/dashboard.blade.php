<x-app-layout>
  <x-slot name="header">
    <div class="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('todos.create') }}" class="header__btn">
          新規作成
        </a>
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('todos.index') }}" class="header__btn">
          全員のタスクを見る
        </a>
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('todos.dashboard') }}" class="header__btn">
          自分のタスクを見る
        </a>
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('todos.dust-box') }}" class="header__btn">
          削除したタスクを見る
        </a>
      </h2>
    </div>
  </x-slot>

  <main class="main">
    <div class="main__title">
      <p>
        自分のタスク
      </p>
    </div>

    <div>
      <table class="table-auto w-3/5 text-left whitespace-no-wrap ">
        <thead class="border-b-2">
          <tr>
            <th
              class="px-4 pl-100 py-3 title-font tracking-wider font-bold text-gray-900 text-md bg-gray-100 rounded-tl rounded-b">
              タイトル</th>
            <th class="text-right px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-md bg-gray-100">
              ステータス</th>
            <th class="text-right px-4 py-3 title-font tracking-wider font-bold text-gray-900 text-md bg-gray-100">削除
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($my_todos as $my_todo)
            <tr class="border-b-2">
              <td class="px-4 py-3">
                <a href="{{ route('todos.edit', ['todo' => $my_todo->id]) }}" class="text-blue-500">
                  {{ $my_todo->title }}
                </a>
              </td>
              <td class="text-right px-4 py-3">
                @if ($my_todo->status === 0)
                  未対応
                @elseif($my_todo->status === 1)
                  対応中
                @elseif($my_todo->status === 2)
                  完了
                @endif
              </td>
              <td class="text-right px-4 py-3 text-gray-900">
                <form action="{{ route('todos.destroy', ['todo' => $my_todo->id]) }}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="text-red-500">
                    削除する
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="pagination">
        {{ $my_todos->links() }}
      </div>
    </div>
  </main>
</x-app-layout>
