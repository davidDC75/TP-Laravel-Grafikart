<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="row">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="" />
        </div>

        <!-- Password -->
        <div class="row">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="row">
            <label for="remember_me" class="form-check-label">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <span class="">{{ __('Se Souvenir de moi') }}</span>
            </label>
        </div>

        <div class="row">
            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Se Connecter') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
