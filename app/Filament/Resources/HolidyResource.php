<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidyResource\Pages;
use App\Filament\Resources\HolidyResource\RelationManagers;
use App\Models\Holidy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidyResource extends Resource
{
    protected static ?string $model = Holidy::class;
    protected static ?string $navigationLabel = 'Vacaciones';

    protected static ?string $navigationIcon = 'heroicon-c-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('calendar_id')
                ->relationship(name: 'calendar', titleAttribute: 'name')
                ->required(),
            Forms\Components\Select::make('user_id')
                ->relationship(name: 'user', titleAttribute: 'name')
                ->required(),
            Forms\Components\Select::make('type')
                ->options([
                    'decline' => 'Decline',
                    'approved' => 'Approved',
                    'pending' => 'Pending',

                ])
                ->required(),
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
