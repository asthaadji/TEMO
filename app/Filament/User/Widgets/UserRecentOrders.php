<?php

namespace App\Filament\User\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class UserRecentOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Pesanan Terbaru Anda';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Mengambil 5 pesanan terakhir HANYA milik user ini
                Order::query()
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->label('Invoice'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ]),
                Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Pesan')->dateTime(),
            ])
            ->actions([
                // Tambahkan action untuk melihat detail jika ada halaman view
                // Tables\Actions\ViewAction::make()->url(fn(Order $record) => YourResource::getUrl('view', ['record' => $record]))
            ]);
    }
}