<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\ProjectType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationLabel = 'Projects';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Project Name')
                    ->maxLength(255),
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required()
                    ->label('Client')
                    ->searchable(),
                Select::make('project_type_id')
                    ->relationship('projectType', 'name')
                    ->required()
                    ->label('Project Type')
                    ->searchable()
                    ->preload() // Preload options for better performance
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('Type Name')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function ($state, $record) {
                        return ProjectType::create(['name' => $state])->id;
                    }),
                Select::make('workflow_template_id')
                    ->relationship('workflowTemplate', 'name')
                    ->required()
                    ->label('Workflow Template')
                    ->searchable(),
                TextInput::make('budget')
                    ->numeric()
                    ->required()
                    ->label('Budget')
                    ->prefix('$')
                    ->minValue(0),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->label('Start Date')
                    ->maxDate(now()->addYears(5)),
                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->label('End Date')
                    ->afterOrEqual('start_date'),
                Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Active' => 'Active',
                        'Completed' => 'Completed',
                        'On Hold' => 'On Hold',
                    ])
                    ->required()
                    ->label('Status'),
            ]),
            Textarea::make('project_description')
                ->label('Project Description')
                ->rows(3)
                ->columnSpan(2),
            // Add other form components as needed
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')
                ->sortable()
                ->label('ID'),
            TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->label('Project Name'),
            TextColumn::make('client.name')
                ->label('Client')
                ->sortable()
                ->searchable(),
            TextColumn::make('projectType.name')
                ->label('Project Type')
                ->sortable()
                ->searchable(),
            TextColumn::make('budget')
                ->money('usd') // Adjust currency as needed
                ->sortable()
                ->label('Budget'),
            TextColumn::make('workflowTemplate.name')
                ->label('Workflow Template')
                ->sortable()
                ->searchable(),
            TextColumn::make('start_date')
                ->date()
                ->sortable()
                ->label('Start Date'),
            TextColumn::make('end_date')
                ->date()
                ->sortable()
                ->label('End Date'),
            TextColumn::make('status')
                ->sortable()
                ->label('Status'),
            TextColumn::make('created_at')
                ->dateTime('M d, Y')
                ->label('Created At'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'Pending' => 'Pending',
                    'Active' => 'Active',
                    'Completed' => 'Completed',
                    'On Hold' => 'On Hold',
                ])
                ->label('Status'),
            Tables\Filters\SelectFilter::make('project_type_id')
                ->relationship('projectType', 'name')
                ->label('Project Type'),
            Tables\Filters\SelectFilter::make('client_id')
                ->relationship('client', 'name')
                ->label('Client'),
            // Add more filters as needed
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            // Add custom actions if necessary
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relation managers if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
