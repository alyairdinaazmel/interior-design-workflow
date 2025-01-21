<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkflowTemplateResource\Pages;
use App\Filament\Resources\WorkflowTemplateResource\RelationManagers;
use App\Models\WorkflowTemplate;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkflowTemplateResource extends Resource
{
    protected static ?string $model = WorkflowTemplate::class;

    // Set a custom icon for Templates if you like:
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // Override the navigation label
    public static function getNavigationLabel(): string
    {
        return 'Templates';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Define form fields, for example:
            \Filament\Forms\Components\TextInput::make('name')->required(),
            \Filament\Forms\Components\Textarea::make('description')->required(),
            // You might also want a repeater for WorkflowStages, etc.
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            \Filament\Tables\Columns\TextColumn::make('description')->limit(50),
        ])->actions([
            \Filament\Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\WorkflowTemplateResource\Pages\ListWorkflowTemplates::route('/'),
            'create' => \App\Filament\Resources\WorkflowTemplateResource\Pages\CreateWorkflowTemplate::route('/create'),
            'edit' => \App\Filament\Resources\WorkflowTemplateResource\Pages\EditWorkflowTemplate::route('/{record}/edit'),
        ];
    }
}