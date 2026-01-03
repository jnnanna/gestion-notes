<?php

namespace App\Enums;

enum TypeAction:  string
{
    case CREATION = 'creation';
    case MODIFICATION = 'modification';
    case VALIDATION = 'validation';
    case REJET = 'rejet';
    case VERROUILLAGE = 'verrouillage';

    public function label(): string
    {
        return match($this) {
            self:: CREATION => 'Création',
            self::MODIFICATION => 'Modification',
            self:: VALIDATION => 'Validation',
            self::REJET => 'Rejet',
            self::VERROUILLAGE => 'Verrouillage',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::CREATION => 'add_circle',
            self::MODIFICATION => 'edit',
            self::VALIDATION => 'check_circle',
            self::REJET => 'cancel',
            self::VERROUILLAGE => 'lock',
        };
    }
}