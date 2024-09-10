<?php

namespace App\Filament\Resources\DeliveryDetailResource\Pages;

use App\Filament\Resources\DeliveryDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDeliveryDetails extends ManageRecords
{
    protected static string $resource = DeliveryDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
