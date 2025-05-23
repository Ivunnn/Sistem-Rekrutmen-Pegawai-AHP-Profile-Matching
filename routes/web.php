<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PresetPreferenceController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\AHPController;
use App\Http\Controllers\GapBobotController;
use App\Http\Controllers\ProfileMatchingController;
use App\Http\Controllers\UserMetodePembobotanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NilaiAktualController;
use App\Http\Controllers\NilaiIdealController;
use App\Http\Controllers\KandidatController;


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
use App\Http\Controllers\ContactController;

Route::post('/contact/submit', [ContactController::class, 'submit']);


Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/', function () {
    return view('landingpage');
});

Auth::routes();



Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/ahp/hitung', [AHPController::class, 'hitungAHP'])->name('ahp.calculate');
Route::post('/ahp/simpan-bobot', [AHPController::class, 'simpanBobotAHP'])->name('ahp.saveAHPResult');
Route::post('/ahp/simpan', [AHPController::class, 'simpanHasilAHP'])->name('ahp.simpan');
Route::get('/ahp/create', [AHPController::class, 'create'])->name('ahp.create');
Route::post('/ahp/store', [AHPController::class, 'store'])->name('ahp.store');

Route::prefix('ahp')->name('ahp.')->middleware(['auth'])->group(function () {
    Route::get('/', [AHPController::class, 'index'])->name('index');
    Route::get('/create', [AHPController::class, 'create'])->name('create');
    Route::post('/', [AHPController::class, 'store'])->name('store');
    Route::get('/{ahp}', [AHPController::class, 'show'])->name('show');
    Route::delete('/{ahp}', [AHPController::class, 'destroy'])->name('destroy');
});


Route::resource('kriteria', KriteriaController::class)->parameters([
    'kriteria' => 'kriteria'
]);
// Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');

Route::resource('nilai-ideal', \App\Http\Controllers\NilaiIdealController::class);


Route::get('/nilai-aktual', [NilaiAktualController::class, 'index'])->name('nilai-aktual.index');
Route::get('/nilai-aktual/{pegawai}/edit', [NilaiAktualController::class, 'edit'])->name('nilai-aktual.edit');
Route::get('/nilai-aktual/{pegawai}', [NilaiAktualController::class, 'show'])->name('nilai-aktual.show');
Route::post('/nilai-aktual/{pegawai}', [NilaiAktualController::class, 'update'])->name('nilai-aktual.update');


Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
        Route::resource('presetpreferences', PresetPreferenceController::class);

        Route::resource('pegawai', PegawaiController::class);

        Route::resource('ahp', AHPController::class, [
            'only' => ['index', 'create', 'store']
        ]);
        Route::get('/ahp/{ahp}', [AHPController::class, 'show'])->name('ahp.show');
        Route::get('/ahp/{ahp}/edit', [AHPController::class, 'edit'])->name('ahp.edit');
        Route::post('/ahp/{ahp}', [AHPController::class, 'update'])->name('ahp.update');
        Route::post('/ahp/t/{ahp}', [AHPController::class, 'toggle'])->name('ahp.toggle');
        Route::delete('/ahp/{ahp}', [AHPController::class, 'destroy'])->name('ahp.destroy');

        // Profile Matching Routes
        Route::get('/profile-matching', [ProfileMatchingController::class, 'index'])->name('profile-matching.index');
        Route::get('/profile-matching/{id}', [ProfileMatchingController::class, 'show'])->name('profile-matching.show');
        Route::get('/profile-matching-pdf', [ProfileMatchingController::class, 'generatePdf'])->name('profile-matching-pdf');

        // Gap Bobot Routes (optional, for managing gap weight conversion)
        Route::resource('gap-bobot', GapBobotController::class);

        Route::get('/profile-matching/calculate', [ProfileMatchingController::class, 'calculate'])->name('profile-matching.calculate');
        Route::get('/profile-matching/report', [ProfileMatchingController::class, 'report'])->name('profile-matching.report');
        Route::get('/profile-matching/pdf', [ProfileMatchingController::class, 'exportPdf'])->name('profile-matching.pdf');
        Route::get('profile-matching/report', [ProfileMatchingController::class, 'report'])->name('profile-matching.report');
        Route::get('profile-matching/download-pdf', [ProfileMatchingController::class, 'downloadPdf'])->name('profile-matching.download-pdf');


        // Verb          Path                        Action  Route Name
        // GET           /users                      index   users.index
        // GET           /users/create               create  users.create
        // POST          /users                      store   users.store
        // GET           /users/{user}               show    users.show
        // GET           /users/{user}/edit          edit    users.edit
        // PUT|PATCH     /users/{user}               update  users.update
        // DELETE        /users/{user}               destroy users.destroy

    });
    // -----------------
    // metode pembobotan
    // -----------------
    // Pembobotan AHP
    Route::get('user/bobot/ahp', [UserMetodePembobotanController::class, 'ahp_index'])->name('user.bobot.ahp.index');
    Route::get('user/bobot/ahp/create', [UserMetodePembobotanController::class, 'ahp_create'])->name('user.bobot.ahp.create');
    Route::post('user/bobot/ahp', [UserMetodePembobotanController::class, 'ahp_store'])->name('user.bobot.ahp.store');
    Route::get('user/bobot/ahp/{ahp}', [UserMetodePembobotanController::class, 'ahp_show'])->name('user.bobot.ahp.show');
    Route::get('user/bobot/ahp/{ahp}/edit', [UserMetodePembobotanController::class, 'ahp_edit'])->name('user.bobot.ahp.edit');
    Route::post('user/bobot/ahp/{ahp}', [UserMetodePembobotanController::class, 'ahp_update'])->name('user.bobot.ahp.update');
    Route::post('user/bobot/ahp/t/{ahp}', [UserMetodePembobotanController::class, 'ahp_toggle'])->name('user.bobot.ahp.toggle');
    Route::delete('user/bobot/ahp/{ahp}', [UserMetodePembobotanController::class, 'ahp_destroy'])->name('user.bobot.ahp.destroy');

    // Profile Matching Routes
    Route::get('/profile-matching/report', [App\Http\Controllers\ProfileMatchingController::class, 'report'])
        ->name('profile-matching.report');
    Route::get('/profile-matching/calculate', [App\Http\Controllers\ProfileMatchingController::class, 'calculate'])
        ->name('profile-matching.calculate');
    Route::get('/profile-matching/export-pdf', [App\Http\Controllers\ProfileMatchingController::class, 'exportPdf'])
        ->name('profile-matching.export-pdf');
    Route::get('/profile-matching/detail/{pegawai_id}', [App\Http\Controllers\ProfileMatchingController::class, 'showDetail'])
        ->name('profile-matching.detail');

    // Pembobotan Langsung
    Route::get('user/bobot/langsung', [UserMetodePembobotanController::class, 'langsung_index'])->name('user.bobot.langsung.index');
    Route::get('user/bobot/langsung/edit', [UserMetodePembobotanController::class, 'langsung_edit'])->name('user.bobot.langsung.edit');
    Route::post('user/bobot/langsung/edit', [UserMetodePembobotanController::class, 'langsung_update'])->name('user.bobot.langsung.update');

    Route::group(['middleware' => ['role:User|Admin']], function () {
        Route::get('/myprofile', [UserController::class, 'myProfile'])->name('myprofile.index');
        Route::get('/myprofile/edit', [UserController::class, 'myProfileEdit'])->name('myprofile.edit');
        Route::post('/myprofile/update', [UserController::class, 'myProfileUpdate'])->name('myprofile.update');
        Route::get('/myprofile/password', [UserController::class, 'getPassword'])->name('myprofile.changePassword.index');
        Route::post('/myprofile/change_password', [UserController::class, 'postPassword'])->name('myprofile.userPostPassword');

        Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas.index');
        Route::get('/berkas/create', [BerkasController::class, 'create'])->name('berkas.create');
        Route::post('/berkas', [BerkasController::class, 'store'])->name('berkas.store');
        // Berkas Pelamar
        Route::get('/berkas-pelamar', [PegawaiController::class, 'berkasIndex'])->name('berkas.index');
        Route::get('/berkas-pelamar/create', [PegawaiController::class, 'berkasCreate'])->name('berkas.create');
        Route::post('/berkas-pelamar/store', [PegawaiController::class, 'berkasStore'])->name('berkas.store');

        Route::get('/my-application', [App\Http\Controllers\PegawaiController::class, 'myApplication'])->name('pegawai.my-application');
        Route::get('/my-application/edit', [App\Http\Controllers\PegawaiController::class, 'editMyApplication'])->name('pegawai.edit-my-application');
        Route::put('/my-application', [App\Http\Controllers\PegawaiController::class, 'updateMyApplication'])->name('pegawai.update-my-application');

        // Route::resource('user/bobot/ahp', SearchController::class, [
        //     // 'except' => ['edit', 'create', 'update']
        //     'only' => ['index', 'store', 'show', 'destroy']
        // ]);
        // Route::resource('user/bobot/langsung', SearchController::class, [
        //     // 'except' => ['create', 'update', 'show', 'destroy']
        //     'only' => ['index', 'store', 'edit']
        // ]);        
    });

    Route::group(['middleware' => ['role:User']], function () {

    });

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

