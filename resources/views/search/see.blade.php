<!DOCTYPE html>

<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="{{ asset('style.css') }}"/>
</head>

<body>
  <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        検索
      </h2>
    </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100" style="text-align: center">
            <a href="{{route('employee.index')}}" class="btn_01" >エンジニア</a>
            <a href="{{route('project.index')}}" class="btn_02">案件</a>
            <a href="{{route('technology.index')}}" class="btn_03">技術</a>
          <div>
        </div>
      </div>
    </div> 
  </div>
  </x-app-layout>
</body>
</html>
