<!DOCTYPE html>

<x-app-layout>
    <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    <style>
        .gantt_task_progress {
			text-align: left;
			padding-left: 10px;
			box-sizing: border-box;
			color: white;
			font-weight: bold;
		}

        html,
        body {
            height: 100%;
            padding: 0px;
            margin: 0px;
            overflow: auto;
        }
        .red .gantt_cell, .odd.red .gantt_cell,
		.red .gantt_task_cell, .odd.red .gantt_task_cell {
			background-color: #FDE0E0;
		}

		.green .gantt_cell, .odd.green .gantt_cell,
		.green .gantt_task_cell, .odd.green .gantt_task_cell {
			background-color: #BEE4BE;
        }

        .blue .gantt_cell, .odd.blue .gantt_cell,
        .blue .gantt_task_cell, .odd.blue .gantt_task_cell {
            background-color: #ADD8E6;
        }

        .gantt_task_link.finish_to_start .gantt_line_wrapper div {
			background-color: #d47070;
		}

		.gantt_task_link.finish_to_start:hover .gantt_line_wrapper div {
			box-shadow: 0 0 5px 0px #d47070;
		}

        .gantt_task_link.finish_to_start .gantt_link_arrow_right {
			border-left-color: #d47070;
		}

		.gantt_task_link.finish_to_finish .gantt_line_wrapper div {
			background-color: #55d822;
		}

		.gantt_task_link.finish_to_finish:hover .gantt_line_wrapper div {
			box-shadow: 0 0 5px 0px #55d822;
		}

		.gantt_task_link.finish_to_finish .gantt_link_arrow_left {
			border-right-color: #55d822;
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
                        gantt.plugins({
                            marker: true
                        });
                        gantt.templates.grid_row_class = function (start_date, end_date, item) {
                            if (item.progress == 0) return "red";
                            if (item.progress >= 1) return "green";
                            if (item.progress >= 0) return "blue";
                        };
                        gantt.templates.task_row_class = function (start_date, end_date, item) {
                            if (item.progress == 0) return "red";
                            if (item.progress >= 1) return "green";
                            if (item.progress >= 0) return "blue";
                        };
                        var dateToStr = gantt.date.date_to_str(gantt.config.task_date);
                        var today = new Date();
                        gantt.addMarker({
                            start_date: today,
                            css: "today",
                            text: "今日",
                            title: "今日: " + dateToStr(today)
                        });

                        gantt.config.date_format = "%Y-%m-%d"; 
                        gantt.i18n.setLocale("jp"); 
                        gantt.config.scales = [
                            {unit:"month", step:1, format:"%Y年%M"},
                            // {unit:"week", step:1, format: "%d日"},
                        ];
                        gantt.config.readonly = true;
                        gantt.config.grid_resize = true;
                        gantt.config.scale_height = 54; 
                        gantt.config.columns = [
                                {name:"text", label:"案件名", width:200, tree:true},
                                {name:"start_date", label:"開始月日", align:"center"},
                                {name:"end_date", label:"終了月日", width:80, align:"center"},
                                { name: "owner", label:"担当", width: 100, align: "center"}
                            ];
                        gantt.init("gantt_here"); 
                        gantt.templates.link_class = function (link) {
                            var types = gantt.config.links;
                            switch (link.type) {
                                case types.finish_to_start:
                                    return "finish_to_start";
                                    break;
                                case types.start_to_start:
                                    return "start_to_start";
                                    break;
                                case types.finish_to_finish:
                                    return "finish_to_finish";
                                    break;
                            }
                        };
                        var jsonData = {!! $response->getContent() !!}; 
                        gantt.parse(jsonData);
                    </script>
                    <div>
                </div>
            </div>
        </div>
</x-app-layout>

