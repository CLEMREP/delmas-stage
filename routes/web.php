<?php

use App\Http\Controllers\Admin\Account\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Company\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\Message\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\Procedure\ProcedureController as AdminProcedureController;
use App\Http\Controllers\Admin\Promotion\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\Student\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\Teacher\TeacherController as AdminTeacherController;
use App\Http\Controllers\Student\Account\AccountController as StudentAccountController;
use App\Http\Controllers\Student\Company\CompanyController as StudentCompanyController;
use App\Http\Controllers\Student\Contact\ContactController as StudentContactController;
use App\Http\Controllers\Student\Goal\GoalController as StudentGoalController;
use App\Http\Controllers\Student\Message\MessageController as StudentMessageController;
use App\Http\Controllers\Student\Procedure\ProcedureController as StudentProcedureController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\SuperAdmin\Account\AccountController as SuperAdminAccountController;
use App\Http\Controllers\SuperAdmin\Admin\AdminController as SuperAdminAdminController;
use App\Http\Controllers\SuperAdmin\Promotion\PromotionController as SuperAdminPromotionController;
use App\Http\Controllers\SuperAdmin\Serie\SerieController as SuperAdminSerieController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\Teacher\TeacherController as SuperAdminTeacherController;
use App\Http\Controllers\Teacher\Account\AccountController as TeacherAccountController;
use App\Http\Controllers\Teacher\Goal\GoalController as TeacherGoalController;
use App\Http\Controllers\Teacher\Message\MessageController as TeacherMessageController;
use App\Http\Controllers\Teacher\Procedure\ProcedureController as TeacherProcedureController;
use App\Http\Controllers\Teacher\Student\StudentController as TeacherStudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Models\Enums\Roles;
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
Route::middleware(['auth', 'verified'])->prefix('/tableau-de-bord')->group(function () {
    Route::name('student.')->middleware('role:'.Roles::Student->value)->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');

        Route::name('procedures.')->middleware('hasPromotion')->group(function () {
            Route::get('/mes-demarches', [StudentProcedureController::class, 'index'])->name('index');
            Route::get('/mes-demarches/creation', [StudentProcedureController::class, 'create'])->name('create');
            Route::post('/mes-demarches/creation', [StudentProcedureController::class, 'store'])->name('store');
            Route::post('/mes-demarches/supprimer/{procedure}', [StudentProcedureController::class, 'destroy'])->name('destroy');
            Route::get('/mes-demarches/fiche/{procedure}', [StudentProcedureController::class, 'show'])->name('show');
            Route::get('/mes-demarches/edition/{procedure}', [StudentProcedureController::class, 'edit'])->name('edit');
            Route::post('/mes-demarches/edition/{procedure}', [StudentProcedureController::class, 'update'])->name('update');
        });

        Route::name('companies.')->middleware('hasPromotion')->group(function () {
            Route::get('/mes-entreprises', [StudentCompanyController::class, 'index'])->name('index');
            Route::get('/mes-entreprises/creation', [StudentCompanyController::class, 'create'])->name('create');
            Route::post('/mes-entreprises/creation', [StudentCompanyController::class, 'store'])->name('store');
            Route::post('/mes-entreprises/supprimer/{company}', [StudentCompanyController::class, 'destroy'])->name('destroy');
            Route::get('/mes-entreprises/fiche/{company}', [StudentCompanyController::class, 'show'])->name('show');
            Route::get('/mes-entreprises/edition/{company}', [StudentCompanyController::class, 'edit'])->name('edit');
            Route::post('/mes-entreprises/edition/{company}', [StudentCompanyController::class, 'update'])->name('update');
        });

        Route::name('contacts.')->middleware('hasPromotion')->group(function () {
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

        Route::name('goals.')->middleware('hasPromotion')->group(function () {
            Route::get('/objectifs', [StudentGoalController::class, 'index'])->name('index');
        });

        Route::name('message.')->middleware('hasPromotion')->group(function () {
            Route::get('/message', [StudentMessageController::class, 'index'])->name('index');
        });
    });

    Route::name('teacher.')->middleware('role:'.Roles::Teacher->value)->prefix('/professeur')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');

        Route::name('student.')->group(function () {
            Route::get('/mes-eleves', [TeacherStudentController::class, 'index'])->name('index');
            Route::get('/mes-eleves/fiche/{user}', [TeacherStudentController::class, 'show'])->name('show');
            Route::get('/mes-eleves/edition/{user}', [TeacherStudentController::class, 'edit'])->name('edit');
            Route::post('/mes-eleves/edition/{user}', [TeacherStudentController::class, 'update'])->name('update');
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

    Route::name('admin.')->middleware('role:'.Roles::Admin->value)->prefix('/admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::name('student.')->group(function () {
            Route::get('/gestion-des-etudiants', [AdminStudentController::class, 'index'])->name('index');
            Route::get('/gestion-des-etudiants/creation', [AdminStudentController::class, 'create'])->name('create');
            Route::post('/gestion-des-etudiants/creation', [AdminStudentController::class, 'store'])->name('store');
            Route::post('/gestion-des-etudiants/supprimer/{user}', [AdminStudentController::class, 'destroy'])->name('destroy');
            Route::get('/gestion-des-etudiants/fiche/{user}', [AdminStudentController::class, 'show'])->name('show');
            Route::get('/gestion-des-etudiants/edition/{user}', [AdminStudentController::class, 'edit'])->name('edit');
            Route::post('/gestion-des-etudiants/edition/{user}', [AdminStudentController::class, 'update'])->name('update');
        });

        Route::name('teacher.')->group(function () {
            Route::get('/gestion-des-professeurs', [AdminTeacherController::class, 'index'])->name('index');
            Route::get('/gestion-des-professeurs/creation', [AdminTeacherController::class, 'create'])->name('create');
            Route::post('/gestion-des-professeurs/creation', [AdminTeacherController::class, 'store'])->name('store');
            Route::post('/gestion-des-professeurs/supprimer/{user}', [AdminTeacherController::class, 'destroy'])->name('destroy');
            Route::get('/gestion-des-professeurs/edition/{user}', [AdminTeacherController::class, 'edit'])->name('edit');
            Route::post('/gestion-des-professeurs/edition/{user}', [AdminTeacherController::class, 'update'])->name('update');
        });

        Route::name('procedure.')->group(function () {
            Route::get('/suivi-des-demarches', [AdminProcedureController::class, 'index'])->name('index');
            Route::get('/suivi-des-demarches/fiche/{procedure}', [AdminProcedureController::class, 'show'])->name('show');
        });

        Route::name('company.')->group(function () {
            Route::get('/liste-des-entreprises', [AdminCompanyController::class, 'index'])->name('index');
            Route::get('/liste-des-entreprises/fiche/{company}', [AdminCompanyController::class, 'show'])->name('show');
        });

        Route::name('promotions.')->group(function () {
            Route::get('/gestion-des-promotions', [AdminPromotionController::class, 'index'])->name('index');
            Route::get('/gestion-des-promotions/creation', [AdminPromotionController::class, 'create'])->name('create');
            Route::post('/gestion-des-promotions/creation', [AdminPromotionController::class, 'store'])->name('store');
            Route::post('/gestion-des-promotions/supprimer/{promotion}', [AdminPromotionController::class, 'destroy'])->name('destroy');
            Route::get('/gestion-des-promotions/edition/{promotion}', [AdminPromotionController::class, 'edit'])->name('edit');
            Route::post('/gestion-des-promotions/edition/{promotion}', [AdminPromotionController::class, 'update'])->name('update');
        });

        Route::name('account.')->group(function () {
            Route::get('/mon-compte', [AdminAccountController::class, 'edit'])->name('edit');
            Route::post('/mon-compte', [AdminAccountController::class, 'update'])->name('update');
        });

        Route::name('message.')->group(function () {
            Route::get('/message', [AdminMessageController::class, 'index'])->name('index');
        });
    });

    Route::name('superadmin.')->middleware('role:'.Roles::SuperAdmin->value)->prefix('/superadmin')->group(function () {
        Route::get('/', [SuperAdminController::class, 'index'])->name('index');

        Route::name('admin.')->group(function () {
            Route::get('/gestion-des-admins', [SuperAdminAdminController::class, 'index'])->name('index');
            Route::get('/gestion-des-admins/creation', [SuperAdminAdminController::class, 'create'])->name('create');
            Route::post('/gestion-des-admins/creation', [SuperAdminAdminController::class, 'store'])->name('store');
            Route::post('/gestion-des-admins/supprimer/{user}', [SuperAdminAdminController::class, 'destroy'])->name('destroy');
            Route::get('/gestion-des-admins/edition/{user}', [SuperAdminAdminController::class, 'edit'])->name('edit');
            Route::post('/gestion-des-admins/edition/{user}', [SuperAdminAdminController::class, 'update'])->name('update');
        });

        Route::name('teacher.')->group(function () {
            Route::get('/gestion-des-professeurs', [SuperAdminTeacherController::class, 'index'])->name('index');
            Route::get('/gestion-des-professeurs/creation', [SuperAdminTeacherController::class, 'create'])->name('create');
            Route::post('/gestion-des-professeurs/creation', [SuperAdminTeacherController::class, 'store'])->name('store');
            Route::post('/gestion-des-professeurs/supprimer/{user}', [SuperAdminTeacherController::class, 'destroy'])->name('destroy');
            Route::get('/gestion-des-professeurs/edition/{user}', [SuperAdminTeacherController::class, 'edit'])->name('edit');
            Route::post('/gestion-des-professeurs/edition/{user}', [SuperAdminTeacherController::class, 'update'])->name('update');
        });

        Route::name('series.')->group(function () {
            Route::get('/gestion-des-series', [SuperAdminSerieController::class, 'index'])->name('index');
            Route::get('/gestion-des-series/creation', [SuperAdminSerieController::class, 'create'])->name('create');
            Route::post('/gestion-des-series/creation', [SuperAdminSerieController::class, 'store'])->name('store');
            Route::post('/gestion-des-series/supprimer/{serie}', [SuperAdminSerieController::class, 'destroy'])->name('destroy');
            Route::get('/gestion-des-serie/edition/{serie}', [SuperAdminSerieController::class, 'edit'])->name('edit');
            Route::post('/gestion-des-serie/edition/{serie}', [SuperAdminSerieController::class, 'update'])->name('update');
        });

        Route::name('promotions.')->group(function () {
            Route::get('/gestion-des-promotions', [SuperAdminPromotionController::class, 'index'])->name('index');
            Route::get('/gestion-des-promotions/creation', [SuperAdminPromotionController::class, 'create'])->name('create');
            Route::post('/gestion-des-promotions/creation', [SuperAdminPromotionController::class, 'store'])->name('store');
            Route::post('/gestion-des-promotions/supprimer/{promotion}', [SuperAdminPromotionController::class, 'destroy'])->name('destroy');
            Route::get('/gestion-des-promotions/edition/{promotion}', [SuperAdminPromotionController::class, 'edit'])->name('edit');
            Route::post('/gestion-des-promotions/edition/{promotion}', [SuperAdminPromotionController::class, 'update'])->name('update');
        });

        Route::name('account.')->group(function () {
            Route::get('/mon-compte', [SuperAdminAccountController::class, 'edit'])->name('edit');
            Route::post('/mon-compte', [SuperAdminAccountController::class, 'update'])->name('update');
        });
    });
});

require __DIR__.'/auth.php';
