<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\District;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = '平台用戶管理';

    protected static ?string $breadcrumb = '平台用戶管理';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    TextInput::make('name')->label('姓名')->required()->maxLength(255),
                    TextInput::make('email')->email()->required()->maxLength(255),
                    TextInput::make('password')->label('密碼')->password()->dehydrateStateUsing(fn ($state) => Hash::make($state))->dehydrated(fn ($state) => filled($state))->required(fn (Page $livewire) => ($livewire instanceof CreateUser))->maxLength(255),
                    Select::make('district_id')->label('學區')->options(District::all()->pluck('name', 'id')->toArray())->reactive()->afterStateUpdated(fn (callable $set) => $set('school_id', null))->required(),
                    Select::make('school_id')->label('高中學校')->options(
                        function (callable $get) {
                            $district = District::find($get('district_id'));
                            if (! $district) {
                                return District::all()->pluck('name', 'id');
                            }

                            return $district->schools->pluck('name', 'id');
                        }
                    )->required(),
                    Select::make('roles')->label('角色')->multiple()->relationship('roles', 'name')->preload()->maxItems(1)->required(),
                    Card::make()->schema([TextInput::make('remark')->label('文字註記')->maxLength(255)])->columns(1),
                    Toggle::make('is_activated')->label('帳號啟用')->default(true),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    TextColumn::make('roles.name')->label('角色')->sortable(),
                    TextColumn::make('name')->label('姓名')->searchable(),
                    TextColumn::make('email')->searchable(),
                    TextColumn::make('district.name')->label('學區')->sortable(),
                    TextColumn::make('school.name')->label('高中學校')->sortable(),
                    IconColumn::make('is_activated')->label('帳號啟用')->boolean()
                        ->trueIcon('heroicon-o-badge-check')
                        ->falseIcon('heroicon-o-x-circle'),
                ]
            )
            ->filters(
                [
                    SelectFilter::make('school_id')->label('高中學校')->relationship('school', 'name')
                    // 用 options 排除不分校
                        ->options(
                            [
                                '2' => '基隆高中',
                                '3' => '基隆女中',
                                '4' => '武陵高中',
                                '5' => '桃園高中',
                                '6' => '中大壢中',
                                '7' => '內壢高中',
                                '8' => '陽明高中',
                                '9' => '竹北高中',
                                '10' => '新竹中學',
                                '11' => '新竹女中',
                                '12' => '湖口高中',
                                '13' => '苗栗高中',
                                '14' => '竹南高中',
                                '15' => '中興高中',
                                '16' => '南投高中',
                                '17' => '彰化高中',
                                '18' => '彰化女中',
                                '19' => '嘉義高中',
                                '20' => '嘉義女中',
                                '21' => '台南一中',
                                '22' => '台南女中',
                                '23' => '高雄中學',
                                '24' => '高雄女中',
                                '25' => '三民高中',
                                '26' => '屏東高中',
                                '27' => '屏東女中',
                                '28' => '潮州高中',
                                '29' => '台東高中',
                                '30' => '台東女中',
                                '31' => '花蓮高中',
                                '32' => '花蓮女中',
                                '33' => '宜蘭女中',
                                '34' => '蘭陽女高',
                                '35' => '羅東高中',
                            ]
                        ),
                    SelectFilter::make('roles')->label('角色')->relationship('roles', 'name'),
                    SelectFilter::make('district_id')->label('學區')->relationship('district', 'name'),
                ]
            )
            ->actions(
                [
                    Tables\Actions\EditAction::make(),
                ]
            )
            ->bulkActions(
                [
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $userId = Auth::id();

        if (! $user->hasRole('管理員')) {
            return parent::getEloquentQuery()->where('id', $userId);
        }

        return parent::getEloquentQuery();
    }
}
