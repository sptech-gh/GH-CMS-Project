<?php

namespace App\Filament\Resources\ChurchResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select user to attach
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('users', 'name') // Correct: relate to User model
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('role')
                    ->label('Role in Church')
                    ->options([
                        'member' => 'Member',
                        'choir'  => 'Choir',
                        'usher'  => 'Usher',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('pivot.role')
                    ->label('Role')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'member' => 'Member',
                        'choir'  => 'Choir',
                        'usher'  => 'Usher',
                        default  => ucfirst($state),
                    })
                    ->colors([
                        'success' => ['member'],  // 🟩 green
                        'warning' => ['choir'],   // 🟨 yellow
                        'danger'  => ['usher'],   // 🟥 red
                    ]),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Add Member'),
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
