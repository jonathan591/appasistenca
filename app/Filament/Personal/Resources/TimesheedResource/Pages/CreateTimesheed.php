<?php

namespace App\Filament\Personal\Resources\TimesheedResource\Pages;

use App\Filament\Personal\Resources\TimesheedResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTimesheed extends CreateRecord
{
    protected static string $resource = TimesheedResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
    
        return $data;
    }
}
