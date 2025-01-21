<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkflowTemplateResource\Pages;
use App\Models\WorkflowTemplate;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;

class WorkflowTemplateResource extends Resource
{
    protected static ?string $model = WorkflowTemplate::class;

    protected static ?string $navigationLabel = 'Templates';

    protected static ?string $navigationIcon = 'heroicon-o-template';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Template Name'),
            Forms\Components\Textarea::make('description')
                ->label('Template Description'),
            Forms\Components\Repeater::make('stages')
                ->relationship('stages') // Define the stages relationship
                ->label('Stages')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Stage Name'),
                    Forms\Components\TextInput::make('order')
                        ->required()
                        ->numeric()
                        ->label('Stage Order'),
                    Forms\Components\Repeater::make('tasks')
                        ->relationship('tasks') // Define the tasks relationship
                        ->label('Tasks')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->label('Task Title'),
                            Forms\Components\Textarea::make('description')
                                ->label('Task Description'),
                            Forms\Components\DatePicker::make('start_date')
                                ->label('Start Date'),
                            Forms\Components\DatePicker::make('deadline')
                                ->label('Deadline'),
                        ])
                        ->createItemButtonLabel('Add Task')
                        ->collapsible(),
                ])
                ->createItemButtonLabel('Add Stage')
                ->collapsible(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->label('Template Name'),
            Tables\Columns\TextColumn::make('description')
                ->limit(50)
                ->label('Description'),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ]);
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
