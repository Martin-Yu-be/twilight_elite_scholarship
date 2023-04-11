<?php

namespace App\Filament\Resources\InstructionResource\Pages;

use App\Filament\Resources\InstructionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstruction extends EditRecord
{
    protected static string $resource = InstructionResource::class;

    protected static ?string $title = '簡章 PDF 設定';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return '簡章更新成功';
    }
}
