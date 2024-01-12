<!DOCTYPE html>

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
                        var hourToStr = gantt.date.date_to_str("%H:%i");
                        var hourRangeFormat = function(step){
                            return function(date){
                                var intervalEnd = new Date(gantt.date.add(date, step, "day") - 1)
                                return hourToStr(date) + " - " + hourToStr(intervalEnd);
                            };
                        };

                        gantt.config.min_column_width = 80;
                        var zoomConfig = {
		minColumnWidth: 80,
		maxColumnWidth: 150,
		levels: [
			[
				{ unit: "month", format: "%M %Y", step: 1},
				{ unit: "week", step: 1, format: function (date) {
						var dateToStr = gantt.date.date_to_str("%d %M");
						var endDate = gantt.date.add(date, -6, "day");
						var weekNum = gantt.date.date_to_str("%W")(date);
						return "Week #" + weekNum + ", " + dateToStr(date) + " - " + dateToStr(endDate);
					}}
			],
			[
				{ unit: "month", format: "%M %Y", step: 1},
				{ unit: "day", format: "%d %M", step: 1}
			],
			[
				{ unit: "day", format: "%d %M", step: 1},
				{ unit: "hour", format: hourRangeFormat(12), step: 12}
			],
			[
				{unit: "day", format: "%d %M",step: 1},
				{unit: "hour",format: hourRangeFormat(6),step: 6}
			],
			[
				{ unit: "day", format: "%d %M", step: 1 },
				{ unit: "hour", format: "%H:%i", step: 1}
			]
		],
		useKey: "ctrlKey",
		trigger: "wheel",
		element: function(){
			return gantt.$root.querySelector(".gantt_task");
		}
	}

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

