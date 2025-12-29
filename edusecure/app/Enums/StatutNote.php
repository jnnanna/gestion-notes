<?php

namespace App\Enums;

enum StatutNote: string
{
    case EN_ATTENTE = 'en_attente';
    case VALIDE = 'valide';
    case REJETE = 'rejete';

    public function label(): string
    {
        return match($this) {
            self::EN_ATTENTE => 'En attente',
            self::VALIDE => 'Validé',
            self::REJETE => 'Rejeté',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::EN_ATTENTE => 'warning',
            self::VALIDE => 'success',
            self::REJETE => 'danger',
        };
    }
}