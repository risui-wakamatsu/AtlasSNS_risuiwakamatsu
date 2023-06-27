<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//データ処理全般、ルーティング(どこのURLと繋ぐか記述)


use App\Http\Controllers\PostsController;
//use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//auth認証


//ログアウト中のページ

Route::get('/login', 'Auth\LoginController@login')->name('auth.login'); //ルートに命名
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@registerView');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ


//Route::get('/', function () {
//return view('login');
//})->middleware('check');

//Route::get('/', function () {
//return view('index');
//});

Route::group(['middleware' => 'auth'], function () {
  //ログインしているユーザーにしか表示しない

  //トップページへ
  Route::get('/top', 'PostsController@indexName'); //取得する為
  Route::post('/top', 'PostsController@indexName'); //指定のルートへ

  //プロフィール編集ページへ
  Route::get('/profile', 'UsersController@profile');

  //ユーザー検索ページへ
  Route::get('/search', 'UsersController@search');

  Route::get('/follow-list', 'PostsController@followList');
  Route::get('/follower-list', 'PostsController@followerList');

  //ログアウト
  Route::get('/logout', 'PostsController@logout');

  //フォロー、フォロワーページへ
  Route::get('/followList', 'FollowsController@followList');
  Route::get('/followerList', 'FollowsController@followerList');

  //投稿の登録処理機能
  Route::get('/top', 'PostsController@indexPost'); //表示
  Route::post('/top', 'PostsController@postsCreate'); //登録
});
