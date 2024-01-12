<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
検索
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900 dark:text-gray-100">
<div class="d-flex justify-content-between">
<div class="w-100">
<button class="mt-2 mb-2 text-left font-bold text-lg text-gray-dark dark:text-gray-200 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><a href="{{ route('search.employee') }}" class="text-light text-decoration-none">エンジニア</a></button>
</div>
<div class="w-100">
<button class="mt-2 mb-2 text-left font-bold text-lg text-gray-dark dark:text-gray-200 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><a href="{{ route('search.project') }}" class="text-light text-decoration-none">案件</a></button>
</div>
<div class="w-100">
<button class="mt-2 mb-2 text-left font-bold text-lg text-gray-dark dark:text-gray-200 bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded"><a href="{{ route('search.technology') }}" class="text-light text-decoration-none">技術</a></button>
</div>
</div>
<div>
</div>
</div>
</div>
</div>
</x-app-layout>