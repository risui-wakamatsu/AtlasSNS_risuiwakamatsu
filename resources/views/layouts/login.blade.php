<!--http://127.0.0.1:8000/top-->
<!--assetを使うことでリソースデータを読み込むことができる-->

<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->

    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--ーjQuery-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset('js/script.js')}}"></script>

</head>


<!--ここから-->

<body>
    <header>
        <div id="head">
            <div class="header_link">
                <h1><a href="/top"><img class="login_logo" src="{{asset('images/atlas.png')}}" alt="Atlas" width="145" height="50"></a></h1> <!--アトラスロゴにヘッダーへ戻るリンクを設定-->
            </div>
            <div class="user">
                <!--アコーディオンメニュー-->
                <ul class="dropmenu">
                    <li class="accordion"><a>{{Auth::user()->username}}　さん</a>
                        <ul>
                            <li class="menu_list"><a class="menu" href="/top">HOME</a></li>
                            <li class="menu_list"><a class="menu" href="/profile">プロフィール編集</a></li>
                            <li class="menu_list"><a class="menu" href="/logout">ログアウト</a></li>
                        </ul>
                    </li>
                </ul>
                <img class="accordion_img" src="{{asset('storage/'.Auth::user()->images)}}" height="64" width="64">
            </div>
        </div>
    </header>
    <div id="row"> <!--行-->
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar"> <!--サイドバーに表示される内容-->
            <div id="confirm">
                <p class="side">{{Auth::user()->username}}さんの</p>
                <div>
                    <p class="side">フォロー数&emsp;{{Auth::user()->following()->get()->count()}}名</p>
                    <!--Userモデルのfollowingからフォローしているユーザーの人数を取得-->
                    <!--&emsp;→特殊文字：全角のスペースを開ける-->
                </div>
                <p class="side_btn"><a href="/followList"><button type="button" class="btn btn-info">フォローリスト</button></a></p>
                <div>
                    <p class="side">フォロワー数&emsp;{{Auth::user()->followed()->get()->count()}}名</p>
                    <!--Userモデルのfollowedからフォローしているユーザーの人数を取得-->
                    <!--&emsp;→特殊文字：全角のスペースを開ける-->
                </div>
                <p class="side_btn"><a href="/followerList"><button type="button" class="btn btn-info">フォロワーリスト</button></a></p>
            </div>
            <div class="search_btn">
                <a href="/search"><button type="button" class="btn btn-info">ユーザー検索</button></a>
            </div>
        </div>
    </div>
    <footer>
    </footer>
</body>

</html>
