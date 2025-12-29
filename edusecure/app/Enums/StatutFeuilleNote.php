<?php

namespace App\Enums;

enum StatutFeuilleNote:  string
{
    case BROUILLON = 'brouillon';
    case SOUMIS = 'soumis';
    case VALIDE = 'valide';
    case VERROUILLE = 'verrouille';
    case REJETE = 'rejete';

    public function label(): string
    {
        return match($this) {
            self::BROUILLON => 'Brouillon',
            self::SOUMIS => 'Soumis',
            self::VALIDE => 'Validé',
            self::VERROUILLE => 'Verrouillé',
            self::REJETE => 'Rejeté',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::BROUILLON => 'default',
            self::SOUMIS => 'info',
            self::VALIDE => 'success',
            self::VERROUILLE => 'default',
            self::REJETE => 'danger',
        };
    }
}