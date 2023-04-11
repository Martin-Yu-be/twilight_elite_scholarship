<x-filament-breezy::auth-card action="authenticate">
<div class="w-full flex justify-center">
        <h1><b>社團法人中華民國青澀芷蘭菁英培育發展協會</b></h1>
    </div>
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <div>
        <h2 class="font-bold tracking-tight text-center text-2xl">
            {{ __('filament::login.heading') }}
        </h2>
        @if(config("filament-breezy.enable_registration"))
        <p class="mt-2 text-sm text-center">
            {{ __('filament-breezy::default.or') }}
            <a class="text-primary-600" href="{{route(config('filament-breezy.route_group_prefix').'register')}}">
                {{ strtolower(__('filament-breezy::default.registration.heading')) }}
            </a>
        </p>
        @endif
    </div>

    {{ $this->form }}

    <div>
         <small>申請全新帳號：請洽詢協會人員，或來信 fudao.78@gmail.com</small>
    </div>
    <x-filament::button type="submit" class="w-full">
        {{ __('filament::login.buttons.submit.label') }}
    </x-filament::button>

    <div class="text-center">
        <a class="text-primary-600 hover:text-primary-700" href="{{route(config('filament-breezy.route_group_prefix').'password.request')}}">{{ __('filament-breezy::default.login.forgot_password_link') }}</a>
    </div>
</x-filament-breezy::auth-card>
