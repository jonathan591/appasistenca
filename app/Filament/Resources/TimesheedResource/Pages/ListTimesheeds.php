<?php

namespace App\Filament\Resources\TimesheedResource\Pages;

use App\Filament\Resources\TimesheedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimesheeds extends ListRecords
{
    protected static string $resource = TimesheedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
