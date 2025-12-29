<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard. 
     */
    public function index(): View
    {
        // Récupérer les statistiques
        $stats = $this->getStatistics();
        
        // Récupérer les activités récentes
        $activites = $this->getRecentActivities();
        
        // Récupérer les alertes
        $alertes = $this->getAlerts();
        
        return view('dashboard.index', compact('stats', 'activites', 'alertes'));
    }
    
    /**
     * Get dashboard statistics.
     */
    private function getStatistics(): array
    {
        // TODO: Remplacer par de vraies données depuis la base
        return [
            'feuilles_scannees' => '1,240',
            'modules_actifs' => 12,
            'validations_requises' => 3,
            'alertes_systeme' => 2,
        ];
    }
    
    /**
     * Get recent activities. 
     */
    private function getRecentActivities(): array
    {
        // TODO: Remplacer par de vraies données depuis la base
        return [
            [
                'code' => 'AL',
                'module' => 'Algorithmique Avancée',
                'professeur' => 'Dr. Sarah Martin',
                'date' => '29 Déc, 10:23',
                'statut' => 'valide',
            ],
            [
                'code' => 'BD',
                'module' => 'Bases de Données',
                'professeur' => 'Pr. Ahmed Mansouri',
                'date' => '29 Déc, 09:45',
                'statut' => 'en_attente',
            ],
            [
                'code' => 'RS',
                'module' => 'Réseaux & Systèmes',
                'professeur' => 'Dr. Marie Dubois',
                'date' => '28 Déc, 16:30',
                'statut' => 'erreur',
            ],
        ];
    }
    
    /**
     * Get system alerts.
     */
    private function getAlerts(): array
    {
        // TODO: Remplacer par de vraies données depuis la base
        return [
            [
                'type' => 'orange',
                'icon' => 'warning',
                'titre' => 'Moyenne Critique',
                'message' => 'Module "Chimie Org." : La moyenne est inférieure à 8/20.',
            ],
            [
                'type' => 'red',
                'icon' => 'error',
                'titre' => 'Fichier Corrompu',
                'message' => 'Scan #4024 illisible. Veuillez re-scanner.',
                'action' => 'Voir détails',
            ],
        ];
    }
}