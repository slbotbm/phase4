<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      案件一覧
    </h2>
  </x-slot>
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200" style="padding: 5px;"><a href = "{{route('search.employee')}}">エンジニア</a></h3>
          <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"style="padding: 5px;"><a href = "{{route('search.project')}}">案件</a></h3>
          <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"style="padding: 5px;"><a href = "{{route('search.technology')}}">技術</a></h3>
        <div>
      </div>
    </div>
  </div> 
</div>
</x-app-layout>
