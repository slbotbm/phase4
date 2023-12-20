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
                        <div id="gantt_here" style='width: 100%; height: 400px;'>
                        </div>
                        <script>
                            gantt.config.date_format = "%Y-%m-%d %H:%i:%s"; // オプション：日付フォーマット設定
                            gantt.i18n.setLocale("jp"); // オプション：言語設定
                            gantt.init("gantt_here"); // 表示　※最低限この行だけあれば表示は可能
                            gantt.config.columns = [
                                {name:"add", label:"", width:50, align:"left" },
                                {name:"text", label:"<div class='searchEl'>name</div>", width:250, tree:true},                        
                                    // other columns
                                ];

                        gantt.load("/api/data");
                        </script>

                </div>
            </div>
        </div>
    </x-app-layout>
</body>

