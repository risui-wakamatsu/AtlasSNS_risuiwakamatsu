<!--http://127.0.0.1:8000/top-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
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

    <!--ーjQuery-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/script.js"></script>
    </body>
</head>

<body>
    <header>
        <div id="head">
            <div class="header-link">
                <h1><a href="/top"><img src="images/atlas.png" alt="Atlas"></a></h1> <!--アトラスロゴにヘッダーへ戻るリンクを設定-->
            </div>
            <div class="user">
                <p>{{Auth::user()->username}}さん<img src="images/icon1.png"></p>
            </div>
            <!--アコーディオンメニュー記述-->
            <div class="menu">
                <dl> <!--dt、dd要素をまとめるリスト-->
                    <dt class="accordion"> <!--用語-->
                    <dd class="accordion-contents"> <!--用語の定義・内容-->
                        <ul>
                            <li><a href="/top">HOME</a></li>
                            <li><a href="/profile">プロフィール編集</a></li>
                            <li><a href="/logout">ログアウト</a></li>
                        </ul>
                    </dd>
                    </dt>
                </dl>
            </div>
        </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>〇〇さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="/followList">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>

</html>
