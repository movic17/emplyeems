<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum EmployeeGenderEnum: string implements HasLabel
{
    case Male = 'male';

    case Female = 'female';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
