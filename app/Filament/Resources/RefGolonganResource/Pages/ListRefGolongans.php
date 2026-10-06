<?php

namespace App\Filament\Resources\RefGolonganResource\Pages;

use App\Filament\Resources\RefGolonganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRefGolongans extends ListRecords
{
    protected static string $resource = RefGolonganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
