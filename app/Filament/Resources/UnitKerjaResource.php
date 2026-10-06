<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitKerjaResource\Pages;
use App\Filament\Resources\UnitKerjaResource\RelationManagers;
use App\Models\UnitKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitKerjaResource extends Resource
{
    protected static ?string $model = UnitKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

  public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('kode')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('nama')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('tipe')
                ->badge()
                ->sortable(),
            Tables\Columns\IconColumn::make('is_aktif')
                ->boolean()
                ->label('Aktif'),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('tipe')
                ->options([
                    'rektorat' => 'Rektorat',
                    'biro' => 'Biro',
                    'fakultas' => 'Fakultas',
                    'prodi' => 'Prodi',
                    'lembaga' => 'Lembaga',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUnitKerjas::route('/'),
            'create' => Pages\CreateUnitKerja::route('/create'),
            'edit' => Pages\EditUnitKerja::route('/{record}/edit'),
        ];
    }
}
