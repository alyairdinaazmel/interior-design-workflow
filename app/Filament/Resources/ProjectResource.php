<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Project Name'),
            Select::make('client_id')
                ->label('Client')
                ->relationship('client', 'name')
                ->required(),
            TextInput::make('budget')
                ->numeric()
                ->required(),
            DatePicker::make('start_date')
                ->required(),
            DatePicker::make('end_date')
                ->nullable(),
            //Dropdown to select Workflow Template
            Select::make('workflow_template_id')
                ->label('Workflow Template')
                ->relationship('workflowTemplate', 'name')
                ->required(),
            Select::make('status')
                ->options([
                    'Not Started' => 'Not Started',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                ])
                ->required(),
            Textarea::make('project_description')
                ->label('Project Description')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('client.name')->label('Client')->sortable()->searchable(),
            TextColumn::make('budget')->sortable()->money('usd'),
            TextColumn::make('start_date')->date()->sortable(),
            TextColumn::make('end_date')->date()->sortable(),
            TextColumn::make('status')->sortable(),
        ])->filters([
            // Add filters if needed.
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
            // Define relationship managers if needed.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
