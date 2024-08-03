<?php

namespace App\Filament\Personal\Resources\TimesheedResource\Pages;

use App\Filament\Personal\Resources\TimesheedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimesheed extends EditRecord
{
    protected static string $resource = TimesheedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
