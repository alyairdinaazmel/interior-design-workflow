<?php

namespace App\Filament\Resources\ProjectTypeResource\Pages;

use App\Filament\Resources\ProjectTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectTypes extends ListRecords
{
    protected static string $resource = ProjectTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
