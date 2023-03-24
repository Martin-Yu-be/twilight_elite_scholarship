<?php

namespace App\Filament\Resources\FormResource\Pages;

use App\Filament\Resources\FormResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use App\Models\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CreateForm extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = FormResource::class;

    protected static ?string $title = '獎學金申請';

    protected function getSteps(): array
    {
        return [
            Step::make('獎學金申請簡章')
            ->description('請閱讀並勾選同意')
            ->schema([
                Grid::make([])
                ->schema([
                    Placeholder::make('')->content(new HtmlString('<a href="/agreement" target="_blank"><font color="#F59E0B"><u>獎學金申請簡章</u></font></a>')),
                    Checkbox::make('agreed')->required()->rules(['accepted'])->label('我已閱讀並同意相關規定'),
                ]),
                Hidden::make('user_id')->default(Auth::id()),
            ]),
        Step::make('Description')
            ->description('Add some extra details')
            ->schema([
                TextInput::make('applier')->label('學生姓名')->required(),
                TextInput::make('year')->label('學年度')->numeric()->required(),
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
            ]),
        Step::make('Visibility')
            ->description('Control who can view it')
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
                            ]), 

            ]),
            Step::make('fileUpload')->label('申請資料附件')
            ->description('請閱讀並勾選同意')
            ->schema([
                SpatieMediaLibraryFileUpload::make('attachment')->collection('forms')->preserveFilenames()->enableDownload(),
            ]),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Form created';
    }
}

