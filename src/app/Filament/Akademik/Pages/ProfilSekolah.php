<?php

namespace App\Filament\Akademik\Pages;

use App\Models\Sekolah;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class ProfilSekolah extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Profil Sekolah';
    protected static ?string $navigationGroup = 'Administration';
    protected static ?int $navigationSort = 10;
    protected static string $view = 'filament.akademik.pages.profil-sekolah';
    protected static ?string $title = 'Profil Sekolah';

    public ?array $data = [];

    public function mount(): void
    {
        $sekolah = Sekolah::getInstance();
        $this->form->fill($sekolah->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identitas Sekolah')
                    ->icon('heroicon-o-identification')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nama_sekolah')
                            ->label('Nama Sekolah')
                            ->disabled()
                            ->columnSpanFull(),
                        TextInput::make('npsn')
                            ->label('NPSN')
                            ->disabled(),
                        TextInput::make('nss')
                            ->label('NSS')
                            ->disabled(),
                        TextInput::make('kepala_sekolah')
                            ->label('Kepala Sekolah')
                            ->disabled(),
                        Select::make('akreditasi')
                            ->label('Akreditasi')
                            ->options([
                                'A' => 'A (Unggul)',
                                'B' => 'B (Baik)',
                                'C' => 'C (Cukup)',
                                'Belum' => 'Belum Terakreditasi',
                            ])
                            ->disabled(),
                        TextInput::make('tahun_berdiri')
                            ->label('Tahun Berdiri')
                            ->disabled(),
                    ]),

                Section::make('Alamat & Kontak')
                    ->icon('heroicon-o-map-pin')
                    ->columns(2)
                    ->schema([
                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->disabled()
                            ->columnSpanFull(),
                        TextInput::make('kota')
                            ->label('Kota/Kabupaten')
                            ->disabled(),
                        TextInput::make('provinsi')
                            ->label('Provinsi')
                            ->disabled(),
                        TextInput::make('kode_pos')
                            ->label('Kode Pos')
                            ->disabled(),
                        TextInput::make('telepon')
                            ->label('Telepon')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('Email Sekolah')
                            ->disabled(),
                        TextInput::make('website')
                            ->label('Website')
                            ->disabled(),
                    ]),

                Section::make('Visi, Misi, Tujuan & Sasaran')
                    ->icon('heroicon-o-light-bulb')
                    ->schema([
                        Textarea::make('visi')
                            ->label('Visi')
                            ->rows(3)
                            ->disabled()
                            ->columnSpanFull(),
                        Textarea::make('misi')
                            ->label('Misi')
                            ->rows(5)
                            ->disabled()
                            ->columnSpanFull(),
                        Textarea::make('tujuan')
                            ->label('Tujuan')
                            ->rows(4)
                            ->disabled()
                            ->columnSpanFull(),
                        Textarea::make('sasaran')
                            ->label('Sasaran')
                            ->rows(4)
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                Section::make('Logo Sekolah')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->disabled()
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }
}