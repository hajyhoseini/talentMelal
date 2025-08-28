<x-guest-layout>
    <div class="min-h-screen bg-fixed bg-cover bg-center overflow-auto"
         style="background-image: url('{{ asset('images/foggy-scene-with-steam-coming-out-it_1122354-17706.avif') }}');">

        <div class="flex items-center justify-center min-h-screen bg-white bg-opacity-80 backdrop-blur-sm p-4">
            <x-auth-card>
                <x-slot name="logo">
                    <a href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11.5l-7 7-7-7" />
                        </svg>
                    </a>
                </x-slot>

                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6 text-right">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ request('quiz_id') }}">

                    <!-- ایمیل -->
                    <div>
                        <x-label for="email" :value="__('ایمیل')" class="text-gray-700 font-medium" />
                        <x-input id="email" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                 type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- رمز عبور -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('رمز عبور')" class="text-gray-700 font-medium" />
                        <x-input id="password" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                 type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <!-- فیلدهای اضافی برای کاربران خارجی -->
                    @if(request()->get('external') == 1)
                        <div class="mt-4">
                            <x-label for="national_code" :value="__('کد ملی')" class="text-gray-700 font-medium" />
                            <x-input id="national_code" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                     type="text" name="national_code" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="first_name" :value="__('نام')" class="text-gray-700 font-medium" />
                            <x-input id="first_name" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                     type="text" name="first_name" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="last_name" :value="__('نام خانوادگی')" class="text-gray-700 font-medium" />
                            <x-input id="last_name" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                     type="text" name="last_name" required />
                        </div>
                    @endif

                    <!-- مرا به خاطر بسپار و لینک ثبت نام -->
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" class="text-indigo-600" />
                            <a href="/register" class="mr-2 text-gray-700 hover:text-indigo-600 transition-colors duration-200">ثبت نام</a>
                        </div>
                        <div>
                            <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-800">
                                {{ __('رمز عبور خود را فراموش کرده‌اید؟') }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center justify-center mt-6">
                        <x-button class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 px-6 py-3 rounded-md text-lg transition-all duration-300">
                            {{ __('ورود') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
        </div>
    </div>

    <style>
        .space-y-6 > * + * { margin-top: 1.5rem; }
        .x-input, .x-button { transition: all 0.3s ease; }
        .x-input:focus, .x-button:hover { transform: scale(1.05); box-shadow: 0 0 10px rgba(75, 85, 99, 0.2); }
        @media (max-width: 640px) { .x-input, .x-button { padding: 1rem; } }
        .text-indigo-600:hover { text-decoration: underline; }
    </style>
</x-guest-layout>
