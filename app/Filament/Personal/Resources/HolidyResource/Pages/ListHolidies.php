<?php

namespace App\Filament\Personal\Resources\HolidyResource\Pages;

use App\Filament\Personal\Resources\HolidyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHolidies extends ListRecords
{
    protected static string $resource = HolidyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("crear vacaiones"),
        ];
    }
}
