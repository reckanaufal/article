<?php

use Illuminate\Support\Facades\Route;

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

// Route::redirect('/', '/dashboard-general-dashboard');

// Dashboard
Route::get('/dashboard-general-dashboard', function () {
    return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
});
Route::get('/dashboard-ecommerce-dashboard', function () {
    return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
});


// Layout
Route::get('/layout-default-layout', function () {
    return view('tamplate.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('tamplate.blank-page', ['type_menu' => '']);
});

// ------------------------------------------BACKEND----------------------------------------------------

// login
Route::get('/', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('login.post');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::post('/forgetPassword', 'LoginController@forgetPassword')->name('login.forgetPassword');
Route::get('/auth-forgot-password', 'LoginController@viewForgetPassword');

Route::group(['middleware' => ['auth']], function () {
    //roles
    Route::get('/dashboard', 'LoginController@dashboard')->name('dashboard');
    //roles
    Route::resource('roles', 'RoleController');
    //user
    Route::resource('users', 'UserController');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/exportExcelUsers', 'UserController@exportExcel')->name('exportExcelUsers');
    Route::get('/exportPdfUsers', 'UserController@exportPdf')->name('exportPdfUsers');

});
// ------------------------------------------BACKEND----------------------------------------------------

// Bootstrap
Route::get('/bootstrap-alert', function () {
    return view('tamplate.bootstrap-alert', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-badge', function () {
    return view('tamplate.bootstrap-badge', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-breadcrumb', function () {
    return view('tamplate.bootstrap-breadcrumb', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-buttons', function () {
    return view('tamplate.bootstrap-buttons', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-card', function () {
    return view('tamplate.bootstrap-card', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-carousel', function () {
    return view('tamplate.bootstrap-carousel', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-collapse', function () {
    return view('tamplate.bootstrap-collapse', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-dropdown', function () {
    return view('tamplate.bootstrap-dropdown', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-form', function () {
    return view('tamplate.bootstrap-form', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-list-group', function () {
    return view('tamplate.bootstrap-list-group', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-media-object', function () {
    return view('tamplate.bootstrap-media-object', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-modal', function () {
    return view('tamplate.bootstrap-modal', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-nav', function () {
    return view('tamplate.bootstrap-nav', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-navbar', function () {
    return view('tamplate.bootstrap-navbar', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-pagination', function () {
    return view('tamplate.bootstrap-pagination', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-popover', function () {
    return view('tamplate.bootstrap-popover', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-progress', function () {
    return view('tamplate.bootstrap-progress', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-table', function () {
    return view('tamplate.bootstrap-table', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-tooltip', function () {
    return view('tamplate.bootstrap-tooltip', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-typography', function () {
    return view('tamplate.bootstrap-typography', ['type_menu' => 'bootstrap']);
});


// components
Route::get('/components-article', function () {
    return view('tamplate.components-article', ['type_menu' => 'components']);
});
Route::get('/components-avatar', function () {
    return view('tamplate.components-avatar', ['type_menu' => 'components']);
});
Route::get('/components-chat-box', function () {
    return view('tamplate.components-chat-box', ['type_menu' => 'components']);
});
Route::get('/components-empty-state', function () {
    return view('tamplate.components-empty-state', ['type_menu' => 'components']);
});
Route::get('/components-gallery', function () {
    return view('tamplate.components-gallery', ['type_menu' => 'components']);
});
Route::get('/components-hero', function () {
    return view('tamplate.components-hero', ['type_menu' => 'components']);
});
Route::get('/components-multiple-upload', function () {
    return view('tamplate.components-multiple-upload', ['type_menu' => 'components']);
});
Route::get('/components-pricing', function () {
    return view('tamplate.components-pricing', ['type_menu' => 'components']);
});
Route::get('/components-statistic', function () {
    return view('tamplate.components-statistic', ['type_menu' => 'components']);
});
Route::get('/components-tab', function () {
    return view('tamplate.components-tab', ['type_menu' => 'components']);
});
Route::get('/components-table', function () {
    return view('tamplate.components-table', ['type_menu' => 'components']);
});
Route::get('/components-user', function () {
    return view('tamplate.components-user', ['type_menu' => 'components']);
});
Route::get('/components-wizard', function () {
    return view('tamplate.components-wizard', ['type_menu' => 'components']);
});

// forms
Route::get('/forms-advanced-form', function () {
    return view('tamplate.forms-advanced-form', ['type_menu' => 'forms']);
});
Route::get('/forms-editor', function () {
    return view('tamplate.forms-editor', ['type_menu' => 'forms']);
});
Route::get('/forms-validation', function () {
    return view('tamplate.forms-validation', ['type_menu' => 'forms']);
});

// google maps
// belum tersedia

// modules
Route::get('/modules-calendar', function () {
    return view('tamplate.modules-calendar', ['type_menu' => 'modules']);
});
Route::get('/modules-chartjs', function () {
    return view('tamplate.modules-chartjs', ['type_menu' => 'modules']);
});
Route::get('/modules-datatables', function () {
    return view('tamplate.modules-datatables', ['type_menu' => 'modules']);
});
Route::get('/modules-flag', function () {
    return view('tamplate.modules-flag', ['type_menu' => 'modules']);
});
Route::get('/modules-font-awesome', function () {
    return view('tamplate.modules-font-awesome', ['type_menu' => 'modules']);
});
Route::get('/modules-ion-icons', function () {
    return view('tamplate.modules-ion-icons', ['type_menu' => 'modules']);
});
Route::get('/modules-owl-carousel', function () {
    return view('tamplate.modules-owl-carousel', ['type_menu' => 'modules']);
});
Route::get('/modules-sparkline', function () {
    return view('tamplate.modules-sparkline', ['type_menu' => 'modules']);
});
Route::get('/modules-sweet-alert', function () {
    return view('tamplate.modules-sweet-alert', ['type_menu' => 'modules']);
});
Route::get('/modules-toastr', function () {
    return view('tamplate.modules-toastr', ['type_menu' => 'modules']);
});
Route::get('/modules-vector-map', function () {
    return view('tamplate.modules-vector-map', ['type_menu' => 'modules']);
});
Route::get('/modules-weather-icon', function () {
    return view('tamplate.modules-weather-icon', ['type_menu' => 'modules']);
});

// auth
// Route::get('/auth-forgot-password', function () {
//     return view('tamplate.auth-forgot-password', ['type_menu' => 'auth']);
// });
Route::get('/auth-login', function () {
    return view('tamplate.auth-login', ['type_menu' => 'auth']);
});
Route::get('/auth-login2', function () {
    return view('tamplate.auth-login2', ['type_menu' => 'auth']);
});
Route::get('/auth-register', function () {
    return view('tamplate.auth-register', ['type_menu' => 'auth']);
});
Route::get('/auth-reset-password', function () {
    return view('tamplate.auth-reset-password', ['type_menu' => 'auth']);
});

// error
Route::get('/error-403', function () {
    return view('tamplate.error-403', ['type_menu' => 'error']);
});
Route::get('/error-404', function () {
    return view('tamplate.error-404', ['type_menu' => 'error']);
});
Route::get('/error-500', function () {
    return view('tamplate.error-500', ['type_menu' => 'error']);
});
Route::get('/error-503', function () {
    return view('tamplate.error-503', ['type_menu' => 'error']);
});

// features
Route::get('/features-activities', function () {
    return view('tamplate.features-activities', ['type_menu' => 'features']);
});
Route::get('/features-post-create', function () {
    return view('tamplate.features-post-create', ['type_menu' => 'features']);
});
Route::get('/features-post', function () {
    return view('tamplate.features-post', ['type_menu' => 'features']);
});
// Route::get('/features-profile', function () {
//     return view('tamplate.features-profile', ['type_menu' => 'features']);
// });
Route::get('/features-settings', function () {
    return view('tamplate.features-settings', ['type_menu' => 'features']);
});
Route::get('/features-setting-detail', function () {
    return view('tamplate.features-setting-detail', ['type_menu' => 'features']);
});
Route::get('/features-tickets', function () {
    return view('tamplate.features-tickets', ['type_menu' => 'features']);
});

// utilities
Route::get('/utilities-contact', function () {
    return view('tamplate.utilities-contact', ['type_menu' => 'utilities']);
});
Route::get('/utilities-invoice', function () {
    return view('tamplate.utilities-invoice', ['type_menu' => 'utilities']);
});
Route::get('/utilities-subscribe', function () {
    return view('tamplate.utilities-subscribe', ['type_menu' => 'utilities']);
});

// credits
Route::get('/credits', function () {
    return view('tamplate.credits', ['type_menu' => '']);
});
