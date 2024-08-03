<?php

namespace App\Filament\Personal\Resources\HolidyResource\Pages;

use App\Filament\Personal\Resources\HolidyResource;
use App\Mail\HolidyPending;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CreateHolidy extends CreateRecord
{
    protected static string $resource = HolidyResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = Auth::user()->id;
    $data['type']='pending';
    $userAdmin = User::find(1);
    $dataToSend = array(
        'day' => $data['day'],
        'name' => User::find($data['user_id'])->name,
        'email' => User::find($data['user_id'])->email,
    );
    Mail::to($userAdmin)->send(new HolidyPending($dataToSend));
    // Notification::make()
    //     ->title('Solicitud de vacaciones')
    //     ->body("El día ".$data['day'].' esta pendiente de aprovar')
    //     ->warning()
    //     ->send();

    $recipient = auth()->user();

    Notification::make()
        ->title('Solicitud de vacaciones')
        ->body("El día ".$data['day'].' esta pendiente de aprovar')
        ->sendToDatabase($recipient);
    return $data;

}
}
