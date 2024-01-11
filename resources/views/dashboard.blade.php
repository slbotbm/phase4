<!DOCTYPE html>

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
                {{ __('HOME') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="gantt_here" style='width: 100%; height: 600px;'>         
                    <script>
                        gantt.config.date_format = "%Y-%m-%d"; 
                        gantt.i18n.setLocale("jp"); 
                        gantt.config.scales = [
                            {unit:"month", step:1, format:"%Y年%M"},
                            // {unit:"week", step:1, format: "%d日"},
                        ];
                        gantt.config.readonly = true;
                        gantt.config.scale_height = 54; 
                        gantt.config.columns = [
                                {name:"text", label:"案件名", width:200, tree:true},
                                {name:"start_date", label:"開始月日", align:"center"},
                                {name:"end_date", label:"終了月日", align:"center"},
                            ];
                        gantt.init("gantt_here"); 
                        var jsonData = {!! $response->getContent() !!}; 
                        gantt.parse(jsonData);
                    </script>
                    <div>
                </div>
            </div>
        </div>
</x-app-layout>

