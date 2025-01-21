<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkflowsResource\Pages;
use App\Models\WorkflowInstance;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;

class WorkflowsResource extends Resource
{
    protected static ?string $model = WorkflowInstance::class;
    protected static ?string $navigationIcon = 'heroicon-o-view-list';
    
    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('project_id')
                ->label('Project')
                ->relationship('project', 'name')
                ->required(),
            Select::make('workflow_template_id')
                ->label('Workflow Template')
                ->relationship('workflowTemplate', 'name')
                ->required(),
            Select::make('status')
                ->options([
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                ])
                ->default('In Progress')
                ->required(),
            Select::make('current_stage_id')
                ->label('Current Stage')
                ->relationship('currentStage', 'name')
                ->required(),
            DateTimePicker::make('started_at')
                ->default(now())
                ->required(),
            DateTimePicker::make('completed_at')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('project.name')
                ->label('Project')
                ->sortable()
                ->searchable(),
            TextColumn::make('workflowTemplate.name')
                ->label('Template')
                ->sortable()
                ->searchable(),
            TextColumn::make('currentStage.name')
                ->label('Current Stage')
                ->sortable()
                ->searchable(),
            TextColumn::make('status')->sortable(),
            TextColumn::make('started_at')->dateTime()->sortable(),
            TextColumn::make('completed_at')->dateTime()->sortable(),
        ])->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListWorkflows::route('/'),
            'create' => Pages\CreateWorkflows::route('/create'),
            'edit'   => Pages\EditWorkflows::route('/{record}/edit'),
            'view'   => Pages\ViewWorkflows::route('/{record}'),
        ];
    }
   
    public static function getNavigationLabel(): string
{
    return 'Workflows';
}

}
