<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      エンジニア一覧
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800">
          <form class="mb-6" action="{{ route('search.employee') }}" method="GET">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="keyword" :value="__('キーワード')" />
              <x-text-input id="keyword" class="block mt-1 w-full" type="text" name="keyword" :value="old('keyword')" autofocus />
            </div>
            <div class="flex items-center justify-end mt-4">
              <table class="text-center w-full">
                <tbody>
                    <tr class="hover:bg-gray-lighter">
                        <td class="py-4 px-6">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="category" :value="__('エンジニアのカテゴリー')" />
                            <select id="category" name="category" class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value = "None" selected>未選定</option>
                                <option value="free">暇</option>
                                <option value="overtime">残業</option>
                                <option value="employment_start">就職の開始</option>
                                <option value="number_of_projects">案件の数</option>
                            </select>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="speciality" :value="__('エンジニアの専門分野')" />
                            <select id="speciality" name="speciality" class="block mt-1 w-full rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value = "None" selected>未選定</option>
                                <option value="frontend">フロントエンド</option>
                                <option value="backend">バックエンド</option>
                                <option value="server-side">サーバーサイド</option>
                            </select>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col mb-4">
                            <x-input-label for="order" :value="__('順序')" />
                            <select id="order" name="order" class="block mt-1 w-full  rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="asc">降順</option>
                                <option value="desc">昇順</option>
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
              @foreach($response as $employee) 
              <tr class="hover:bg-gray-lighter">
                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"><a href="{{route('employee.show', $employee->id)}}">{{$employee->name}}</a></h3>
                  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">{{$employee->remaining_hours}}</h3>
                </td>
              </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
</x-app-layout>