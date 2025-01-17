<?php

namespace App\Filament\Personal\Resources;

use App\Filament\Personal\Resources\HolidyResource\Pages;
use App\Filament\Personal\Resources\HolidyResource\RelationManagers;
use App\Models\Holidy;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class HolidyResource extends Resource
{
    protected static ?string $model = Holidy::class;
    protected static ?string $navigationLabel = 'Vacaciones';
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    public static function getNavigationBadge(): ?string
    {

        return parent::getEloquentQuery()->where('user_id', Auth::user()->id)->where('type', 'pending')->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id)->where('type', 'pending')->count() > 0 ? 'warning' : 'info';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('calendar_id')
                    ->relationship(name: 'calendar', titleAttribute: 'name')
                    ->required(),

                // Forms\Components\Select::make('user_id')
                // ->label('User')
                // ->options(function () {
                //     return User::whereHas('roles', function ($query) {
                //         $query->whereIn('id', [1, 3]);
                //     })->pluck('name', 'id');
                // })
                // ->required(),
                Forms\Components\DatePicker::make('day')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('calendar.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()

                    ->sortable(),
                Tables\Columns\TextColumn::make('day')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'approved' => 'success',
                        'decline' => 'danger',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHolidies::route('/'),
            'create' => Pages\CreateHolidy::route('/create'),
            'edit' => Pages\EditHolidy::route('/{record}/edit'),
        ];
    }
}
