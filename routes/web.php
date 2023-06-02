<?php

use Illuminate\Foundation\Application;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/Aliados/Portal', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [Controllers\Usuarios\UsersController::class, 'redirectUser'])->name('dashboard');

    Route::group(['middleware' => ['role:admin']],function () {
        Route::get('/home', fn() => Inertia::render('Dashboard'))->name('home');

        Route::prefix('admin')->group(function () {
            /**rutas para gestion de usarios */
            Route::prefix('users')->group(function (){
                Route::get('/', [Controllers\Usuarios\UsersController::class, 'index'])->name('users.index');
                Route::get('/create', [Controllers\Usuarios\UsersController::class, 'create'])->name('users.create');
                Route::post('/insert', [Controllers\Usuarios\UsersController::class, 'insert'])->name('users.insert');
                Route::get('/edit', [Controllers\Usuarios\UsersController::class, 'edit'])->name('users.edit');
                Route::post('/update', [Controllers\Usuarios\UsersController::class, 'update'])->name('users.update');
                Route::post('/destroy', [Controllers\Usuarios\UsersController::class, 'destroy'])->name('users.destroy');
                Route::post('/import', [Controllers\Usuarios\UsersController::class, 'import'])->name('users.import');
                Route::post('/fillter', [Controllers\Usuarios\UsersController::class, 'fillter'])->name('users.fill');
            });
            /*rutas para gestion de liquidaciones y rutas*/
            Route::prefix('payings')->group(function (){
                Route::get('/liquidaciones', [Controllers\Payings\PayingsController::class, 'indexLiquidaciones'])->name('liquidacion.index');
                Route::get('/retenciones', [Controllers\Payings\PayingsController::class, 'indexRetenciones'])->name('retencion.index');
                Route::get('/churn', [Controllers\Payings\PayingsController::class, 'indexChurn'])->name('churn.index');
                Route::get('/createL', [Controllers\Payings\PayingsController::class, 'create'])->name('liquidacion.create');
                Route::get('/create', [Controllers\Payings\PayingsController::class, 'create'])->name('retencion.create');
                Route::get('/createchurn', [Controllers\Payings\PayingsController::class, 'createChurn'])->name('churn.create');

                Route::post('/insert', [Controllers\Payings\PayingsController::class, 'insert'])->name('payings.insert');
                Route::post('/insertchurn', [Controllers\Payings\PayingsController::class, 'insertChurn'])->name('churn.insert');
                Route::get('/edit', [Controllers\Payings\PayingsController::class, 'edit'])->name('payings.edit');
                Route::get('/editchurn', [Controllers\Payings\PayingsController::class, 'editChurn'])->name('churn.edit');
                Route::post('/update', [Controllers\Payings\PayingsController::class, 'update'])->name('payings.update');
                Route::post('/updatechurn', [Controllers\Payings\PayingsController::class, 'updateChurn'])->name('churn.update');
                Route::post('/destroy', [Controllers\Payings\PayingsController::class, 'destroy'])->name('payings.destroy');
                Route::post('/fillter', [Controllers\Payings\PayingsController::class, 'fillter'])->name('payings.fill');
            });
            Route::get('permisos', [Controllers\Seguridad\PermisosController::class, 'index'])->name('permisos.index');
        });
    });


    Route::get('/aliados', [Controllers\Aliados\AliadosController::class, 'index'])->name('aliados');
    Route::prefix('aliados')->group(function() {
        Route::get('/PQRS', fn() => Inertia::render('PQRS/index'))->name('pqrs');
        Route::get('/liquidaciones', [Controllers\Payings\PayingsController::class, 'indexLiquidaciones'])->name('liquidacion.aliados.index');
        Route::get('/retenciones', [Controllers\Payings\PayingsController::class, 'indexRetenciones'])->name('retencion.aliados.index');
        Route::get('/churn', [Controllers\Payings\PayingsController::class, 'indexChurn'])->name('churn.aliados.index');
    });
    Route::get('files_churn/{file_name}', [Controllers\Payings\PayingsController::class, 'descargar']);
    Route::get('files_liquidacion/{file_name}', [Controllers\Payings\PayingsController::class, 'descargarL']);
    Route::get('files_retencion/{file_name}', [Controllers\Payings\PayingsController::class, 'descargarR']);

});
