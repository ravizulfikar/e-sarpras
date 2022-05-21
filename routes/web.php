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
use App\Http\Controllers\ESarpras\MenuConfigurationController as MenuConfiguration;
use App\Http\Controllers\ESarpras\ClientController as Client;
use App\Http\Controllers\ESarpras\TicketController as Ticket;
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

    Route::resource('menu', MenuConfiguration::class);

    // Route::get('/holiday', function () { dd("holiday"); })->name('holiday.index');
    Route::resource('ticket', Ticket::class);
    Route::group(['prefix' => 'ticket'], function () {

        Route::put('reset/{ticket}', [Ticket::class, 'reset'])->name('ticket.reset');

        Route::get('get/onprocess', [Ticket::class, 'admin_main'])->name('entry.admin.ticket');
        Route::get('get/onprocess/{ticket}', [Ticket::class, 'admin_view'])->name('entry.admin.view');

        // Route::get('by/{status}', [Ticket::class, 'byStatus'])->name('status');
        Route::get('get/entry', [Ticket::class, 'entry'])->name('entry.ticket');
        Route::put('get/entry/{ticket}', [Ticket::class, 'entry_update'])->name('entry.update');

        Route::get('get/process', [Ticket::class, 'process'])->name('process.ticket');
        Route::get('get/process/{ticket}', [Ticket::class, 'process_edit'])->name('process.edit');
        Route::put('get/process/{ticket}', [Ticket::class, 'process_update'])->name('process.update');
        Route::put('delete/process/{ticket}', [Ticket::class, 'process_delete'])->name('process.delete');
        Route::put('finish/process/{ticket}', [Ticket::class, 'process_finish'])->name('process.finish');
        Route::put('process/sign/{signer}', [Ticket::class, 'signed_ticket'])->name('process.signer');
        Route::post('process/add-user', [Ticket::class, 'add_user_ticket'])->name('process.addUser');
        Route::delete('process/delete-user/{UserTicket}', [Ticket::class, 'delete_user_ticket'])->name('process.deleteUser');

        // Route::get('get/finish', [Ticket::class, 'finish'])->name('finish.ticket');
        // Route::get('get/process/{ticket}', [Ticket::class, 'process_edit'])->name('process.edit');
    });
    // Route::get('/ticket/entry', function () { dd("ticketing"); })->name('ticket.entry');
    // Route::get('/ticket/process', function () { dd("process"); })->name('ticket.process');
    // Route::get('/ticket/finish', function () { dd("finish"); })->name('ticket.finish');

    Route::get('/report/daily', function () { dd("daily"); })->name('report.daily');
    Route::get('/report/picture', function () { dd("picture"); })->name('report.pictures');
    Route::get('/report/download', function () { dd("download"); })->name('report.download');
});


Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
    Route::get('user/create', [Ticket::class, 'createUser'])->name('createUser');
    Route::post('user/store', [Ticket::class, 'storeUser'])->name('storeUser');
    Route::get('user/history', [Ticket::class, 'historyUser'])->name('historyUser');
    Route::post('user/history-get', [Ticket::class, 'historyGetUser'])->name('historyGetUser');
});


// Route::get('/create-ticket', function () {
//     return view('e-sarpras.create-ticket',[
//         'paramsType' => \DB::table('params')->whereSlug('type-ticket')->first()
//     ]);
// })->name('create-ticket');

Route::get('fetch/wilayah/{city}', [Client::class, 'getWilayah'])->name('fetch.wilayah');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
