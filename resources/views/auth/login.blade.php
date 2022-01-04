<x-guest-layout>
    {{-- -<x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card> --}}
    <div class="content-body">
        <div class="auth-wrapper auth-v1 px-2">
            <div class="auth-inner py-2">
                <!-- Login v1 -->
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="#" class="brand-logo">
                            <img src="{{asset('images/logo2.png')}}" alt="Olano S.A.C" style="height: 100px">
                        </a>

                        <h4 class="card-title mb-1">Login</h4>
                        <p class="card-text mb-2">Inicie sesión para ingresar al sistema!</p>

                        <form class="auth-login-form mt-2" action="{{ route('signin') }}" method="POST">
                            @csrf
                            <div class="mb-1">
                                <label for="login-email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    placeholder="user@valle.com" aria-describedby="login-email" tabindex="1" autofocus
                                    value="{{ old('email') }}" />
                                    @error('email')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="login-password">Password</label>
                                    <a href="#">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" id="password"
                                        name="password" tabindex="2"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="login-password" />
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember_me" tabindex="3" name="remember"/>
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" tabindex="4">Iniciar sesión</button>
                            @error('error')
                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                    <i data-feather='alert-circle'></i>
                                    <span style="margin-left: 4px">{{ $message }}</span>
                                </div>
                            </div>
                            @enderror
                        </form>
                    </div>
                </div>
                <!-- /Login v1 -->
            </div>
        </div>
    </div>
</x-guest-layout>
