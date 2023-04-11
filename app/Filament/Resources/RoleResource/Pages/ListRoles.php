<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected static ?string $title = '角色權限管理';

    protected static ?string $breadcrumb = '角色清單';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('新增角色'),
        ];
    }
}
