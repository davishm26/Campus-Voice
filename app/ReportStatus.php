<?php

namespace App;

enum ReportStatus: string
{
    case Pending = 'menunggu';
    case InProgress = 'diproses';
    case Completed = 'selesai';

    /**
     * Get the human readable label for the status.
     */
    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu',
            self::InProgress => 'Diproses',
            self::Completed => 'Selesai',
        };
    }

    /**
     * Get the Tailwind classes used to render the status badge.
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-800',
            self::InProgress => 'bg-blue-100 text-blue-800',
            self::Completed => 'bg-green-100 text-green-800',
        };
    }
}
