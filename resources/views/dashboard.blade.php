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
      <p>
        自分のタスク
      </p>
    </div>

    <div class="main__body">
      <div class="main__bodyTop">
        <div class="main__body-left">
          <ul>
            <li class="main__smallTitle">
              タイトル
            </li>

            {{-- @foreach() --}}
            <li>
              wwwww
            </li>
            {{-- @endforeach --}}
          </ul>
        </div>
        <div class="main__body-right">
          <ul>
            <li class="main__smallTitle">
              ステータス
            </li>
            <li>
              wwwww
            </li>
          </ul>
          <ul>
            <li class="main__smallTitle">
              ボタン
            </li>
            <li>
              wwwww
            </li>
          </ul>
        </div>
      </div>
    </div>

  </main>
</x-app-layout>
