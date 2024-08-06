<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\HolidyResource;
use App\Models\Holidy;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?string $heading = 'Vacaciones';

    protected function getData(): array
    {
        return [
            'datasets' => [
                // [
                //     'label' => 'User',
                //     'backgroundColor' => '#36A2EB',
                //     'borderColor' => '#9BD0F5',
                //     'data' => $this->getDataUser(),
                // ],
                [
                    'label' => 'Vaciones Pending',
                    'backgroundColor' => '#FFCE56',
                    'borderColor' => '#FFDD87',
                    'data' => $this->getHolidayPendingData(),
                ],
                [
                    'label' => 'Vaciones Approved',
                    'backgroundColor' => '#4BC0C0',
                    'borderColor' => '#76D1D1',
                    'data' => $this->getApprovedData(),
                ],
                [
                    'label' => 'Vaciones Declined',
                    'backgroundColor' => '#FF6384',
                    'borderColor' => '#FF8497',
                    'data' => $this->getDeclinedData(),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
    
    protected function getType(): string
    {
        return 'bar';
    }
    
    protected function getDataUser()
    {
        // Obtén los datos de usuarios desde la base de datos o defínelos estáticamente
        return [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89];
    }
    
    protected function getHolidayPendingData()
    {
        return $this->getHolidayDataByType('pending');
    }
    
    protected function getApprovedData()
    {
        return $this->getHolidayDataByType('approved');
    }
    
    protected function getDeclinedData()
    {
        return $this->getHolidayDataByType('decline');
    }
    
    protected function getHolidayDataByType(string $type): array
    {
        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $count = Holidy::where('type', $type)
                ->whereMonth('day', $month)
                ->count();
            $data[] = $count;
        }
        return $data;
}
}