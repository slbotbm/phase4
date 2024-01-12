<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ステータス変更') }}
        </h2>
    </x-slot>
    
    <!DOCTYPE html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <style>
            html,
            body {
                height: 100%;
                padding: 0px;
                margin: 0px;
                overflow: hidden;
                margin: 30px;
            }
            modal {
                margin: 30px;
            }
            botton_modal {
                margin: 30px;
            }
            .m-10{
                margin: 50px;
            }
        </style>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>モーダルの追加</title>
            <!-- モーダル用のスタイルシート（例: BootstrapのCSSを使用） -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>
            <body>



            
            <!-- ボタンをクリックするとモーダルが表示されるようにする -->
            <div class="py-12">
                <botton_modal class="w-75">
                    <button type="button" class="btn btn-primary btn-block m-10" data-toggle="modal" data-target="#myModal">
                        名前：名前<br>技術：フロント<br>言語：CSS
                    </button>
                </botton_modal>
            </div>
            
            <!-- モーダルのコンテンツ -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ステータス変更</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                    <div class="modal-body">
                        <a>名前：ｐｐｐｐｐｐｐｐｐｐｐｐｐｐｐｐｐｐ</a>
                        <a></a>
                    </div>
                    <modal action="/submit" method="post" >
                            <!-- 1つのチェックボックス -->
                            <input type="radio" id="checkbox1" name="checkbox1[]" value="value1-0">
                            <label for="checkbox1">空き</label><br>

                            <input type="radio" id="checkbox2" name="checkbox1[]" value="value1-1">
                            <label for="checkbox2">制作中</label><br>

                            <input type="radio" id="checkbox3" name="checkbox1[]" value="value1-2">
                            <label for="checkbox3">もうすぐ制作完了</label><br>

                            <br>

                            <label for="selectMenu">プロダクト名</label><br>
                            <select id="selectMenu" onchange="handleSelection()">
                                <option value="option1">オプション1</option>
                                <option value="option2">オプション2</option>
                                <option value="option3">オプション3</option>
                                <option value="option4">オプション4</option>
                            </select>
                            <p id="selectedOption">選択されたオプションはここに表示されます。</p>
                    </modal>

                </div>
            </div>

        <!-- モーダルを表示するために必要なJavaScript（例: BootstrapのJavaScriptを使用） -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        </body>
    </html>
</x-app-layout>
