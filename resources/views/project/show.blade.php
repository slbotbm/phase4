<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $project->name }}({{$project->status}})
            </h2>
        </x-slot>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
            <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">詳細</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$project->details}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">客名</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$project->customer_name}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">作成期間</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$project->start_date->format("Y-m-d")}} から {{$project->end_date->format("Y-m-d")}} まで
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">費用</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$project->cost}}円
              </p>
            </div>
            <div class="flex flex-col mb-4">
                <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">エンジニア</p>
                @foreach($project->employees as $employee)
                    <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                         <a href = "{{ route('employee.show', $employee->id) }}">{{ $employee->name }}</a>
                    </p>
                @endforeach
            </div>

            <div class="flex flex-col mb-4">
                <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">技術</p>
                @foreach($project->technologies as $technology)
                    <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                         <a href = "{{ route('technology.show', $technology->id) }}">{{ $technology->name }} ({{$technology->technology_field}})</a>
                    </p>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>

