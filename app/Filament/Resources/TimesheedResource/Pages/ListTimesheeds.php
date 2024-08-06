<?php

namespace App\Filament\Resources\TimesheedResource\Pages;

use App\Filament\Resources\TimesheedResource;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;
use Filament\Forms\Form;
class ListTimesheeds extends ListRecords
{
    protected static string $resource = TimesheedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make("crear pdf")
            ->color('info')
            ->form([
                Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),
            ])
            ->requiresConfirmation()
            ->action(function (array $data) {
                $userId = $data['user_id'];
                $url = route('pdf.asistencia', ['user' => $userId]);
        
                redirect()->to($url);
            })
        ];
    }
}
