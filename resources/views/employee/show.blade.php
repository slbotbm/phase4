<x-app-layout>
    <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            padding: 0px;
            margin: 0px;
            overflow: auto;
        }
    </style>
    </head>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $employee->name }} ({{$employee->age}}歳)
            </h2>
        </x-slot>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
            <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">性別</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$employee->sex}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">就職の開始</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$employee->start_of_employment->format("Y-m-d")}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">プロフィールURL</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                <a href="{{$employee->profile_url}}">{{$employee->profile_url}}</a>
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">技術</p>
                @foreach($employee->technologies as $technology) 
                <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                    <a href="{{route('technology.show', $technology->id)}}">{{ $technology->name }} ({{ $technology->technology_field }})</a> <br>
                </p>
                @endforeach
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">案件</p>
              
                @if ($employee->projects->count() !== 0)
                    @foreach($employee->projects as $project) 
                    <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                        <a href="{{route('project.show', $project->id)}}">{{ $project->name }}</a> <br>
                    </p>
                    @endforeach
                @else
                    <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                        現在なし
                    </p>
                @endif
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">月あたりの労働時間数</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">{{ $hours}}</p>
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">残業</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                @if (160-$hours < 0)
                <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                    月{{$hours-160}}時間
                </p>
                @else
                <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                    なし
                </p>
                @endif
              </p>
            </div>
    </div>
    </div>
    </div>
    </div>
    </div>
     
</x-app-layout>

