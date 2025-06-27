<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    public function getTitle(): string
    {
        return 'Tạo mới sản phẩm: ';
    }

    protected static string $resource = ProductResource::class;
}
