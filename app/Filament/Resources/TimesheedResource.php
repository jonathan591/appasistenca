<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimesheedResource\Pages;
use App\Filament\Resources\TimesheedResource\RelationManagers;
use App\Models\Calendar;
use App\Models\Timesheed;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
class TimesheedResource extends Resource
{
    protected static ?string $model = Timesheed::class;
    protected static ?string $navigationLabel = 'Asistencia';

    protected static ?string $navigationIcon = 'heroicon-c-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('calendar_id')
                ->label('Calendar')
                ->options(Calendar::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),
                Forms\Components\Select::make('user_id')
                ->label('user')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),
                Forms\Components\Select::make('type')
                ->required()
                ->label('Type')
                ->options([
                    'work' => 'Work',
                    'pause' => 'pause',
                   
                ])
                ->searchable(),
                Forms\Components\DateTimePicker::make('day_in')
                ->required()
                ,
                
               Forms\Components\DateTimePicker::make('day_out')
               ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('calendar.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('type')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'work' => 'success',
                    'pause' => 'info',
                    
                })
                ->searchable(),
                Tables\Columns\TextColumn::make('day_in')
                ->searchable(),
                Tables\Columns\TextColumn::make('day_out')
                ->searchable(),
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
                    ExportBulkAction::make()
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
            'index' => Pages\ListTimesheeds::route('/'),
            'create' => Pages\CreateTimesheed::route('/create'),
            'edit' => Pages\EditTimesheed::route('/{record}/edit'),
        ];
    }
}
