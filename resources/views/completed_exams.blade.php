<x-app-layout>
    {{-- 🎯 عنوان صفحه --}}
    <x-slot name="header">
        <h2 class="text-xl sm:text-2xl md:text-3xl text-center font-bold py-6 text-teal-900">
            📜 آزمون‌های تکمیل شده شما
        </h2>
    </x-slot>

    {{-- 🔳 محتوای اصلی با فاصله از سایدبار راست --}}
    <div id="main-wrapper">
        @include('layouts.components.imageHeader')
        @include('layouts.components.sidebar')
        
        <div class="content-body">
            <div class="container-fluid">
                <div class="mx-auto w-full mt-10 mb-8 text-center bg-gradient-to-br from-white/70 to-teal-50/60 backdrop-blur-xl border border-teal-200 rounded-3xl shadow-xl relative overflow-hidden transition duration-300 hover:shadow-2xl text-sm sm:text-base">
                    
                    @if ($completedExams->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach ($completedExams as $exam)
                                <div class="card bg-white rounded-2xl shadow-lg p-6">
                                    @if ($exam->image)
                                        <div class="mt-4 mb-6">
<img src="{{ asset($exam->image) }}" alt="{{ $exam->title }}"
     class="mx-auto w-full sm:w-3/4 md:w-full h-auto object-contain rounded-lg shadow-lg max-h-32 sm:max-h-40 md:max-h-48">
                                        </div>
                                    @endif

                                    <div class="card-title text-center text-2xl sm:text-3xl font-semibold text-teal-700 mb-4">
                                        {{ $exam->title }}
                                    </div>

                                    <div class="card-text text-center text-xs sm:text-sm text-gray-600 mt-2" style="direction: rtl; unicode-bidi: plaintext; font-family: Tahoma;">
                                        تاریخ تکمیل: <span class="font-bold">{{ $exam->formatted_date }}</span>
                                    </div>

                                    <div class="flex justify-center mt-6">
<a href="{{ route('quiz.results', ['userId' => auth()->id(), 'quizId' => $exam->id]) }}" 
   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition duration-300">
    دیدن کارنامه
</a>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 mt-10">هیچ آزمونی تکمیل نشده است.</p>
                    @endif

                    @include('layouts.components.faq')

                    <footer>
                        <x-footer/>
                    </footer>
                </div>
            </div>
        </div>
    </div>

  <script src="{{ asset('js/completedExams.js') }}"></script>


    <style>
        body {
            margin: 0;
            font-family: 'Vazirmatn', sans-serif;
            background: linear-gradient(135deg, #e0f8f7, #f5ffff);
            min-height: 100vh;
            color: #333;
        }
    </style>
</x-app-layout>
