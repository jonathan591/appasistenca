<?php

namespace App\Filament\Personal\Widgets;

use App\Models\Holidy;
use App\Models\Timesheed;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class personalWidget extends BaseWidget
{
    protected function getStats(): array
    {


        return [
            Stat::make('Vaciones pendiantes', $this->getPendingHoliday(Auth::user())),
            Stat::make('Vacaciones Aprovadas', $this->getApprovedHoliday(Auth::user())),
            Stat::make('Total trabajas', $this->getTotalWork(Auth::user())),
            Stat::make('Total Pause', $this->getTotalPause(Auth::user())),
        ];
    }

    protected function getPendingHoliday(User $user){
        $totalPendingHolidays = Holidy::where('user_id',$user->id)
            ->where('type','pending')->get()->count();

            return $totalPendingHolidays;
    }
    protected function getApprovedHoliday(User $user){
        $totalApprovedHolidays = Holidy::where('user_id',$user->id)
            ->where('type','approved')->get()->count();

            return $totalApprovedHolidays;
    }
    protected function getTotalWork(User $user){
        $timesheets = Timesheed::where('user_id', $user->id)
            ->where('type','work')->whereDate('created_at', Carbon::today())->get();
        $sumSeconds = 0;
        foreach ($timesheets as $timesheet) {
            # code...
            $startTime = Carbon::parse($timesheet->day_in);
            $finishTime = Carbon::parse($timesheet->day_out);

            $totalDuration = $finishTime->diffInSeconds($startTime);
            $sumSeconds = $sumSeconds + $totalDuration;

        }
        $tiempoFormato = gmdate("H:i:s", $sumSeconds);

        return $tiempoFormato;

    }
    protected function getTotalPause(User $user){
        $timesheets = Timesheed::where('user_id', $user->id)
            ->where('type','pause')->whereDate('created_at', Carbon::today())->get();
        $sumSeconds = 0;
        foreach ($timesheets as $timesheet) {
            # code...
            $startTime = Carbon::parse($timesheet->day_in);
            $finishTime = Carbon::parse($timesheet->day_out);

            $totalDuration = $finishTime->diffInSeconds($startTime);
            $sumSeconds = $sumSeconds + $totalDuration;

        }
        $tiempoFormato = gmdate("H:i:s", $sumSeconds);

        return $tiempoFormato;

    }
}
