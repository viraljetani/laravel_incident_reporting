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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/
// Authentication Routes
Auth::routes();
// Homepage Route
Route::get('/', 'WelcomeController@welcome')->name('welcome');
//Route::get('/', 'DashboardController@dashboard')->name('welcome');

Route::get('/reports', 'PostController@reports')->name('reports');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/reports/incidents-by-district', 'PostController@reportsIncidentByDistrict')->name('reports.incident.by.district');
Route::get('/reports/incidents-by-type', 'PostController@reportsIncidentByType')->name('reports.incident.by.type');
Route::get('/reports/incident-victims', 'PostController@reportsIncidentVictims')->name('reports.incident.victims');
Route::get('/reports/incident-victims-gender', 'PostController@reportsVictimsGender')->name('reports.victims.by.gender');
Route::get('/reports/perpetrators-by-gender', 'PostController@reportsPerpetratorsGender')->name('reports.perpetrators.by.gender');
Route::get('/reports/perpetrators-of-incidents', 'PostController@reportsPerpetratorsIncidents')->name('reports.perpetrators.of.incidents');
Route::get('/reports/impact-by-incidents', 'PostController@reportsImpactIncidents')->name('reports.impact.by.incidents');
Route::get('/reports/incidents-over-days', 'PostController@reportsIncidentsDays')->name('reports.incidents.over.days');
Route::get('/reports/location-of-incidents', 'PostController@reportsLocationOfIncidents')->name('reports.incidents.location');
Route::get('/reports/responses-taken', 'PostController@reportsResponsesTaken')->name('reports.responses.taken');

Route::get('/organizations', 'OrganizationController@index')->name('organizations');


Route::get('/map', 'WelcomeController@welcome')->name('welcome');



Route::get('/reports/data', 'PostController@reports')->name('reports.data');
Route::get('/maps/data', 'PostController@mapsData')->name('maps.data');

// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
    Route::resource('events', 'EventController', [
        'names' => [
            'index'   => 'events',
            'create' => 'events.create',
            'edit' => 'events.edit',
            'update' => 'events.update',
        ],
        'except' => [],
    ]);
    Route::model('events', 'Event');

    
    Route::resource('posts', 'PostController', [
        'names' => [
            
            'edit' => 'posts.edit',
            'update' => 'posts.update',
            
            
        ],
        
        'except' => ['index','show','create','destroy'],
    ]);
    
    //Route::model('posts', 'Post');
});
Route::get('posts/data', 'PostController@index')->name('posts.data');
Route::get('posts/create', 'PostController@create')->name('posts.create');
Route::get('posts/{post}', 'PostController@show')->name('posts.show');
Route::get('posts/delete/{post}', 'PostController@destroy')->name('posts.destroy');
Route::redirect('/php', '/phpinfo', 301);
