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
    <div id="gantt_here" style='width: 100%; height: 100%;'>
        {{-- 描写エリア　ここから --}}

        {{-- 描写エリア　ここまで --}}
    </div>
    <script>
        gantt.config.date_format = "%Y-%m-%d %H:%i:%s"; // オプション：日付フォーマット設定
        gantt.i18n.setLocale("jp"); // オプション：言語設定
        gantt.init("gantt_here"); // 表示　※最低限この行だけあれば表示は可能
    </script>
</body>

