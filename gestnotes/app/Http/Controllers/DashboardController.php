<?php

namespace App\Http\Controllers;

use App\Models\ScannedDocument;
use App\Models\Module;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // KPI Stats
        $stats = [
            'scanned_documents' => ScannedDocument::count(),
            'active_modules' => Module::where('status', 'active')->count(),
            'pending_validations' => Grade::where('status', 'pending')->count(),
            'system_alerts' => 2, // Statique pour l'instant
            'total_students' => Student::count(),
        ];

        // Activités récentes (dernières notes validées/en cours)
        $recentActivities = Grade::with(['module.filiere', 'module.responsible', 'student'])
            ->latest()
            ->take(3)
            ->get();

        // Distribution des moyennes (pour le graphique)
        $gradeDistribution = [
            '10-12' => Grade::whereBetween('final_grade', [10, 11.99])->count(),
            '12-14' => Grade::whereBetween('final_grade', [12, 13.99])->count(),
            '14-16' => Grade::whereBetween('final_grade', [14, 15.99])->count(),
            '16-18' => Grade::whereBetween('final_grade', [16, 17.99])->count(),
            '18-20' => Grade::whereBetween('final_grade', [18, 20])->count(),
        ];

        return view('dashboard.index', compact('stats', 'recentActivities', 'gradeDistribution'));
    }
}
