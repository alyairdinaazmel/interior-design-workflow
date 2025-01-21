<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkflowTemplateResource\Pages;
use App\Models\WorkflowTemplate;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
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
                ->relationship('stages') // Ensure WorkflowTemplate model has a 'stages' relationship defined
                ->label('Stages')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->label('Stage Name'),
                    TextInput::make('order')
                        ->label('Order')
                        ->numeric()
                        ->required(),
                    Repeater::make('tasks')
                        ->relationship('tasks') // Ensure WorkflowStage model has a 'tasks' relationship defined
                        ->label('Tasks')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->label('Task Title'),
                            Textarea::make('description')
                                ->label('Task Description'),
                            // You can also add DatePickers for start_date and deadline if needed:
                            // \Filament\Forms\Components\DatePicker::make('start_date')->label('Start Date'),
                            // \Filament\Forms\Components\DatePicker::make('deadline')->label('Deadline'),
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
                ->label('Stages')
                ->counts('stages'),
        ])->actions([
            \Filament\Tables\Actions\EditAction::make(),
            \Filament\Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            \Filament\Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // You can add relation managers here if needed.
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
