<?php
 
# Route filters
Route::when('admin/*', 'admin');
Route::when('*', 'trick.view_throttle');

# Route patterns
Route::pattern('tag_slug', '[a-z0-9\-]+');
Route::pattern('trick_slug', '[a-z0-9\-]+');

# Admin routes
Route::group([ 'prefix' => 'admin', 'namespace' => 'Controllers\Admin' ], function () {
   
    Route::controller('tags', 'TagsController', [
        'getIndex' => 'admin.tags.index',
        'getView'  => 'admin.tags.view'
    ]);

    Route::controller('categories', 'CategoriesController', [
        'getIndex' => 'admin.categories.index',
        'getView'  => 'admin.categories.view'
    ]);

    Route::controller('users/jobseekerReport', 'JobSeekerRepController',[
        'getIndex' => 'admin.users.jobseekerReport.index',
        'getView'  => 'admin.users.jobseekerReport.view'
    ]);

    Route::controller('users/jobseeker', 'JobSeekerController',[
        'getIndex' =>  'admin.users.jobseeker.index',
        'getView'  =>  'admin.users.jobseeker.view'
    ]);

    Route::controller('users/company/{user}', 'CompanyInfoController',[
         'getIndex' =>  'admin.users.companyinfo.index',
         'getView'  =>  'admin.users.companyinfo.view'
    ]);

    Route::controller('users/jobOppRep', 'JobOppRepController',[
        'getIndex' =>  'admin.users.jobOppRep.index',
        'getView'  =>  'admin.users.jobOppRep.view'
    ]);

    Route::controller('users/jobopp', 'JobOppController',[
        'getIndex' =>  'admin.users.jobOpp.index',
        'getView'  =>  'admin.users.jobOpp.view'
    ]);

   

  
/*
    Route::controller('users', 'UsersController', [
        'getIndex' => 'admin.users.index',
        'getView'  => 'admin.users.view'



    ]);*/
    Route::get('users/list', [ 'as' => 'admin.users.list', 'uses' => 'UsersController@getIndex']);
    Route::post('users/list', [ 'as' => 'admin.users.list', 'uses' => 'UsersController@postIndex']);
    
   Route::get('tricks/list', [ 'as' => 'admin.tricks.list', 'uses' => 'TricksController@getIndex']);
    Route::post('tricks/list', [ 'as' => 'admin.tricks.list', 'uses' => 'TricksController@postIndex']);

   


/*
    Route::controller('tricks', 'TricksController', [
        'getIndex' => 'admin.tricks.index',
        'getView'  => 'admin.tricks.view'
    ]);
*/


});

Route::group([ 'namespace' => 'Controllers' ], function () {
    # Home routes
    Route::get('/', [ 'as' => 'browse.recent', 'uses' => 'BrowseController@getBrowseRecent' ]);
    Route::get('popular', [ 'as' => 'browse.popular', 'uses' => 'BrowseController@getBrowsePopular' ]);
    Route::get('comments', [ 'as' => 'browse.comments', 'uses' => 'BrowseController@getBrowseComments' ]);
    Route::get('about', [ 'as' => 'about', 'uses' => 'HomeController@getAbout' ]);

    # Trick routes
    Route::get('tricks/{trick_slug?}', [ 'as' => 'tricks.show', 'uses' => 'TricksController@getShow' ]);
    Route::post('tricks/{trick_slug}/like', [ 'as' => 'tricks.like', 'uses' => 'TricksController@postLike' ]);

    # Browse routes
    Route::get('categories', [ 'as' => 'browse.categories', 'uses' => 'BrowseController@getCategoryIndex']);
    Route::get('categories/{category_slug}', [
        'as'   => 'tricks.browse.category',
        'uses' => 'BrowseController@getBrowseCategory'
    ]);
    Route::get('tags', [ 'as' => 'browse.tags', 'uses' => 'BrowseController@getTagIndex' ]);
    Route::get('tags/{tag_slug}', [ 'as' => 'tricks.browse.tag', 'uses' => 'BrowseController@getBrowseTag' ]);

    # Search routes
    Route::get('search', 'SearchController@getIndex');

    # Sitemap route
    Route::get('sitemap', 'SitemapController@getIndex');
    Route::get('sitemap.xml', 'SitemapController@getIndex');

    # Authentication and registration routes
    Route::get('login', [ 'as' => 'auth.login', 'uses' => 'AuthController@getLogin' ]);
    Route::post('login', 'AuthController@postLogin');
    Route::get('login/github', [ 'as' => 'auth.login.github', 'uses' => 'AuthController@getLoginWithGithub' ]);
    Route::get('register', [ 'as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', 'AuthController@postRegister');
    Route::get('logout', [ 'as' => 'auth.logout', 'uses' => 'AuthController@getLogout' ]);

    # Password reminder routes
    Route::controller('password', 'RemindersController', [
        'getRemind' => 'auth.remind',
        'getReset'  => 'auth.reset'
    ]);

    # company profile routes
    Route::get('user', [ 'as' => 'user.index', 'uses' => 'UserController@getIndex' ]);
    Route::get('user/settings', [ 'as' => 'user.settings', 'uses' => 'UserController@getSettings' ]);
    Route::post('user/settings', 'UserController@postSettings');
    #Route::get('user/favorites', [ 'as' => 'user.favorites', 'uses' => 'UserController@getFavorites' ]);
    Route::post('user/avatar', [ 'as' => 'user.avatar', 'uses' => 'UserController@postAvatar' ]);
    
    # User profile routes
    Route::get('user', [ 'as' => 'user.index', 'uses' => 'UserController@getIndex' ]);
    Route::get('user/settings', [ 'as' => 'user.settings', 'uses' => 'UserController@getSettings' ]);
    Route::post('user/settings', 'UserController@postSettings');
    Route::get('user/favorites', [ 'as' => 'user.favorites', 'uses' => 'UserController@getFavorites' ]);
    Route::post('user/avatar', [ 'as' => 'user.avatar', 'uses' => 'UserController@postAvatar' ]);

   # cv creation route
    Route::get('user/cv/new', [ 'as' => 'cv.new', 'uses' => 'CvController@getcvNew' ]);
    Route::post('user/cv/new', 'CvController@postcvNew');
    
    Route::get('user/cv/update', [ 'as' => 'cv.edit', 'uses' => 'CvController@getcvUpdate' ]);
    Route::post('user/cv/update', 'CvController@postcvUpdate');

    # Trick creation route
    Route::get('user/tricks/new', [ 'as' => 'tricks.new', 'uses' => 'UserTricksController@getNew' ]);
    Route::post('user/tricks/new', 'UserTricksController@postNew');

    # Trick editing route
    Route::get('user/tricks/{trick_slug}', [ 'as' => 'tricks.edit', 'uses' => 'UserTricksController@getEdit' ]);
    Route::post('user/tricks/{trick_slug}', 'UserTricksController@postEdit');
    
     # Trick get Data list 
    Route::get('user/tricks/{trick_slug}/list', [ 'as' => 'tricks.applyreport', 'uses' => 'UserTricksController@getData' ]);
   
    # Trick delete route
    Route::get('user/tricks/{trick_slug}/delete', [ 'as' => 'tricks.delete', 'uses' => 'UserTricksController@getDelete' ]);

    # Feed routes
    Route::get('feed', [ 'as' => 'feed.atom', 'uses' => 'FeedsController@getAtom' ]);
    Route::get('feed.atom', [ 'uses' => 'FeedsController@getAtom' ]);
    Route::get('feed.xml', [ 'as' => 'feed.rss', 'uses' => 'FeedsController@getRss' ]);

    # This route will match the user by username to display their public profile
    # (if we want people to see who favorites and who posts what)
    Route::get('{user}', [ 'as' => 'user.profile', 'uses' => 'UserController@getPublic' ]);
    
});
