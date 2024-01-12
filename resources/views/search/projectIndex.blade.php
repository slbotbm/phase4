<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      案件一覧
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800">
          <form class="mb-6" action="{{ route('search.project') }}" method="GET">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="keyword" :value="__('キーワード')" />
              <x-text-input id="keyword" class="block mt-1 w-full" type="text" name="keyword" :value="old('keyword')" autofocus />
            </div>
            @include('common.errors')
            <div class="flex items-center justify-end mt-4">
            <table class="text-center w-full">
                <tbody>
                    <tr class="hover:bg-gray-lighter">
                        <td class="py-4 px-6">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="category" :value="__('エンジニアのカテゴリー')" />
                            <select id="category" name="category" class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="None" selected>未選択</option>
                                <option value="start_date">開始日</option>
                                <option value="end_date">終了日</option>
                                <option value="price">金額</option>
                                <option value="number_of_engineers">エンジニアの数</option>
                            </select>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="order" :value="__('順序')" />
                            <select id="order" name="order" class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="desc">降順</option>
                                <option value="asc">昇順</option>
                            </select>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="condition" :value="__('案件の状況')" />
                            <select id="condition" name="condition" class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="None">未選択</option>
                                <option value="before_creation">受注前</option>
                                <option value="in_creation">構築中</option>
                                <option value="after_creation">納品済み</option>
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
            
            </div>
            </form>
            <table class="text-center w-full border-collapse">
            <tbody>
              @foreach($response as $project) 
              <tr class="hover:bg-gray-lighter">
                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"><a href="{{route('project.show', $project->id)}}">{{$project->name}}</a></h3>
                </td>
              </tr>
            @endforeach
            </tbody>
            </table>
            </div>
        </div>
      </div>
    </div>
  </div>

  
</x-app-layout>