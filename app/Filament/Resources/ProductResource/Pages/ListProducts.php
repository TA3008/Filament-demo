<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use App\Models\Product;
use Filament\Actions\Imports\ImportAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Imports\ImportColumn;
use App\Filament\Resources\ProductResource;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    public function getBreadcrumb(): string
    {
        return 'Danh sách sản phẩm';
    }

    public function getTitle(): string
    {
        return 'Quản lý sản phẩm';
    }

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->model(Product::class)
                ->columns([
                    ImportColumn::make('name'),
                    ImportColumn::make('price'),
                    ImportColumn::make('stock'),
                    ImportColumn::make('description'),
                    ImportColumn::make('image'),
                ]),
        ];
    }
}
