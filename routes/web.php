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
  Route::get('/top', 'PostsController@index'); //取得する為
  Route::post('/top', 'PostsController@index'); //指定のルートへ

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
  Route::post('/post/create', 'PostsController@postCreate'); //登録するためのルーティング

  //投稿の編集機能
  Route::get('/post/{id}/update-post', 'PostsController@updateForm');
  //編集画面へ
  //GETで送られるパラメータを{変数名}で受け取る
  Route::post('/post/update', 'PostsController@update'); //更新後の表示

  //削除機能
  Route::get('/post/{id}/delete', 'PostsController@delete');
  //Route::post('/top', 'PostsController@delete');

  //検索機能
  Route::post('/search', 'UsersController@search');

  //フォロー機能
  Route::post('users/{user}/follow', 'UsersController@follow')->name('follow'); //viewでrouteへルパによってルーティングの表示をさせる
  //フォロー解除機能
  Route::post('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow'); //viewでrouteへルパによってルーティングの表示をさせる

  //プロフィール編集機能
  Route::post('/profile/{id}/update', 'UsersController@update');
});
