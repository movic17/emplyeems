<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum LeaveStatusEnum: string implements HasLabel
{
    case PENDING = 'pending';

    case APPROVED = 'approved';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
        };
    }
}
