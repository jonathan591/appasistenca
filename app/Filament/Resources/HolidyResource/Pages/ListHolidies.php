<?php

namespace App\Filament\Resources\HolidyResource\Pages;

use App\Filament\Resources\HolidyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHolidies extends ListRecords
{
    protected static string $resource = HolidyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
