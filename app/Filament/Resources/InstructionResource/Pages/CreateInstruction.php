<?php

namespace App\Filament\Resources\InstructionResource\Pages;

use App\Filament\Resources\InstructionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInstruction extends CreateRecord
{
    protected static string $resource = InstructionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return '簡章新增成功';
    }
}
