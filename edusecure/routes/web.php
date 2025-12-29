<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ImportationController;
use App\Http\Controllers\FeuilleNoteController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\ExportationController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ParametreController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Routes Authentifiées
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion Académique
    Route::resource('departements', DepartementController::class);
    Route::resource('filieres', FiliereController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('semestres', SemestreController:: class);
    Route::resource('annees-academiques', AnneeAcademiqueController::class);
    
    // Gestion des Utilisateurs
    Route::resource('utilisateurs', UtilisateurController::class);
    Route::get('utilisateurs/{utilisateur}/roles', [UtilisateurController::class, 'roles'])->name('utilisateurs.roles');
    Route::post('utilisateurs/{utilisateur}/roles', [UtilisateurController::class, 'assignRoles'])->name('utilisateurs.assign-roles');
    
    // Gestion des Étudiants
    Route::resource('etudiants', EtudiantController:: class);
    Route::post('etudiants/import', [EtudiantController:: class, 'import'])->name('etudiants.import');
    
    // Importation & Numérisation
    Route::prefix('importation')->name('importation.')->group(function () {
        Route::get('/', [ImportationController::class, 'index'])->name('index');
        Route::post('/upload', [ImportationController::class, 'upload'])->name('upload');
        Route::get('/categorisation/{importation}', [ImportationController::class, 'categorisation'])->name('categorisation');
        Route::post('/categorisation/{importation}', [ImportationController::class, 'storeCategorisation'])->name('store-categorisation');
        Route::get('/verification/{importation}', [ImportationController::class, 'verification'])->name('verification');
        Route::post('/verification/{importation}', [ImportationController::class, 'storeVerification'])->name('store-verification');
        Route::post('/process-ocr/{importation}', [ImportationController::class, 'processOCR'])->name('process-ocr');
    });
    
    // Feuilles de Notes
    Route::resource('feuilles-notes', FeuilleNoteController::class);
    Route::get('feuilles-notes/{feuilleNote}/historique', [FeuilleNoteController::class, 'historique'])->name('feuilles-notes. historique');
    
    // Validation des Notes
    Route:: prefix('validation')->name('validation.')->group(function () {
        Route::get('/', [ValidationController::class, 'index'])->name('index');
        Route::get('/{feuilleNote}', [ValidationController::class, 'show'])->name('show');
        Route::post('/{feuilleNote}/valider', [ValidationController::class, 'valider'])->name('valider');
        Route::post('/{feuilleNote}/rejeter', [ValidationController::class, 'rejeter'])->name('rejeter');
        Route::post('/valider-selection', [ValidationController:: class, 'validerSelection'])->name('valider-selection');
        Route::post('/rejeter-selection', [ValidationController::class, 'rejeterSelection'])->name('rejeter-selection');
        Route::put('/notes/{note}', [ValidationController::class, 'updateNote'])->name('update-note');
    });
    
    // Exportation
    Route::prefix('exportation')->name('exportation.')->group(function () {
        Route::get('/', [ExportationController::class, 'index'])->name('index');
        Route::post('/generer', [ExportationController::class, 'generer'])->name('generer');
        Route::get('/historique', [ExportationController::class, 'historique'])->name('historique');
        Route::get('/telecharger/{export}', [ExportationController::class, 'telecharger'])->name('telecharger');
        Route::get('/apercu', [ExportationController::class, 'apercu'])->name('apercu');
    });
    
    // Archives
    Route::prefix('archives')->name('archives.')->group(function () {
        Route:: get('/', [ArchiveController::class, 'index'])->name('index');
        Route::get('/recherche', [ArchiveController::class, 'recherche'])->name('recherche');
        Route::get('/{archive}', [ArchiveController:: class, 'show'])->name('show');
    });
    
    // Notifications
    Route::prefix('notifications')->name('notifications. ')->group(function () {
        Route:: get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{notification}/lire', [NotificationController::class, 'marquerLue'])->name('lire');
        Route::post('/lire-toutes', [NotificationController::class, 'marquerToutesLues'])->name('lire-toutes');
    });
    
    // Profil Utilisateur
    Route::prefix('profil')->name('profil. ')->group(function () {
        Route:: get('/', [ProfilController::class, 'index'])->name('index');
        Route::put('/', [ProfilController::class, 'update'])->name('update');
        Route::get('/securite', [ProfilController::class, 'securite'])->name('securite');
        Route::put('/password', [ProfilController::class, 'updatePassword'])->name('update-password');
        Route::post('/2fa/activer', [ProfilController::class, 'activer2FA'])->name('activer-2fa');
        Route::post('/2fa/desactiver', [ProfilController::class, 'desactiver2FA'])->name('desactiver-2fa');
        Route::post('/sessions/deconnecter', [ProfilController::class, 'deconnecterSessions'])->name('deconnecter-sessions');
    });
    
    // Paramètres (Admin)
    Route::prefix('parametres')->name('parametres.')->middleware('role:super-admin')->group(function () {
        Route::get('/', [ParametreController::class, 'index'])->name('index');
        Route::put('/', [ParametreController::class, 'update'])->name('update');
    });
});

require __DIR__. '/auth.php';