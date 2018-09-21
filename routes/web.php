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

Route::get('/', function () {
    return redirect('/post');
});

//Route::get('/pages/add', function () {
//    return view('pages.add');
//});
Route::get('/post/latest/{page}', 'PostController@latestPost');
Route::get('/post/top/{page}', 'PostController@topPost');
Route::get('/post/popular/{page}', 'PostController@popularPost');
Route::get('/post/trending/{page}', 'PostController@trendingPost');
Route::get('/post/web', 'PostController@webPost');
Route::get('/post/images', 'PostController@imagesPost');
Route::get('/post/videos', 'PostController@videosPost');
Route::get('/post/articles', 'PostController@articlesPost');
Route::get('/post/lists', 'PostController@listsPost');
Route::get('/post/polls', 'PostController@pollsPost');


Route::get('/pages/all', function () {
    return view('pages.all');
});
Route::get('/pages/blog', function () {
    return view('pages.blog');
});
Route::get('/pages/signin', function () {
    return view('auth.login');
});
Route::get('/pages/register', function () {
    return view('pages.register');
});
Route::get('/pages/about', function () {
    return view('pages.about');
});
Route::get('/pages/privacy', function () {
    return view('pages.privacy');
});
Route::get('/pages/support', function () {
    return view('pages.support');
});

Route::resource('/post', 'PostController');

Route::get('/post/{post}/{title}', 'PostController@showPost');
Route::get('/post/{id}/story/view', 'PostController@viewPost');

Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/addPost', 'PostController@store')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/category', 'CategoryController');
    Route::resource('/user/profile', 'ProfileController');
    Route::get('/user/posts', 'ProfileController@userPosts');
    Route::get('/user/settings', 'ProfileController@settings');
    Route::get('/user/change_password', 'ProfileController@change_password');
    Route::post('/user/changePassword', [
        'uses' => 'ProfileController@changePassword',
        'as' => 'password-reset'
    ]);
    Route::get('/user/social_info', 'ProfileController@social_info');
    Route::post('/user/socialInfo', [
        'uses' => 'ProfileController@socialInfo',
        'as' => 'socialInfo'
    ]);
    Route::post('/user/profilePictureUpload', [
        'uses' => 'ProfileController@profilePictureUpload',
        'as' => 'profilePictureUpload'
    ]);
    Route::resource('/vote', 'VoteController');
    Route::resource('/comment', 'CommentController');
    Route::resource('/reply', 'ReplyController');
    Route::resource('/image', 'ImageController');
    Route::resource('/video', 'VideoController');
    Route::resource('/article', 'ArticleController');
    Route::post('/vote/downVote', 'VoteController@downVote');
    Route::resource('/saveStory', 'savedStoriesController');
    Route::get('/saved', 'PostController@savedPost');
    Route::resource('/folder', 'FolderController');
    Route::get('updateFolder', 'FolderController@updateFolder');
    Route::get('deleteFolder', 'FolderController@deleteFolder');
    Route::get('/folders', 'FolderController@allFolders');
    Route::get('/user/notifications', 'PostController@notifications');
    Route::resource('/folderStory', 'FolderStoryController');
    Route::resource('/poll', 'PollController');
    Route::resource('/list', 'ListController');
    Route::resource('/poll_item', 'PollItemController');
    Route::resource('/poll_vote', 'PollVoteController');
    Route::get('/markAsRead', function () {
        auth()->user()->unreadNotifications->markAsRead();
    });


});