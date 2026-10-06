<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Pegawai')
                    ->schema([
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(30),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\TextInput::make('gelar_depan')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('gelar_belakang')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Data Jabatan & Unit')
                    ->schema([
                        Forms\Components\Select::make('unit_id')
                            ->relationship('unitKerja', 'nama')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('golongan_id')
                            ->relationship('golongan', 'kode')
                            // Menggunakan accessor getKodePangkatAttribute() dari Model RefGolongan
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->kode} - {$record->pangkat}")
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('jabatan')
                            ->maxLength(200),
                        Forms\Components\Toggle::make('is_aktif')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->copyable(),
                // Memanggil virtual Accessor yang kita buat di Model
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Pegawai')
                    ->searchable(['nama', 'gelar_depan', 'gelar_belakang'])
                    ->sortable(['nama']),
                Tables\Columns\TextColumn::make('golongan.kode')
                    ->label('Gol/Pangkat')
                    ->description(fn (Pegawai $record): string => $record->golongan?->pangkat ?? '')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jabatan')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_aktif')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit_id')
                    ->relationship('unitKerja', 'nama')
                    ->label('Filter Unit Kerja'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }
}