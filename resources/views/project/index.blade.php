<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      案件一覧
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          <form class="mb-6" action="{{ route('search.project') }}" method="GET">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="keyword" :value="__('キーワード')" />
              <x-text-input id="keyword" class="block mt-1 w-full" type="text" name="keyword" :value="old('keyword')" autofocus />
            </div>
            @include('common.errors')
            <div class="flex items-center justify-end mt-4">
            <table class="text-center w-full border-collapse">
                <tbody>
                    <tr class="hover:bg-gray-lighter">
                        <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="category" :value="__('エンジニアのカテゴリー')" />
                            <select id="category" name="category" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="None"></option>
                                <option value="start_date">開始日</option>
                                <option value="end_date">終了日</option>
                                <option value="price">金額</option>
                                <option value="engineer_number">エンジニアの数</option>
                            </select>
                            </div>
                        </td>
                        <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="order" :value="__('順序')" />
                            <select id="order" name="order" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="None"></option>
                                <option value="desc">降順</option>
                                <option value="asc">昇順</option>
                            </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="category" :value="__('案件の状況')" />
                            <select id="category" name="category" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="None"></option>
                                <option value="before_creation">受注前</option>
                                <option value="in_creation">構築中</option>
                                <option value="after_creation">納品済み</option>
                            </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            </div>
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