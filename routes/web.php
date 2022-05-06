<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Auth\LoginController as Login;
use App\Http\Controllers\ESarpras\UserController as User;
use App\Http\Controllers\ESarpras\RoleController as Role;
use App\Http\Controllers\ESarpras\RegionController as Region;
use App\Http\Controllers\ESarpras\HolidayController as Holiday;
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

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
        abort(400);
    }   
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');


Route::get('layout-{light}', function($light){
    session()->put('layout', $light);
    session()->get('layout');
    if($light == 'vertical-layout')
    {
        return redirect()->route('pages-vertical-layout');
    }
    return redirect()->route('index');
    return 1;
});

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');


// Batas 

//Playground
Route::get('/playground', function () {
    $class = Menu::Render(config('sidebar.items'));
    // $class = Auth::user()->role->module;
    // $class = \App\Models\Role::findOrFail(1)->module;
    dd($class);
});

Route::get('/checkconfig', function () {
    dd(config('sidebar.items'));
});

Route::get('/', function () {
    return view('_landing');
})->name('/');

Route::get('/reload-captcha', [Login::class, 'reloadCaptcha']);
Route::post('/login/submit', [Login::class, 'loginAjax'])->name('loginAjax');


Auth::routes();

Route::middleware(['auth','verified'])->group(function () {

    Route::post('/changeTheme', function (Request $request) {

        $data = \DB::table('theme_user')->whereUserId($request->user_id)->update(['class' => $request->class]);

        if($data){
            return response()->json(["success" => true]);
        } else {
            return response()->json(["success" => false]);
        }

    })->name('changeTheme');

    Route::prefix('dashboard')->group(function () {
        Route::view('index', 'e-sarpras.dashboard.index')->name('index');
        Route::view('dashboard-02', 'e-sarpras.dashboard.dashboard-02')->name('dashboard-02');
    });

    //User
    Route::resource('user', User::class);
    Route::prefix('user')->group(function () {
        Route::get('account/{username}', [User::class, 'account'])->name('user.account');
        Route::get('account/{username}/edit', [User::class, 'account_edit'])->name('user.account_edit');
    });

    Route::resource('role', Role::class);

    Route::resource('region', Region::class);

    Route::resource('holiday', Holiday::class);
    Route::prefix('holiday')->group(function () {
        Route::get('fetch/data', [Holiday::class, 'synchronizeData'])->name('holiday.sync');
    });

    // Route::get('/holiday', function () { dd("holiday"); })->name('holiday.index');

    Route::get('/ticket', function () { dd("ticketing"); })->name('ticket.index');
    Route::get('/ticket/entry', function () { dd("ticketing"); })->name('ticket.entry');
    Route::get('/ticket/process', function () { dd("process"); })->name('ticket.process');
    Route::get('/ticket/finish', function () { dd("finish"); })->name('ticket.finish');

    Route::get('/report/daily', function () { dd("daily"); })->name('report.daily');
    Route::get('/report/picture', function () { dd("picture"); })->name('report.pictures');
    Route::get('/report/download', function () { dd("download"); })->name('report.download');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
