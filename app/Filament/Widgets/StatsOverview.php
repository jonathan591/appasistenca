<?php

namespace App\Filament\Widgets;

use App\Models\Holidy;
use App\Models\Timesheed;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalEmployees = User::all()->count();
        $totalHolidays = Holidy::where('type','pending')->count();
        $totalTimesheets = Timesheed::all()->count();
        return [
            //
            Stat::make('Employees', $totalEmployees),
            Stat::make('Pending Holidays', $totalHolidays),
            Stat::make('Timesheets', $totalTimesheets),

        ];
    }
}
