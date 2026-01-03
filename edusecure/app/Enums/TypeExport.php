<?php

namespace App\Enums;

enum TypeExport: string
{
    case PDF = 'pdf';
    case EXCEL = 'excel';
    case CSV = 'csv';

    public function label(): string
    {
        return match($this) {
            self::PDF => 'PDF',
            self::EXCEL => 'Excel',
            self::CSV => 'CSV',
        };
    }

    public function extension(): string
    {
        return match($this) {
            self::PDF => '. pdf',
            self::EXCEL => '.xlsx',
            self:: CSV => '.csv',
        };
    }

    public function mimeType(): string
    {
        return match($this) {
            self::PDF => 'application/pdf',
            self:: EXCEL => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            self::CSV => 'text/csv',
        };
    }
}