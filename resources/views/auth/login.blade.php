<x-guest-layout>
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">

        <!-- KIRI : FORM LOGIN -->
        <div class="flex items-center justify-center px-8">
            <div class="w-full max-w-md">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <h1 class="text-3xl font-bold mb-6">Login</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password"
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember -->
                    <div class="mt-4 flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600"
                            name="remember">
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>

                    <!-- Action -->
                    <div class="mt-6 flex items-center justify-between">
                        <a href="{{ route('register') }}"
                            class="text-sm text-gray-600 hover:underline">
                            Don't have an account?
                        </a>

                        <x-primary-button>
                            Log in
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>

        <!-- KANAN : GAMBAR -->
        <div class="hidden md:block">
            <img src="https://plus.unsplash.com/premium_vector-1728043307769-772ce775d6b5?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1200"
                class="w-full h-full object-cover"
                alt="Login Image">
        </div>

    </div>
</x-guest-layout>