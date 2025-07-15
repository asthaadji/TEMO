<?php
namespace App\Filament\User\Resources;
use App\Filament\User\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationLabel = 'My Orders';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    public static function form(Form $form): Form { return $form->schema([]); }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->label('Invoice'),
                Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
                Tables\Columns\BadgeColumn::make('status')->colors(['warning'=>'pending','success'=>'paid','danger'=>'failed']),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([ Tables\Actions\ViewAction::make() ]);
    }
    public static function getPages(): array
    {
        return [ 'index' => Pages\ListOrders::route('/') ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}