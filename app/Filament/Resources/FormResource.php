<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Filament\Resources\FormResource\RelationManagers;
use App\Models\Form AS FormModel;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\HtmlString;
use App\Models\Instruction;
use  AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction; // find in github src folder


class FormResource extends Resource
{
    protected static ?string $model = FormModel::class;

    protected static ?string $title = '獎學金申請';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationLabel = '獎學金申請';

    public static function form(Form $form): Form
    { 
        return $form
            ->schema([
                // 簡章同意
                Section::make('申請簡章')
                ->schema([
                    Placeholder::make('')->content(new HtmlString('<a href="/agreement" target="_blank"><font color="#F59E0B"><u>獎學金申請簡章</u></font></a>')),
                    Checkbox::make('agreed')->label('我已閱讀並同意相關規定')->required(true),
                ])->visible(function () {
                    $userId = Auth::id();
                    if (FormModel::where('user_id', $userId)->exists()) {
                        return false;
                    }
                    return true;
                })->collapsible(),
                // 帶入 user_id
                Hidden::make('user_id')->default(Auth::id()),
                // Section1: 新生基本資料
                Section::make('新生基本資料')
                ->schema([
                    TextInput::make('applier')->required(),
                    TextInput::make('year')->numeric()->required(),
                    Select::make('semester')->options([
                    '上學期' => '上學期',
                    '下學期' => '下學期',
                    ])
                    ->required(),
                    Select::make('district')
                    ->options([
                        '不分區' => '不分區',
                        '基隆區' => '基隆區',
                        '苗栗區' => '苗栗區',
                        ])
                        ->required(),
                    Select::make('school')
                        ->options([
                        '不分校' => '不分校',
                        '基隆高中' => '基隆高中',
                        '基隆女中' => '基隆女中',
                        '苗栗高中' => '苗栗高中',
                        ])
                        ->required(),
                    TextInput::make('class')->required(),
                    TextInput::make('description')->required(),
                    ])
                ->collapsed(),

                // Section2: 新生訪談問卷
                Section::make('新生訪談問卷')
                ->schema([
                TextInput::make('學生零用金')->required(),
                Select::make('經費來源')->options([
                    '父' => '父',
                    '母' => '母',
                    '親友' => '親友',
                    '打工' => '打工',
                    '其他' => '其他',
                ])->required(),
                Fieldset::make('晤談紀錄一')->visible(function () {
                    $user = Auth::user();
                    $userDistrict = $user->district;
                    $userSchool = $user->school;
                    // var_dump($user);
                    if ($user->hasRole('輔導幹部')) {
                        return true;
                    };

                    if ($user->hasRole('決策委員')) {
                        return true;
                    };

                    if ($user->hasRole('Admin')) {
                        return true;
                    };
                })
                ->schema([
                    TextInput::make('晤談人員一'),
                    TextInput::make('晤談摘要一'),
                    TextInput::make('晤談分數一'),
                    Select::make('推薦順位一')->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        ]),
                    Select::make('推薦錄取一')->options([
                        '是' => '是',
                        '否' => '否',
                        ]),
                    ]),
                    Fieldset::make('晤談紀錄二')->visible(function () {
                        $user = Auth::user();
                        $userDistrict = $user->district;
                        $userSchool = $user->school;
                        // var_dump($user);
                        if ($user->hasRole('輔導幹部')) {
                            return true;
                        };
    
                        if ($user->hasRole('決策委員')) {
                            return true;
                        };

                        if ($user->hasRole('Admin')) {
                            return true;
                        };
                    })
                    ->schema([
                        TextInput::make('晤談人員二'),
                        TextInput::make('晤談摘要二'),
                        TextInput::make('晤談分數二'),
                        Select::make('推薦順位二')->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            ]),
                        Select::make('推薦錄取二')->options([
                            '是' => '是',
                            '否' => '否',
                            ]),
                        ]),
                        Fieldset::make('晤談紀錄三')->visible(function () {
                            $user = Auth::user();
                            $userDistrict = $user->district;
                            $userSchool = $user->school;
                            // var_dump($user);
                            if ($user->hasRole('輔導幹部')) {
                                return true;
                            };
        
                            if ($user->hasRole('決策委員')) {
                                return true;
                            };

                            if ($user->hasRole('Admin')) {
                                return true;
                            };
                        })
                        ->schema([
                            TextInput::make('晤談人員三'),
                            TextInput::make('晤談摘要三'),
                            TextInput::make('晤談分數三'),
                            Select::make('推薦順位三')->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                ]),
                            Select::make('推薦錄取三')->options([
                                '是' => '是',
                                '否' => '否',
                                ]),
                            ])
                ])
                ->collapsed(),

                // Section3: 申請資料附件
                Section::make('申請資料附件')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('attachment')->collection('forms')->preserveFilenames()
                    ->enableDownload(),
                ])
                ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('form_number')->label('申請編號')->sortable(),
                TextColumn::make('applier')->label('申請學生')->searchable(),
                TextColumn::make('year')->sortable(),
                TextColumn::make('semester')->sortable(),
                TextColumn::make('district')->sortable(),
                TextColumn::make('school')->sortable(),
                TextColumn::make('description')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('district')
                ->options([
                    '不分區' => '不分區',
                    '基隆區' => '基隆區',
                    '苗栗區' => '苗栗區',
                ]),
                SelectFilter::make('school')
                ->options([
                    '不分校' => '不分校',
                    '基隆高中' => '基隆高中',
                    '基隆女中' => '基隆女中',
                    '苗栗高中' => '苗栗高中',
                ]),
                SelectFilter::make('semester')
                ->options([
                    '上學期' => '上學期',
                    '下學期' => '下學期',
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export')
                ->withHiddenColumns()
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
           
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $userId = Auth::id();
        $userDistrict = $user->district;
        $userSchool = $user->school;

        if ($userDistrict !== '不分區') {
            if ($user->hasRole('學生')) {
            return parent::getEloquentQuery()->where('user_id', $userId);
            } else if ($userSchool == '不分校') {
                return parent::getEloquentQuery()->where('district', $userDistrict);
            } else {
                return parent::getEloquentQuery()->where('school', $userSchool);
            }
        }
        return parent::getEloquentQuery();
    }
}
