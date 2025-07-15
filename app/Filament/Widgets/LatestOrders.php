<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $icon = 'heroicon-o-shopping-bag';
    public function table(Table $table): Table
    {
        return $table->query(Order::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Customer'),
                Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
                Tables\Columns\BadgeColumn::make('status')->colors(['warning'=>'pending','success'=>'paid','danger'=>'failed']),
            ]);
    }
}
