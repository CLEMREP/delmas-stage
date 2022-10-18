<?php

use App\Http\Controllers\Student\Contact\ContactController as StudentContactController;
use App\Http\Controllers\Student\Goal\GoalController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\Message\MessageController;
use App\Http\Controllers\Student\Procedure\ProcedureController as StudentProcedureController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('student.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');

        Route::name('procedures.')->group(function () {
            Route::get('/mes-demarches', [StudentProcedureController::class, 'index'])->name('index');
            Route::get('/mes-demarches/creation', [StudentProcedureController::class, 'create'])->name('create');
            Route::post('/mes-demarches/creation', [StudentProcedureController::class, 'store'])->name('store');
            Route::post('/mes-demarches/supprimer/{procedure}', [StudentProcedureController::class, 'destroy'])->name('destroy');
            Route::get('/mes-demarches/fiche/{procedure}', [StudentProcedureController::class, 'show'])->name('show');
            Route::get('/mes-demarches/edition/{procedure}', [StudentProcedureController::class, 'edit'])->name('edit');
            Route::post('/mes-demarches/edition/{procedure}', [StudentProcedureController::class, 'update'])->name('update');
        });

        Route::name('companies.')->group(function () {
            Route::get('/mes-entreprises', [CompanyController::class, 'index'])->name('index');
            Route::get('/mes-entreprises/creation', [CompanyController::class, 'create'])->name('create');
            Route::post('/mes-entreprises/creation', [CompanyController::class, 'store'])->name('store');
            Route::post('/mes-entreprises/supprimer/{company}', [CompanyController::class, 'destroy'])->name('destroy');
            Route::get('/mes-entreprises/fiche/{company}', [CompanyController::class, 'show'])->name('show');
            Route::get('/mes-entreprises/edition/{company}', [CompanyController::class, 'edit'])->name('edit');
            Route::post('/mes-entreprises/edition/{company}', [CompanyController::class, 'update'])->name('update');
        });

        Route::name('contacts.')->group(function () {
            Route::get('/mes-contacts', [StudentContactController::class, 'index'])->name('index');
            Route::get('/mes-contacts/creation', [StudentContactController::class, 'create'])->name('create');
            Route::post('/mes-contacts/creation', [StudentContactController::class, 'store'])->name('store');
            Route::post('/mes-contacts/supprimer/{contact}', [StudentContactController::class, 'destroy'])->name('destroy');
            Route::get('/mes-contacts/fiche/{contact}', [StudentContactController::class, 'show'])->name('show');
            Route::get('/mes-contacts/edition/{contact}', [StudentContactController::class, 'edit'])->name('edit');
            Route::post('/mes-contacts/edition/{contact}', [StudentContactController::class, 'update'])->name('update');
        });
    });

    Route::get('/objectifs', [GoalController::class, 'index'])->name('goals.index');

    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::post('/message', [MessageController::class, 'send'])->name('message.send');

    Route::get('/mon-compte', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/mon-compte', [AccountController::class, 'update'])->name('account.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
