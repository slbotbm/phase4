<!DOCTYPE html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    {{-- CDNから読み込み --}}
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            padding: 0px;
            margin: 0px;
            overflow: hidden;
        }

    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('HOME') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div id="gantt_here" style='width: 100%; height: 800px;'>
                        <script>
                            gantt.config.date_format = "%Y-%m-%d"; 
                            gantt.i18n.setLocale("jp"); 
                            gantt.config.scales = [
                                {unit:"month", step:1, format:"%Y年%M"},
                                {unit:"week", step:1, format: "%d日"},
                            ];
                            gantt.config.scale_height = 54; 
                            gantt.config.columns = [
                                    {name:"text", label:"案件名", width:200, tree:true},
                                    {name:"start_date", label:"開始月日", align:"center"},
                                    {name:"end_date", label:"終了月日", align:"center"},
                                ];
                            gantt.init("gantt_here"); 
                            gantt.load("/api/data");
                        </script>
                        </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

