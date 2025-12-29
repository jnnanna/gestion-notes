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
    
    // ========================================
    // GESTION ACADÉMIQUE
    // ========================================
    
    // Départements
    Route::resource('departements', DepartementController::class);
    
    // Filières
    Route::resource('filieres', FiliereController:: class);
    Route::prefix('filieres')->name('filieres.')->group(function () {
        Route::get('{filiere}/etudiants', [FiliereController::class, 'etudiants'])->name('etudiants');
        Route::get('{filiere}/modules', [FiliereController::class, 'modules'])->name('modules');
    });
    
    // Modules
    Route::resource('modules', ModuleController::class);
    Route::prefix('modules')->name('modules.')->group(function () {
        Route::get('{module}/notes', [ModuleController::class, 'notes'])->name('notes');
        Route::get('{module}/statistiques', [ModuleController::class, 'statistiques'])->name('statistiques');
    });
    
    // Semestres
    Route::resource('semestres', SemestreController::class)->except(['create', 'edit']);
    
    // Années Académiques
    Route::resource('annees-academiques', AnneeAcademiqueController::class);
    Route::post('annees-academiques/{anneeAcademique}/activer', [AnneeAcademiqueController::class, 'activer'])->name('annees-academiques.activer');
    
    // ========================================
    // GESTION DES UTILISATEURS
    // ========================================
    
    Route::resource('utilisateurs', UtilisateurController::class);
    Route::prefix('utilisateurs')->name('utilisateurs.')->group(function () {
        Route::get('{utilisateur}/roles', [UtilisateurController::class, 'roles'])->name('roles');
        Route::post('{utilisateur}/roles', [UtilisateurController::class, 'assignRoles'])->name('assign-roles');
        Route::post('{utilisateur}/activer', [UtilisateurController::class, 'activer'])->name('activer');
        Route::post('{utilisateur}/desactiver', [UtilisateurController::class, 'desactiver'])->name('desactiver');
        Route::post('import', [UtilisateurController::class, 'import'])->name('import');
    });
    
    // ========================================
    // GESTION DES ÉTUDIANTS
    // ========================================
    
    Route::resource('etudiants', EtudiantController::class);
    Route::prefix('etudiants')->name('etudiants.')->group(function () {
        Route::post('import', [EtudiantController:: class, 'import'])->name('import');
        Route::get('export', [EtudiantController:: class, 'export'])->name('export');
        Route::get('{etudiant}/notes', [EtudiantController::class, 'notes'])->name('notes');
        Route::get('{etudiant}/releve', [EtudiantController::class, 'releve'])->name('releve');
    });
    
    // ========================================
    // IMPORTATION & NUMÉRISATION
    // ========================================
    
    Route::prefix('importation')->name('importation.')->group(function () {
        Route::get('/', [ImportationController::class, 'index'])->name('index');
        Route::post('/upload', [ImportationController::class, 'upload'])->name('upload');
        Route::get('/categorisation/{importation}', [ImportationController::class, 'categorisation'])->name('categorisation');
        Route::post('/categorisation/{importation}', [ImportationController::class, 'storeCategorisation'])->name('store-categorisation');
        Route::get('/verification/{importation}', [ImportationController::class, 'verification'])->name('verification');
        Route::post('/verification/{importation}', [ImportationController::class, 'storeVerification'])->name('store-verification');
        Route::post('/process-ocr/{importation}', [ImportationController::class, 'processOCR'])->name('process-ocr');
        
        // Nouvelles routes
        Route::get('/historique', [ImportationController::class, 'historique'])->name('historique');
        Route::delete('/{importation}', [ImportationController::class, 'destroy'])->name('destroy');
        Route::post('/{importation}/annuler', [ImportationController:: class, 'annuler'])->name('annuler');
    });
    
    // ========================================
    // FEUILLES DE NOTES
    // ========================================
    
    Route::resource('feuilles-notes', FeuilleNoteController::class);
    Route::prefix('feuilles-notes')->name('feuilles-notes.')->group(function () {
        Route::get('{feuilleNote}/historique', [FeuilleNoteController::class, 'historique'])->name('historique');
        Route::post('{feuilleNote}/soumettre', [FeuilleNoteController::class, 'soumettre'])->name('soumettre');
        Route::post('{feuilleNote}/verrouiller', [FeuilleNoteController::class, 'verrouiller'])->name('verrouiller');
        Route::get('{feuilleNote}/pdf', [FeuilleNoteController::class, 'generatePDF'])->name('pdf');
        Route::get('{feuilleNote}/apercu', [FeuilleNoteController::class, 'apercu'])->name('apercu');
    });
    
    // ========================================
    // VALIDATION DES NOTES
    // ========================================
    
    Route::prefix('validation')->name('validation.')->group(function () {
        Route::get('/', [ValidationController:: class, 'index'])->name('index');
        Route::get('/{feuilleNote}', [ValidationController::class, 'show'])->name('show');
        Route::post('/{feuilleNote}/valider', [ValidationController::class, 'valider'])->name('valider');
        Route::post('/{feuilleNote}/rejeter', [ValidationController::class, 'rejeter'])->name('rejeter');
        Route::post('/valider-selection', [ValidationController:: class, 'validerSelection'])->name('valider-selection');
        Route::post('/rejeter-selection', [ValidationController::class, 'rejeterSelection'])->name('rejeter-selection');
        Route::put('/notes/{note}', [ValidationController::class, 'updateNote'])->name('update-note');
        
        // Nouvelles routes
        Route::get('/statistiques', [ValidationController::class, 'statistiques'])->name('statistiques');
        Route::post('/{feuilleNote}/commentaire', [ValidationController::class, 'ajouterCommentaire'])->name('commentaire');
    });
    
    // ========================================
    // EXPORTATION
    // ========================================
    
    Route::prefix('exportation')->name('exportation.')->group(function () {
        Route::get('/', [ExportationController:: class, 'index'])->name('index');
        Route::post('/generer', [ExportationController::class, 'generer'])->name('generer');
        Route::get('/historique', [ExportationController::class, 'historique'])->name('historique');
        Route::get('/telecharger/{export}', [ExportationController::class, 'telecharger'])->name('telecharger');
        Route::get('/apercu', [ExportationController:: class, 'apercu'])->name('apercu');
        
        // Nouvelles routes
        Route::delete('/{export}', [ExportationController:: class, 'destroy'])->name('destroy');
        Route::post('/nettoyer-expires', [ExportationController::class, 'nettoyerExpires'])->name('nettoyer-expires');
    });
    
    // ========================================
    // ARCHIVES
    // ========================================
    
    Route::prefix('archives')->name('archives.')->group(function () {
        Route::get('/', [ArchiveController::class, 'index'])->name('index');
        Route::get('/recherche', [ArchiveController::class, 'recherche'])->name('recherche');
        Route::get('/{archive}', [ArchiveController::class, 'show'])->name('show');
        
        // Nouvelles routes
        Route::post('/archiver-feuille/{feuilleNote}', [ArchiveController::class, 'archiverFeuille'])->name('archiver-feuille');
        Route::post('/archiver-annee/{anneeAcademique}', [ArchiveController::class, 'archiverAnnee'])->name('archiver-annee');
        Route::get('/{archive}/telecharger', [ArchiveController::class, 'telecharger'])->name('telecharger');
    });
    
    // ========================================
    // NOTIFICATIONS
    // ========================================
    
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/lire', [NotificationController::class, 'marquerLue'])->name('lire');
        Route::post('/lire-toutes', [NotificationController::class, 'marquerToutesLues'])->name('lire-toutes');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
        
        // Nouvelles routes
        Route::get('/non-lues', [NotificationController::class, 'nonLues'])->name('non-lues');
        Route::delete('/supprimer-toutes', [NotificationController::class, 'supprimerToutes'])->name('supprimer-toutes');
    });
    
    // ========================================
    // PROFIL UTILISATEUR
    // ========================================
    
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilController:: class, 'index'])->name('index');
        Route::put('/', [ProfilController::class, 'update'])->name('update');
        Route::get('/securite', [ProfilController:: class, 'securite'])->name('securite');
        Route::put('/password', [ProfilController::class, 'updatePassword'])->name('update-password');
        Route::post('/2fa/activer', [ProfilController::class, 'activer2FA'])->name('activer-2fa');
        Route::post('/2fa/desactiver', [ProfilController::class, 'desactiver2FA'])->name('desactiver-2fa');
        Route::post('/sessions/deconnecter', [ProfilController::class, 'deconnecterSessions'])->name('deconnecter-sessions');
        
        // Nouvelles routes
        Route::post('/avatar', [ProfilController::class, 'updateAvatar'])->name('update-avatar');
        Route::delete('/avatar', [ProfilController:: class, 'deleteAvatar'])->name('delete-avatar');
        Route::get('/activites', [ProfilController::class, 'activites'])->name('activites');
    });
    
    // ========================================
    // PARAMÈTRES (ADMIN SEULEMENT)
    // ========================================
    
    Route:: prefix('parametres')->name('parametres.')->middleware('role:super-admin')->group(function () {
        Route::get('/', [ParametreController::class, 'index'])->name('index');
        Route::put('/', [ParametreController::class, 'update'])->name('update');
        
        // Nouvelles routes
        Route::get('/systeme', [ParametreController:: class, 'systeme'])->name('systeme');
        Route::post('/cache/clear', [ParametreController:: class, 'clearCache'])->name('clear-cache');
        Route::post('/logs/clear', [ParametreController::class, 'clearLogs'])->name('clear-logs');
        Route::get('/backup', [ParametreController::class, 'backup'])->name('backup');
        Route::post('/backup/create', [ParametreController::class, 'createBackup'])->name('create-backup');
    });
    
    // ========================================
    // RAPPORTS & STATISTIQUES
    // ========================================
    
    Route::prefix('rapports')->name('rapports.')->middleware('permission:generer_rapports')->group(function () {
        Route::get('/', function () { return view('rapports. index'); })->name('index');
        Route::get('/moyennes', function () { return view('rapports.moyennes'); })->name('moyennes');
        Route::get('/reussite', function () { return view('rapports.reussite'); })->name('reussite');
        Route::get('/comparaison', function () { return view('rapports.comparaison'); })->name('comparaison');
    });
    
    // ========================================
    // API INTERNE (AJAX)
    // ========================================
    
    Route::prefix('api')->name('api.')->group(function () {
        // Recherche autocomplete
        Route::get('/etudiants/search', [EtudiantController::class, 'search'])->name('etudiants.search');
        Route::get('/modules/search', [ModuleController::class, 'search'])->name('modules.search');
        
        // Stats en temps réel
        Route::get('/stats/dashboard', [DashboardController::class, 'stats'])->name('stats.dashboard');
        Route::get('/stats/importation', [ImportationController::class, 'stats'])->name('stats.importation');
        
        // Notifications temps réel
        Route::get('/notifications/count', [NotificationController::class, 'count'])->name('notifications.count');
    });
});

require __DIR__. '/auth.php';