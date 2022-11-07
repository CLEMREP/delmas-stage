<?php

use App\Http\Controllers\Student\Account\AccountController as StudentAccountController;
use App\Http\Controllers\Student\Company\CompanyController as StudentCompanyController;
use App\Http\Controllers\Student\Contact\ContactController as StudentContactController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\Message\MessageController as StudentMessageController;
use App\Http\Controllers\Student\Procedure\ProcedureController as StudentProcedureController;
use App\Http\Controllers\Student\Goal\GoalController as StudentGoalController;
use App\Http\Controllers\Teacher\Procedure\ProcedureController as TeacherProcedureController;
use App\Http\Controllers\Teacher\Account\AccountController as TeacherAccountController;
use App\Http\Controllers\Teacher\Student\StudentController as TeacherStudentController;
use App\Http\Controllers\Teacher\Goal\GoalController as TeacherGoalController;
use App\Http\Controllers\Teacher\Message\MessageController as TeacherMessageController;
use App\Http\Controllers\Teacher\TeacherController;
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
Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('student.')->middleware('student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');

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
            Route::get('/mes-entreprises', [StudentCompanyController::class, 'index'])->name('index');
            Route::get('/mes-entreprises/creation', [StudentCompanyController::class, 'create'])->name('create');
            Route::post('/mes-entreprises/creation', [StudentCompanyController::class, 'store'])->name('store');
            Route::post('/mes-entreprises/supprimer/{company}', [StudentCompanyController::class, 'destroy'])->name('destroy');
            Route::get('/mes-entreprises/fiche/{company}', [StudentCompanyController::class, 'show'])->name('show');
            Route::get('/mes-entreprises/edition/{company}', [StudentCompanyController::class, 'edit'])->name('edit');
            Route::post('/mes-entreprises/edition/{company}', [StudentCompanyController::class, 'update'])->name('update');
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

        Route::name('account.')->group(function () {
            Route::get('/mon-compte', [StudentAccountController::class, 'edit'])->name('edit');
            Route::post('/mon-compte', [StudentAccountController::class, 'update'])->name('update');
        });

        Route::name('goals.')->group(function () {
            Route::get('/objectifs', [StudentGoalController::class, 'index'])->name('index');
        });

        Route::name('message.')->group(function () {
            Route::get('/message', [StudentMessageController::class, 'index'])->name('index');
        });
    });




    Route::name('teacher.')->middleware('teacher')->prefix('/tableau-de-bord/')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');

        Route::name('student.')->group(function () {
            Route::get('/mes-eleves', [TeacherStudentController::class, 'index'])->name('index');
            Route::get('/mes-eleves/fiche/{student}', [TeacherStudentController::class, 'show'])->name('show');
            Route::get('/mes-eleves/edition/{student}', [TeacherStudentController::class, 'edit'])->name('edit');
            Route::post('/mes-eleves/edition/{student}', [TeacherStudentController::class, 'update'])->name('update');
        });

        Route::name('procedure.')->group(function () {
            Route::get('/suivi-des-demarches', [TeacherProcedureController::class, 'index'])->name('index');
            Route::get('/suivi-des-demarches/fiche/{procedure}', [TeacherProcedureController::class, 'show'])->name('show');
        });

        Route::name('account.')->group(function () {
            Route::get('/mon-compte', [TeacherAccountController::class, 'edit'])->name('edit');
            Route::post('/mon-compte', [TeacherAccountController::class, 'update'])->name('update');
        });

        Route::name('goals.')->group(function () {
            Route::get('/objectifs', [TeacherGoalController::class, 'index'])->name('index');
            Route::get('/objectifs/creation', [TeacherGoalController::class, 'create'])->name('create');
            Route::post('/objectifs/creation', [TeacherGoalController::class, 'store'])->name('store');
            Route::get('/objectifs/edition/{goal}', [TeacherGoalController::class, 'edit'])->name('edit');
            Route::post('/objectifs/edition/{goal}', [TeacherGoalController::class, 'update'])->name('update');
            Route::post('/objectifs/supprimer/{goal}', [TeacherGoalController::class, 'destroy'])->name('destroy');
        });

        Route::name('message.')->group(function () {
            Route::get('/message', [TeacherMessageController::class, 'index'])->name('index');
        });
    });
});

Route::get('/admin', function () { return "Hello"; })->name('un');

require __DIR__.'/auth.php';