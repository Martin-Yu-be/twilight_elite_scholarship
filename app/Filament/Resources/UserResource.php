<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\SelectFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = '用戶管理';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Select::make('district')
                ->options([
                    '全部' => '全部',
                    '基隆區' => '基隆區',
                    '苗栗區' => '苗栗區',
                ])
                ->required(),
            Select::make('school')
                ->options([
                    '全部' => '全部',
                    '基隆高中' => '基隆高中',
                    '苗栗高中' => '苗栗高中',
                    ])
                ->required(),
            TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))->required(fn (Page $livewire) => ($livewire instanceof CreateUser))
                ->maxLength(255),
            Select::make('roles')->multiple()->relationship('roles', 'name')->preload(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('roles.name')->sortable()->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('district')->sortable(),
                TextColumn::make('school')->sortable(),
            ])
            ->filters([
                // SelectFilter::make('roles.name')
                // ->multiple()
                // ->options([
                //     '學生' => '學生',
                //     '校方' => '校方',
                //     '輔導幹部' => '輔導幹部',
                //     '決策委員' => '決策委員',
                // ]),
                SelectFilter::make('district')
                ->multiple()
                ->options([
                    '不分區' => '不分區',
                    '基隆區' => '基隆區',
                    '苗栗區' => '苗栗區',
                ]),
                SelectFilter::make('school')
                ->multiple()
                ->options([
                    '不分校' => '不分校',
                    '基隆高中' => '基隆高中',
                    '基隆女中' => '基隆女中',
                    '苗栗高中' => '苗栗高中',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
