<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;
    
    protected static ?string $heading = 'Sản phẩm được thêm theo tháng';

    protected function getData(): array
    {
        $data = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $data->pluck('month')->map(function ($month) {
            return 'Tháng ' . (int) $month;
        });

        $values = $data->pluck('count');

        return [
            'datasets' => [
                [
                    'label' => 'Số sản phẩm',
                    'data' => $values,
                    'backgroundColor' => '#f59e0b', // màu cam
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // các lựa chọn khác: 'line', 'pie', 'doughnut'
    }
}
