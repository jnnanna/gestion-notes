<?php

namespace App\Enums;

enum StatutImportation: string
{
    case EN_COURS = 'en_cours';
    case COMPLETE = 'complete';
    case ECHOUE = 'echoue';

    public function label(): string
    {
        return match($this) {
            self::EN_COURS => 'En cours',
            self:: COMPLETE => 'Complété',
            self::ECHOUE => 'Échoué',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::EN_COURS => 'info',
            self::COMPLETE => 'success',
            self::ECHOUE => 'danger',
        };
    }
}