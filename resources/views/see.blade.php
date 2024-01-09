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

  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"><a href = "{{route('employee.index')}}">エンジニア</a></h3>
  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"><a href = "{{route('project.index')}}">案件</a></h3>
  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200"><a href = "{{route('technology.index')}}">技術</a></h3>
</div>
</div>
</div>
</div>
</x-app-layout>
