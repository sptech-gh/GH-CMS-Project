<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ChurchesRelationManager extends RelationManager
{
    protected static string $relationship = 'churches'; // must match User::churches()

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pivot.role')
                    ->label('Role in Church')
                    ->options([
                        'pastor'    => 'Pastor',
                        'admin'     => 'Admin',
                        'assistant' => 'Assistant',
                    ])
                    ->required()
                    ->native(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Church Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('pivot.role')
                    ->label('Role')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->colors([
                        'danger'  => ['pastor'],    // 🟥 Pastor
                        'gray'    => ['admin'],     // ⬛ Admin
                        'warning' => ['assistant'], // 🟨 Assistant
                    ])
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Assign Church')
                    ->preloadRecordSelect()
                    ->recordSelectSearchable()
                    ->recordSelectOptionsQuery(function ($query, $livewire) {
                        // Exclude already attached churches
                        $user = $livewire->ownerRecord; // the User being edited
                        return $query->whereNotIn('id', $user->churches()->pluck('churches.id'));
                    })
                    ->form([
                        Forms\Components\Select::make('role')
                            ->label('Role in Church')
                            ->options([
                                'pastor'    => 'Pastor',
                                'admin'     => 'Admin',
                                'assistant' => 'Assistant',
                            ])
                            ->required()
                            ->native(false),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
