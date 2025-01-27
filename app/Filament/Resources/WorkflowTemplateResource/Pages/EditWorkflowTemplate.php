<?php

namespace App\Filament\Resources\WorkflowTemplateResource\Pages;

use App\Filament\Resources\WorkflowTemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkflowTemplate extends EditRecord
{
    protected static string $resource = WorkflowTemplateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            // You can add more custom actions here if needed
        ];
    }

    /**
     * Override the default redirect URL after saving.
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
