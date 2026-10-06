<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefGolonganResource\Pages;
use App\Filament\Resources\RefGolonganResource\RelationManagers;
use App\Models\RefGolongan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RefGolonganResource extends Resource
{
    protected static ?string $model = RefGolongan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('golongan_utama')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('pangkat')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kelompok_biaya_id')
                    ->numeric(),
                Forms\Components\TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('golongan_utama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pangkat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelompok_biaya_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('urutan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRefGolongans::route('/'),
            'create' => Pages\CreateRefGolongan::route('/create'),
            'edit' => Pages\EditRefGolongan::route('/{record}/edit'),
        ];
    }
}
