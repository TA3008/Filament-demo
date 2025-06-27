<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    public function getTitle(): string
    {
        return 'Chỉnh sửa sản phẩm: ' . $this->record->name;
    }

    public function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
