<x-filament-breezy::auth-card action="submit">
<style>
h1 {text-align: center;}
</style>
<h1><b>社團法人中華民國青澀芷蘭菁英培育發展協會</b></h1>
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <div>
        <h2 class="font-bold tracking-tight text-center text-2xl">
            {{ __('filament-breezy::default.reset_password.heading') }}
        </h2>
        <p class="mt-2 text-sm text-center">
            {{ __('filament-breezy::default.or') }}
            <a class="text-primary-600" href="{{route('filament.auth.login')}}">
                {{ strtolower(__('filament::login.heading')) }}
            </a>
        </p>
    </div>

    @unless($hasBeenSent)
    {{ $this->form }}

    <x-filament::button type="submit" class="w-full">
        {{ __('filament-breezy::default.reset_password.submit.label') }}
    </x-filament::button>
    @else
    <span class="block text-center text-success-600 font-semibold">{{ __('filament-breezy::default.reset_password.notification_success') }}</span>
    @endunless
</x-filament-breezy::auth-card>
