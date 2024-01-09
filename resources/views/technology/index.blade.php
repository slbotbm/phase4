<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      技術一覧
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800">
          <form class="mb-6" action="{{ route('search.technology') }}" method="GET">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="keyword" :value="__('キーワード')" />
              <x-text-input id="keyword" class="block mt-1 w-full" type="text" name="keyword" :value="old('keyword')" autofocus />
            </div>
            
            <div class="flex flex-col mb-4">
            <x-input-label for="category" :value="__('技術のカテゴリー')" />
            <select id="category" name="category" class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="None">未選択</option>
                <option value="backend">バックエンド</option>
                <option value="frontend">フロントエンド</option>
                <option value="serverside">サーバーサイド</option>
            </select>
            </div>

            @include('common.errors')
              <x-primary-button class="ml-3">
                {{ __('検索') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



</x-app-layout>