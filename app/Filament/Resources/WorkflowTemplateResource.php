<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkflowTemplateResource\Pages;
use App\Models\WorkflowTemplate;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class WorkflowTemplateResource extends Resource
{
    protected static ?string $model = WorkflowTemplate::class;

    protected static ?string $navigationLabel = 'Templates';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->label('Template Name'),
            Textarea::make('description')
                ->label('Template Description')
                ->required(),
            Repeater::make('stages')
                ->relationship('stages') // Ensure WorkflowTemplate model has a 'stages' relationship
                ->label('Stages')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->label('Stage Name'),
                    TextInput::make('order')
                        ->numeric()
                        ->required()
                        ->label('Order'),
                    Repeater::make('tasks') // Nested repeater for tasks
                        ->relationship('tasks') // Ensure WorkflowTemplateStage model has a 'tasks' relationship
                        ->label('Tasks')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->label('Task Title'),
                            Textarea::make('description')
                                ->nullable()
                                ->label('Task Description'),
                        ])
                        ->createItemButtonLabel('Add Task')
                        ->collapsible(),
                ])
                ->createItemButtonLabel('Add Stage')
                ->collapsible(),
        ]);
    }    

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->label('Template Name'),
            TextColumn::make('description')
                ->limit(50)
                ->label('Description'),
            TextColumn::make('stages_count')
                ->label('Stages Count')
                ->counts('stages'), // Counts the number of related stages
            TextColumn::make('tasks_count')
                ->label('Total Tasks')
                ->counts('stages.tasks'), // Nested count to calculate total tasks across stages
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }
    

    public static function getRelations(): array
    {
        return [
            // Add relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkflowTemplates::route('/'),
            'create' => Pages\CreateWorkflowTemplate::route('/create'),
            'edit' => Pages\EditWorkflowTemplate::route('/{record}/edit'),
        ];
    }
}
