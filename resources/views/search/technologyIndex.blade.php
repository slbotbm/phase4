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
            <table class="text-center w-full">
                <tbody>
                    <tr class="hover:bg-gray-lighter">
                        <td class="py-4 px-6">
                          <div class="flex flex-col mb-4">
                          <x-input-label for="category" :value="__('技術のカテゴリー')" />
                          <select id="category" name="category" class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                              <option value="None" selected>未選択</option>
                              <option value="backend">バックエンド</option>
                              <option value="frontend">フロントエンド</option>
                              <option value="server-side">サーバーサイド</option>
                          </select>
                          </div>
                        </td>
                        <td>
                          <x-primary-button class="ml-3">
                            {{ __('検索') }}
                          </x-primary-button>
                        </td>
                    </tr>
                  </tbody>
              </table>  

            @include('common.errors')
            </div>
          </form>
          <table class="text-center w-full border-collapse">
          <tbody>
            @foreach($response as $technology)
            <tr class="hover:bg-gray-lighter">
                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"><a href="{{route('technology.show', $technolohy->id)}}">{{$technology->name}}</a></h3>
                </td>
              </tr>
            @endforeach
            </tbody>
            </table>
        </div>
          {{$response->links()}}
      </div>
    </div>
    </div>

</x-app-layout>