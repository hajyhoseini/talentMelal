<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-indigo-600" />
            </a>
        </x-slot>

        {{-- نمایش خطاهای اعتبارسنجی --}}
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        {{-- پیام موفقیت --}}
        @if(session('success'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('success') }}
            </div>
        @endif

        {{-- فرم ورود یا ثبت‌نام --}}
        <form method="POST" action="{{ route('login') }}" class="rtl text-right">
            @csrf

            {{-- نام و نام خانوادگی --}}
            <div>
                <x-label for="name" :value="'نام و نام خانوادگی'" />
                <x-input id="name" name="name" type="text" class="block mt-1 w-full" value="{{ old('name') }}" required autofocus />
            </div>

            {{-- کد ملی --}}
            <div class="mt-4">
                <x-label for="national_code" :value="'کد ملی'" />
                <x-input id="national_code" name="national_code" type="text" maxlength="10" class="block mt-1 w-full" value="{{ old('national_code') }}" required />
            </div>

            {{-- hidden input برای quiz_id --}}
            @if(request()->has('quiz_id'))
                <input type="hidden" name="quiz_id" value="{{ request()->query('quiz_id') }}">
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4 bg-indigo-600 text-white px-4 py-2 rounded">
                    ورود یا ثبت‌نام
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
