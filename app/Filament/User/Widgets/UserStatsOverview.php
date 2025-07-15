<?php

namespace App\Filament\User\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UserStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Mengambil data pesanan hanya untuk user yang sedang login
        $totalOrders = Order::where('user_id', Auth::id())->count();
        $pendingOrders = Order::where('user_id', Auth::id())->where('status', 'pending')->count();
        $paidOrders = Order::where('user_id', Auth::id())->where('status', 'paid')->count();

        return [
            Stat::make('Total Pesanan', $totalOrders)
                ->description('Semua pesanan yang pernah Anda buat')
                ->icon('heroicon-o-shopping-cart')
                ->color('primary'),

            Stat::make('Pesanan Diproses', $pendingOrders)
                ->description('Pesanan yang menunggu pembayaran')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Pesanan Selesai', $paidOrders)
                ->description('Pesanan yang sudah lunas')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}