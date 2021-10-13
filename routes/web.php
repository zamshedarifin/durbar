<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
//    Artisan::call('config:cache');
    return redirect()->to('/');
});



Route::group(['middleware'=>'HtmlMinify'],function () {

    Route::get('/sss', function () {
        return \Illuminate\Support\Facades\Hash::make('durbar');
    });
    Route::get('/ban', function () {
        return view('user-panel.user_ban');
    });
    Route::namespace('Front')->group(function () {
        Route::get('/', 'FrontController@index')->name('front.index');
        Route::get('/campaign', 'FrontController@campaign')->name('front.campaign');
        Route::get('/campaign/{slug}', 'FrontController@campaignDetails')->name('front.campaign-details');
        Route::get('/story/{slug}', 'FrontController@story')->name('front.story-details');
        Route::get('/competition/{slug}', 'FrontController@competition')->name('front.competition-details');
        Route::match(['GET', 'POST'], '/testing', 'FrontController@testing');
        Route::match(['GET', 'POST'], '/ambassador', 'FrontController@ambassador')->name('front.ambassador');
        Route::match(['GET', 'POST'], '/career_camp', 'FrontController@careerCamp')->name('front.career-camp');
        Route::get('/training', 'FrontController@training')->name('front.training');

        Route::get('/about', 'FrontController@about')->name('front.about');
        Route::get('/photo-gallery', 'FrontController@photoGallery')->name('photo.gallery');
        Route::get('/photo/{slug}', 'FrontController@albumDetails')->name('album.details');

        Route::get('/mxx', 'FrontController@sendMail');
        Route::get('/events', 'FrontController@event')->name('front.event');
        Route::get('/event/{slug}', 'FrontController@eventDetails')->name('event.details');
        Route::match(['GET', 'POST'], '/contact', 'FrontController@contact')->name('front.contact');
        Route::get('/login/registration', 'FrontController@loginRegistration')->name('login.registration');
        Route::get('/upazila/{id}', 'FrontController@upazila')->name('upazila.list');
        Route::get('/union/{id}', 'FrontController@union')->name('union.list');
        Route::get('/share/result/{id}', 'FrontController@shareResult')->name('share.result');
    });

    Auth::routes(['verify' => true]);
    Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
    Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

    Route::group(['middleware' => ['auth','checkauth']], function () {
//        Route::group(['middleware'=>'checkauth'], function(){

            Route::get('/dashboard', 'HomeController@index')->name('dashboard');

            //Campaign Enroll
            Route::get('/campaign/{id}/enroll', 'HomeController@campaignEnroll')->name('campaign.enroll');
            //profile update
            Route::match(['GET','POST'],'profile','HomeController@profile')->name('user.profile');
            Route::post('change/password','HomeController@changePassword')->name('user.change.password');

            Route::get('result','QuizController@result')->name('result');
            Route::get('result/show/{id}','QuizController@resultView')->name('result.view');

            Route::get('/question/{id}', 'QuizController@Question')->name('front.quiz');
            Route::post('/quiz/give', 'QuizController@participate')->name('front.quizGive');
            Route::get('/quiz', 'QuizController@quiz')->name('user.quiz');
            Route::get('previous/quiz/{id}', 'QuizController@previousQuiz')->name('previous.quiz');
//        });
    });


//Admin Routes
    Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'Admin\LoginController@login');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function () {
        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
            Route::get('/users', 'DashboardController@users')->name('user.list');
            Route::get('/ban/{id}', 'DashboardController@banUser')->name('ban.user');




            Route::match(['GET', 'POST'], '/user/{id}/edit', 'DashboardController@userEdit')->name('user.edit');
            Route::get('/user/{id}', 'DashboardController@userShow')->name('user.info');
            Route::get('/delete/{id}/user', 'DashboardController@userDelete')->name('user.delete');
            Route::get('/user/{id}/{status}', 'DashboardController@userStatus')->name('user.status');
            //Feedback route
            Route::get('/feedback', 'DashboardController@feedback')->name('feedback');
            Route::match(['get','post'],'/feedback/reply/{id}', 'DashboardController@replyFeedback')->name('feedback.reply');
            Route::get('/feedback/show/{id}', 'DashboardController@showFeedback')->name('feedback.show');
            Route::get('/feedback/destroy/{id}', 'DashboardController@feedbackDestroy')->name('feedback.destroy');
            //Profile Route
            Route::match(['GET', 'POST'], '/profile', 'DashboardController@profile')->name('profile');
            Route::post('/change/password', 'DashboardController@changePassword')->name('change.password');
//        Union Route
            Route::get('/union/ward', 'DashboardController@unionWard')->name('union.ward');
            Route::match(['GET', 'POST'], '/create/union/ward', 'DashboardController@createUnion')->name('create.union');
            route::get('/delete/{id}/union', 'DashboardController@deleteUnion')->name('delete.union');

            Route::get('/campaigns', 'CampaignController@index')->name('campaign');
            Route::match(['GET', 'POST'], 'create/campaign', 'CampaignController@create')->name('create.campaign');
            Route::match(['GET', 'POST'], 'campaign/{id}/edit', 'CampaignController@edit')->name('edit.campaign');
            Route::get('/campaign/{id}/delete', 'CampaignController@delete')->name('delete.campaign');
            Route::get('/campaign/enroll/{id}', 'CampaignController@campaignEnroll')->name('campaign.enroll');
            Route::match(['GET', 'POST'], '/add/{id}/story', 'CampaignController@addStory')->name('add.story');
            //Campaign Story
            Route::get('/stories', 'StoryController@index')->name('stories');
            Route::match(['GET', 'POST'], '/create/story', 'StoryController@create')->name('create.story');
            Route::match(['GET', 'POST'], 'story/{id}/edit', 'StoryController@edit')->name('edit.story');
            Route::get('/story/{id}/delete', 'StoryController@delete')->name('delete.story');
            //Campaign Competition
            Route::get('/competitions', 'CompetitionController@index')->name('competitions');
            Route::match(['GET', 'POST'], '/create/competition', 'CompetitionController@create')->name('create.competition');
            Route::match(['GET', 'POST'], 'competition/{id}/edit', 'CompetitionController@edit')->name('edit.competition');
            Route::get('/competition/{id}/delete', 'CompetitionController@destroy')->name('delete.competition');

            Route::get('/quizzes', 'QuizController@index')->name('quiz.list');
            Route::match(['GET', 'POST'], '/create/quiz', 'QuizController@create')->name('create.quiz');
            Route::match(['GET', 'POST'], '/edit/{id}/quiz', 'QuizController@edit')->name('edit.quiz');
            Route::get('/delete/{id}/quiz', 'QuizController@destroy')->name('delete.quiz');
            Route::get('/marksheet/{id}', 'QuizController@Mark')->name('quiz.mark');
            Route::get('/marksheet-delete/{id}', 'QuizController@marksheetDelete')->name('marksheet.delete');


            Route::get('/questions', 'QuestionController@index')->name('question.list');
            Route::match(['GET', 'POST'], '/add/question', 'QuestionController@create')->name('create.question');
            Route::match(['GET', 'POST'], '/edit/{id}/question', 'QuestionController@edit')->name('edit.question');
            Route::get('/delete/{id}/question', 'QuestionController@destroy')->name('delete.question');
            Route::match(['GET', 'POST'],'/csv/import', 'QuestionController@ImportCSV')->name('question.import');

            //Event Routes
            Route::get('/events', 'EventController@index')->name('events');
            Route::match(['GET', 'POST'], '/add/events', 'EventController@create')->name('create.event');
            Route::match(['GET', 'POST'], '/edit/{id}/events', 'EventController@edit')->name('edit.event');
            Route::get('/delete/{id}/events', 'EventController@destroy')->name('delete.event');

            Route::resources([
                'album' => 'GalleryController',
            ]);
            Route::get('/album/add-photo/{album_id}', 'GalleryController@albumPhotoAdd')->name('album.photo-add');
            Route::get('/album/{id}/delete', 'GalleryController@destroy')->name('album.delete');
            Route::get('/photo/{id}/delete', 'GalleryController@photoDestroy')->name('photo.delete');
            Route::post('/photo/store/album', 'GalleryController@photoStore')->name('photo.store');

            Route::get('/ambassadors', 'AmbassadorController@index')->name('ambassador.list');
            Route::get('/ambassador/{id}/show', 'AmbassadorController@show')->name('ambassador.show');
            Route::get('ambassador/{status}/{id}', 'AmbassadorController@status')->name('ambassador.status');

            Route::get('/careercamp', 'CareercampController@index')->name('careercamp.list');
            Route::get('/careercamp/{id}/show', 'CareercampController@show')->name('careercamp.show');
            Route::get('mail-send/{id}', 'CareercampController@SendMail')->name('send.mail');
            Route::get('careercamp/destroy/{id}', 'CareercampController@careercampDestroy')->name('careercamp.destroy');
            Route::get('/export', 'CareercampController@export')->name('select.export');
            Route::get('/select-mail', 'CareercampController@selectMail')->name('select.mail');
        });

    });
});
/*Route::get('testing',function (){
    return App\Campaign::orderBy('cam_date', 'asc')
        ->where('status', '1')->limit(3)->get('id');

});*/

/*Route::get('/remove-quiz',function (){
   $marks = App\Mark::where('is_submit',0)
       ->where('created_at','like','%'.'2021-01-25'.'%')
       ->get();
   return $marks;
});*/
Route::get('/our_backup_database', 'Front\FrontController@our_backup_database')->name('our_backup_database');