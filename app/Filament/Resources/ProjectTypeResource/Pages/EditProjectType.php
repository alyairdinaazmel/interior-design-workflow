<?php

namespace App\Filament\Resources\ProjectTypeResource\Pages;

use App\Filament\Resources\ProjectTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectType extends EditRecord
{
    protected static string $resource = ProjectTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
