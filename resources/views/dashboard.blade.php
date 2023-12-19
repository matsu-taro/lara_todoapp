<x-app-layout>
  <x-slot name="header">
    <div class="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="" class="header__btn">
          新規作成
        </a>
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="" class="header__btn">
          全てのタスクを見る
        </a>
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="" class="header__btn">
          自分のタスクを見る
        </a>
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="" class="header__btn">
          削除したタスクを見る
        </a>
      </h2>
    </div>
  </x-slot>

  <main class="main">
    <div class="main__title">
      <div class="main__title">
        <p>
          自分のタスク
        </p>
      </div>
    </div>
    <div class="main__body">
      <div class="main__title-left">
        <p>
          タイトル
        </p>
      </div>
      <div class="main__title-right">
        <p>
          状態
        </p>
        <p>
          削除
        </p>
      </div>
    </div>
  </main>

  {{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in!") }}
        </div>
      </div>
    </div>
  </div> --}}
</x-app-layout>
