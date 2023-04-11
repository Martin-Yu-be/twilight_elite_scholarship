<?php

namespace App\Filament\Pages;

use App\Models\Instruction;
use Filament\Pages\Page;

class Instructionpdf extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $slug = 'instructionpdf';

    protected static ?string $navigationLabel = '獎學金申請簡章';

    protected static ?string $title = '青澀芷蘭公立高中清寒學生教育補助計畫';

    protected static string $view = 'filament.pages.instructionpdf';

    protected static ?int $navigationSort = 3;

    public string $publicFullUrl; // Livewire 需要先初始化 變數

    public function mount(): void //  可以用 mount 將變數傳入 
    {
        $instruction = Instruction::first();
        
        if (is_null($instruction)) {
            $this->publicFullUrl = 'storage/青澀芷蘭公立高中清寒學生教育補助計畫.pdf';
        } else if (is_null($instruction->getFirstMedia('instructions'))) {
            $this->publicFullUrl = 'storage/青澀芷蘭公立高中清寒學生教育補助計畫.pdf';
        } else {
            $media = $instruction->getFirstMedia('instructions');
            $media->file_name = '青澀芷蘭公立高中清寒學生教育補助計畫' . date('Y-m-d') . '.pdf';
            $media->save();

            $this->publicFullUrl = $media->getFullUrl();
        }
    }
}
