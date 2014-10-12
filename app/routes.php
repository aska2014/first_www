<?php

Route::get('/no-access', ['as' => 'noaccess', function() {
    dd('You don\'t have access to this resource');
}]);


Route::get('login', ['as' => 'login', function() {
    dd("Login page");
}]);

Route::get('/test-validation', function() {
    $validator = Validator::make(array(
        'email' => 'asdf',
    ), array(
        'email' => 'required|email',
        'username' => 'required'
    ));

    return $validator->messages();
});


Route::get('/get-twitter', function() {

});


/// Site routes
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/products.html', ['as' => 'products', 'uses' => 'ProductsController@index']);
Route::get('/{category}/products.html', ['as' => 'product.category', 'uses' => 'ProductsController@category']);
Route::get('/product/{product}.html', ['as' => 'product', 'uses' => 'ProductsController@show']);

Route::get('/services.html', ['as' => 'services', 'uses' => 'ServicesController@index']);
Route::get('/{service}/services.html', ['as' => 'service.category', 'uses' => 'ServicesController@category']);
Route::get('/service/{service}.html', ['as' => 'service', 'uses' => 'ServicesController@show']);

Route::get('/projects.html', ['as' => 'projects', 'uses' => 'ProjectsController@index']);
Route::get('/projects/{project}.html', ['as' => 'project', 'uses' => 'ProjectsController@show']);

Route::get('/news/{news}.html', ['as' => 'news', 'uses' => 'NewsController@show']);

Route::get('/p/{page}.html', ['as' => 'page', 'uses' => 'PageController@show']);

Route::get('/contact-us.html', ['as' => 'contact_us', 'uses' => 'ContactUsController@index']);
Route::post('/send-us-message', ['as' => 'contact.submit', 'uses' => 'ContactUsController@send']);

Route::get('change-language/{lan}', ['as' => 'language', function($lan) {

    App::make('Aska\Language')->set($lan);

    return Redirect::back();
}]);




// Shared Api
Route::group(['prefix' => 'shared/api/v1', 'namespace' => 'SharedApi'], function() {

    // Email validation routes
    Route::post('email-validation/send-email', 'EmailValidationController@sendEmail');
    Route::get('email-validation/validate/{user}', ['uses' => 'EmailValidationController@validateUser', 'as' => 'email.validate']);

    // Login and logout user to our app
    Route::post('session/login', 'SessionController@login');
    Route::post('session/logout', 'SessionController@logout');

    // Register new user
    Route::post('user/register', 'UserController@register');

    Route::get('session/logout', 'SessionController@logout');

    Route::group(['before' => 'auth|checkIn'], function() {

        Route::put('user/accept/{user}', 'UserController@accept');
        Route::put('user/refuse/{user}', 'UserController@refuse');
        Route::get('user/session', 'UserController@session');
        Route::resource('user', 'UserController');
        Route::resource('notification', 'NotificationController');

        Route::resource('department', 'DepartmentController');

        Route::get('drive/main', 'DriveController@main');
        Route::resource('drive', 'DriveController');
        Route::resource('drive.file', 'FileController');

        Route::get('permission/bms', 'PermissionController@bms');
        Route::get('permission/site', 'PermissionController@site');
    });
});






// BMS (Business Management System) Api
Route::group(['prefix' => 'bms/api/v1', 'before' => 'auth|checkIn', 'namespace' => 'BMSApi'], function() {

    Route::put('project/accept', 'ProjectController@accept');
    Route::put('project/refuse', 'ProjectController@refuse');
    Route::resource('project', 'ProjectController');

    Route::resource('project.comment', 'ProjectCommentController');
});







// Site management system
Route::group(['namespace' => 'SiteApi', 'prefix' => 'site/api/v1', 'before' => 'auth|checkIn'], function() {

    /// Image handlers
    Route::post('image/project/{project}', 'ImageController@project');
    Route::post('image/product/{product}', 'ImageController@product');
    Route::post('image/product-category/{product_category}', 'ImageController@productCategory');
    Route::post('image/service/{service}', 'ImageController@service');
    Route::post('image/service-category/{service_category}', 'ImageController@serviceCategory');
    Route::post('image/slider-item/{slider_item}', 'ImageController@sliderItem');
    Route::post('image/page-section/{page_section}', 'ImageController@pageSection');
    Route::post('image/news/{news}', 'ImageController@news');
    Route::delete('image/{image}', 'ImageController@destroy');
    Route::delete('image/all/{ids}', 'ImageController@destroyAll');


    Route::resource('product', 'ProductController');
    Route::resource('product-category', 'ProductCategoryController');
    Route::resource('service', 'ServiceController');
    Route::resource('service-category', 'ServiceCategoryController');
    Route::resource('project', 'ProjectController');
    Route::resource('slider', 'SliderController');
    Route::resource('slider-item', 'SliderItemController');
    Route::resource('info-slider', 'InfoSliderController');
    Route::resource('contact-detail', 'ContactDetailController');
    Route::resource('page', 'PageController');
    Route::resource('news', 'NewsController');
    Route::resource('branch', 'CompanyBranchController');
    Route::resource('contact-email', 'ContactEmailController');

});


// Binding models for shared api
Route::model('user', 'Aska\Membership\Models\User');
Route::model('notification', 'Aska\Social\Models\Notification');
Route::model('drive', 'Aska\Drive\Models\Drive');
Route::model('file', 'Aska\Drive\Models\File');
Route::model('department', 'Aska\BMS\Models\Department');
Route::model('image', 'Aska\Media\Models\Image');





// Binding to models for bms api
if(0 === strpos(Request::path(), 'bms')) {
    Route::model('project', 'Aska\BMS\Models\Project');
    Route::model('comment', 'Aska\BMS\Models\ProjectComment');
}






// Binding to models for site api
if(0 === strpos(Request::path(), 'site')) {
    Route::model('project', 'Aska\Site\Models\Project');
    Route::model('product', 'Aska\Site\Models\Product');
    Route::model('product_category', 'Aska\Site\Models\ProductCategory');
    Route::model('service', 'Aska\Site\Models\Service');
    Route::model('service_category', 'Aska\Site\Models\ServiceCategory');
    Route::model('slider', 'Aska\Site\Models\Slider');
    Route::model('slider_item', 'Aska\Site\Models\SliderItem');
    Route::model('info_slider', 'Aska\Site\Models\InfoSlider');
    Route::model('contact_detail', 'Aska\Site\Models\ContactDetail');
    Route::model('page', 'Aska\Site\Models\Page');
    Route::model('page_section', 'Aska\Site\Models\PageSection');
    Route::model('news', 'Aska\Site\Models\News');
    Route::model('branch', 'Aska\Site\Models\CompanyBranch');
    Route::model('contact_email', 'Aska\Site\Models\ContactEmail');
}














Route::get('remove-me', function() {

    \Aska\Membership\Models\User::find(1)->delete();
});


Route::get('test', function() {

    // Set me administrator
//    $user = \Cane\Models\Membership\User::find(1);
//    $user->departments()->attach(1);

    $products = \Aska\Site\Models\Service::with('images')->get();

    foreach($products as $product)
    {
        foreach($product->images as $image)
        {
            echo('<img src="'.$image->addOperation('resize', 50, 50)->cached_url.'" />');
            exit();
        }
    }
});







// Command line
Route::get('command-line', function() {
    echo '<form method="POST">';
    echo '<input type="text" name="password" placeholder="password" />';
    echo '<input type="text" name="command" placeholder="command" />';
    echo '<input type="submit" />';
    echo '</form>';
});

Route::post('command-line', function() {
    if(Input::get('password') == 'my name is kareem mohamed aly elbahrawy') {
        if(Input::get('command') == 'reset') {
            Artisan::call('drop:db');
            Artisan::call('migrate --force');
            Artisan::call('db:seed --force');
        } else {
            Artisan::call(Input::get('command'));
        }
    }
});