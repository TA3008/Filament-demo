<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\TabsFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\Pages\EditOrder;
use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\Pages\CreateOrder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationLabel = 'Đơn hàng';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('customer_name')->label('Tên khách hàng')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('total_amount')->label('Tổng tiền')->numeric()->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Đang chờ',
                        'processing' => 'Đang xử lý',
                        'completed' => 'Hoàn tất',
                        'cancelled' => 'Đã hủy',
                        'refunded' => 'Đã hoàn tiền',
                    ])
                    ->required(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')->label('Khách hàng')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('total_amount')->label('Tổng tiền')->money('VND'),
                TextColumn::make('status')->label('Trạng thái')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'refunded' => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                ->label('Trạng thái')
                ->options([
                    'pending' => 'Đang chờ',
                    'processing' => 'Đang xử lý',
                    'completed' => 'Hoàn tất',
                    'cancelled' => 'Đã hủy',
                    'refunded' => 'Đã hoàn tiền',
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
