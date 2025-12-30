<?php

namespace App\Enums;

enum TypeDocument: string
{
    case RELEVE = 'releve';
    case PV = 'pv';
    case BULLETIN = 'bulletin';
    case LISTE = 'liste';
    case DONNEES_BRUTES = 'donnees_brutes';

    public function label(): string
    {
        return match($this) {
            self::RELEVE => 'Relevé de Notes',
            self::PV => 'Procès-Verbal',
            self::BULLETIN => 'Bulletin',
            self::LISTE => 'Liste Étudiants',
            self:: DONNEES_BRUTES => 'Données Brutes',
        };
    }
}