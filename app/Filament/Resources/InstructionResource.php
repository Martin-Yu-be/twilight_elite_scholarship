<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructionResource\Pages;
use App\Filament\Resources\InstructionResource\RelationManagers;
use App\Models\Instruction;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class InstructionResource extends Resource
{
    protected static ?string $model = Instruction::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('獎學金申請簡章')
                ->schema([
                    TextInput::make('name')->required(),
                    SpatieMediaLibraryFileUpload::make('簡章檔案')
                    ->collection('instructions')
                    ->preserveFilenames()
                    ->enableDownload()
                    ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListInstructions::route('/'),
            'create' => Pages\CreateInstruction::route('/create'),
            'edit' => Pages\EditInstruction::route('/{record}/edit'),
        ];
    }    
}
