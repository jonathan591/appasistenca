<?php

namespace App\Filament\Personal\Resources\HolidyResource\Pages;

use App\Filament\Personal\Resources\HolidyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHolidy extends EditRecord
{
    protected static string $resource = HolidyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
