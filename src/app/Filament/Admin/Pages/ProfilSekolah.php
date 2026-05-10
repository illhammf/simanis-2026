<?php

namespace App\Filament\Admin\Pages;

use App\Models\Sekolah;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ProfilSekolah extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Profil Sekolah';
    protected static ?string $navigationGroup = 'Administration';
    protected static ?int $navigationSort = 10;
    protected static string $view = 'filament.admin.pages.profil-sekolah';
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
                    ->description('Informasi utama sekolah')
                    ->icon('heroicon-o-identification')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nama_sekolah')
                            ->label('Nama Sekolah')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('npsn')
                            ->label('NPSN')
                            ->maxLength(20),
                        TextInput::make('nss')
                            ->label('NSS')
                            ->maxLength(30),
                        TextInput::make('kepala_sekolah')
                            ->label('Kepala Sekolah')
                            ->maxLength(255),
                        Select::make('akreditasi')
                            ->label('Akreditasi')
                            ->options([
                                'A' => 'A (Unggul)',
                                'B' => 'B (Baik)',
                                'C' => 'C (Cukup)',
                                'Belum' => 'Belum Terakreditasi',
                            ]),
                        TextInput::make('tahun_berdiri')
                            ->label('Tahun Berdiri')
                            ->maxLength(4)
                            ->numeric(),
                    ]),

                Section::make('Alamat & Kontak')
                    ->description('Lokasi dan informasi kontak sekolah')
                    ->icon('heroicon-o-map-pin')
                    ->columns(2)
                    ->schema([
                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('kota')
                            ->label('Kota/Kabupaten')
                            ->maxLength(100),
                        TextInput::make('provinsi')
                            ->label('Provinsi')
                            ->maxLength(100),
                        TextInput::make('kode_pos')
                            ->label('Kode Pos')
                            ->maxLength(10),
                        TextInput::make('telepon')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(20),
                        TextInput::make('email')
                            ->label('Email Sekolah')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255)
                            ->prefix('https://'),
                    ]),

                Section::make('Visi, Misi, Tujuan & Sasaran')
                    ->description('Pernyataan arah dan tujuan sekolah')
                    ->icon('heroicon-o-light-bulb')
                    ->schema([
                        Textarea::make('visi')
                            ->label('Visi')
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('misi')
                            ->label('Misi')
                            ->rows(5)
                            ->helperText('Gunakan baris baru untuk setiap poin misi')
                            ->columnSpanFull(),
                        Textarea::make('tujuan')
                            ->label('Tujuan')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('sasaran')
                            ->label('Sasaran')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Logo Sekolah')
                    ->description('Upload logo sekolah (PNG/JPG, maks 2MB)')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->imageEditor()
                            ->directory('sekolah')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->icon('heroicon-o-check')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $sekolah = Sekolah::getInstance();
        $sekolah->update($data);

        Notification::make()
            ->title('Data sekolah berhasil disimpan')
            ->success()
            ->send();
    }
}