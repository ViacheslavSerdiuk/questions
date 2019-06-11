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
if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', 'QuestionsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category/{slugcategory}','HomeController@category')->name('category.show');

Route::resource('questions','QuestionsController')->except('show');
//Route::post('/questions/{question}/answers','AnswersComntroller@store')->name('answers.store');
Route::resource('questions.answers','AnswersController')->except(['create','show']);
Route::get('/questions/{slug}','QuestionsController@show')->name('questions.show');
Route::post('/answers/{answer}/accept','AcceptAnswerController@store')->name('answers.accept');
Route::delete('/answers/{answer}/accept','AcceptAnswerController@destroy');

Route::post('/questions/{question}/favorites','FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorites','FavoritesController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote','VoteQuestionController')->name('questions.vote');
Route::post('/answers/{answer}/vote','VoteAnswerController')->name('answers.vote');

Route::group(['middleware'=>'auth'],function() {
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@store');


});
Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'admin'],function() {
    Route::resource('/categories','CategoriesController');
    Route::get('/', 'DashboardController@index');
    Route::resource('/questions','QuestionsController',['names'=>['index'=>'admin.questions.index',
        'destroy'=>'admin.questions.delete',
        'edit'=>'admin.questions.edit',
        'update'=>'admin.questions.update'
    ]])->only('index','destroy','edit','update');



    Route::get('/answers','AnswersController@index')->name('admin.answers.index');
    Route::delete('/answers/{id}/destroy','AnswersController@destroy')->name('admin.answers.destroy');


    Route::resource('/users','UsersController');
    Route::get('/settings','SettingsController@index')->name('admin.settings');
});

