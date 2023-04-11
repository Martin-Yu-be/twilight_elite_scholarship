<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructionResource\Pages;
use App\Models\Instruction;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class InstructionResource extends Resource
{
    protected static ?string $model = Instruction::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = '簡章 PDF 設定';

    protected static ?string $breadcrumb = '簡章 PDF 設定';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Section::make('獎學金申請簡章')
                        ->schema(
                            [
                                TextInput::make('name')->label('文件名稱')->disabled(),
                                SpatieMediaLibraryFileUpload::make('簡章檔案')
                                    ->collection('instructions')
                                    ->preserveFilenames()
                                    ->enableDownload()
                                    ->required(),
                            ]
                        ),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    TextColumn::make('name')->label('文件名稱'),
                    TextColumn::make('created_at')->label('建立時間')->date('Y-m-d H:i:s'),
                ]
            )
            ->filters(
                [
                    //
                ]
            )
            ->actions(
                [
                    Tables\Actions\EditAction::make(),
                ]
            )
            ->bulkActions(
                [
                ]
            );
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
