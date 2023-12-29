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
        全員のタスク
      </p>
    </div>

    <div class="flex gap-x-16">
      <div>
        <table class="table-auto text-left whitespace-no-wrap border block">
          <thead class="border-b-2">
            <tr>
              <th
                class="font-bold px-4 pl-100 py-6 title-font tracking-wider text-gray-900 text-lg bg-blue-300 rounded-tl rounded-b">
                担当者でタスクを絞る
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr class="border-b-2">
                <td class="px-4 py-1">
                  <a href="{{ route('todos.owner_index', $user->id) }}" class="text-blue-500">
                    {{ $user->name }}
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div>
        <table class="table-auto text-left whitespace-no-wrap border block">
          <thead class="border-b-2">
            <tr>
              <th
                class="font-bold px-4 pl-100 py-6 title-font tracking-wider text-gray-900 text-lg bg-gray-100 rounded-tl rounded-b">
                タスク</th>
              <th
                class="font-bold px-4 pl-100 py-3 title-font tracking-wider text-gray-900 text-lg bg-gray-100 rounded-tl rounded-b">
              </th>
              <th
                class="font-bold px-4 pl-100 py-3 title-font tracking-wider text-gray-900 text-lg bg-gray-100 rounded-tl rounded-b">
              </th>
            </tr>
          </thead>
          <thead class="border-b-2">
            <tr>
              <th
                class="font-bold px-4 pl-100 py-3 title-font tracking-wider text-gray-900 text-md bg-gray-100 rounded-tl rounded-b">
                タイトル</th>
              <th class="font-bold text-right px-4 py-3 title-font tracking-wider text-gray-900 text-md bg-gray-100">
                担当者</th>
              <th class="font-bold text-right px-4 py-3 title-font tracking-wider text-gray-900 text-md bg-gray-100">
                ステータス</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($todos->sortBy('owner_name') as $todo)
              <tr class="border-b-2">
                <td class="px-4 py-3">
                  <a class="text-blue-500" href="{{ route('todos.edit', ['todo' => $todo->id]) }}">
                    {{ $todo->title }}
                  </a>
                </td>
                <td class="text-right px-4 py-3">
                  {{ $todo->owner_name }}
                </td>
                <td class="text-right px-4 py-3">
                  @if ($todo->status === 0)
                    未対応
                  @elseif($todo->status === 1)
                    対応中
                  @elseif($todo->status === 2)
                    完了
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pagination">
          {{ $todos->links() }}
        </div>
      </div>
    </div>
  </main>
</x-app-layout>
