@php
    $solutionsModalId = 'solutionsModal_' . md5($section);
    $solutionsButtonId = 'showSolutionsButton_' . md5($section);
    $solutionsCloseId = 'closeSolutionsButton_' . md5($section);

    $descriptionModalId = 'descriptionModal_' . md5($section);
    $descriptionButtonId = 'showDescriptionButton_' . md5($section);
    $descriptionCloseId = 'closeDescriptionButton_' . md5($section);

    $max = $maxScores[$section] ?? 20;
    $percent = round(($data['score'] / $max) * 100);
@endphp
@php
    $sectionPeople = $featuredPeople->filter(function($person) use ($section) {
        return strtolower($person->related_talent) === strtolower($section);
    })->values();

    $sectionBooks = $featuredBooks->filter(function($book) use ($section) {
        return strtolower($book->related_talent) === strtolower($section);
    })->values();
        $interpretationForSection = $interpretations[$section] ?? 'تفسیر ثبت نشده است.';
@endphp


<div x-data="{ loaded: false, percent: 0, showShimmer: true }" 
     x-init="
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !loaded) {
                    loaded = true;
                    showShimmer = false;
                    percent = {{ $percent }};
                    $nextTick(() => {
                        fillProgress('{{ md5($section) }}', percent);
                    });
                    observer.disconnect();
                }
            });
        }, { threshold: 0.5 });
        observer.observe($el);
        setTimeout(() => { showShimmer = false }, 2000);
     "
     class="bg-white/80 section-box pt-4 opacity-0 translate-y-8 transition-all duration-700 ease-out border border-orange-300 rounded-xl shadow-xl flex flex-col items-center w-full max-w-[230px] min-h-[250px] hover:scale-105">

    <p class="text-sm lg:text-lg font-bold text-[#1dd1a1] mb-1">{{ $section }}</p>

    {{-- شِیمر --}}
    <template x-if="showShimmer">
        <div class="relative w-16 h-16 sm:w-20 sm:h-20 shimmer">
            <svg width="70" height="70" viewBox="0 0 120 120" class="rotate-90 drop-shadow-md">
                <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
                <circle cx="60" cy="60" r="50" stroke="#f97316" stroke-width="8" fill="none" stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
            </svg>
        </div>
    </template>

    {{-- نمودار درصد --}}
    <template x-if="!showShimmer && loaded">
        <div class="relative w-20 h-20 sm:w-24 sm:h-24">
            <svg viewBox="0 0 120 120" class="absolute inset-0 w-full h-full rotate-90 drop-shadow-md">
                <defs>
                    <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#1dd1a1" />
                        <stop offset="100%" stop-color="#54a0ff" />
                    </linearGradient>
                </defs>
                <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
                <circle id="progressRing_{{ md5($section) }}" cx="60" cy="60" r="50" stroke="url(#progressGradient)" stroke-width="8" fill="none" stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center text-sm sm:text-md font-extrabold text-[#54a0ff]">
                {{ $percent }}%
            </div>
        </div>
    </template>

  
    {{-- دکمه توضیح استعداد --}}
    @if (!empty($description))
        <button id="{{ $descriptionButtonId }}" class="mt-2 px-4 py-2 bg-[#54a0ff] text-white text-xs sm:text-sm rounded-lg hover:bg-[#1dd1a1] transition">
            📘 توضیح استعداد
        </button>
    @endif

    {{-- دکمه راهکارها --}}
    @if (!empty($data['suggestions']))
        <button id="{{ $solutionsButtonId }}" class="mt-2 mb-4 px-4 py-2 bg-[#1dd1a1] text-white text-xs sm:text-sm rounded-lg hover:bg-[#54a0ff] transition">
            💡 مشاهده راهکارها
        </button>
    @endif
</div>

{{-- مدال توضیح استعداد --}}

@if (!empty($description))
<div id="{{ $descriptionModalId }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-[999999] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white rounded-lg w-11/12 sm:w-2/3 md:w-3/4 p-4 max-h-[80vh] overflow-y-auto">
        
        <h3 class="text-sm md:text-base font-semibold text-[#54a0ff] mb-4">📘 سوالات مربوط به این استعداد:</h3>

        <div x-data="{ openDesc: false, openInterpretation: false, openPeople: false }" class="space-y-4">

            {{-- توضیح استعداد --}}
            <div class="border rounded-lg">
                <button @click="openDesc = !openDesc" class="w-full flex justify-between items-center p-3 text-right text-[#3867d6] font-medium">
                    <span>➕ توضیح این استعداد چیه؟</span>
                    <span x-show="!openDesc">⬇️</span>
                    <span x-show="openDesc">⬆️</span>
                </button>
                <div x-show="openDesc" x-transition class="p-6 text-sm text-gray-700 leading-relaxed">
                    ✅ {{ $description }}
                </div>
            </div>

            {{-- تفسیر توانایی ها --}}
            <div class="border rounded-lg">
                <button @click="openInterpretation = !openInterpretation" class="w-full flex justify-between items-center p-3 text-right text-[#3867d6] font-medium">
                    <span>تفسیر توانایی‌ها در این حوزه</span>
                    <span x-show="!openInterpretation">⬇️</span>
                    <span x-show="openInterpretation">⬆️</span>
                </button>
                <div x-show="openInterpretation" x-transition class="p-6 text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                    ✅ {!! nl2br(e($interpretation)) !!}
                </div>
            </div>

            {{-- افراد شاخص --}}
            @if ($sectionPeople->isNotEmpty())
            <div class="border rounded-lg">
                <button @click="openPeople = !openPeople" class="w-full flex justify-between items-center p-3 text-right text-[#10ac84] font-medium">
                    <span>➕ چه افراد شاخصی این استعداد رو داشتن؟</span>
                    <span x-show="!openPeople">⬇️</span>
                    <span x-show="openPeople">⬆️</span>
                </button>

                <div x-show="openPeople" x-transition class="p-3">
                    <div 
                        x-data="{
                            current: 0,
                            init() {
                                setInterval(() => {
                                    this.current = (this.current + 1) % {{ $sectionPeople->count() }};
                                }, 3000);
                            }
                        }" 
                        class="relative w-full"
                    >
                        <div class="overflow-hidden relative h-48 sm:h-56">
                            @foreach ($sectionPeople as $index => $person)
                                <div x-show="current === {{ $index }}" 
                                    x-transition:enter="transition ease-out duration-500"
                                    x-transition:enter-start="opacity-0 transform translate-x-10"
                                    x-transition:enter-end="opacity-100 transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 transform translate-x-0"
                                    x-transition:leave-end="opacity-0 transform -translate-x-10"
                                    class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 space-y-2 bg-gray-50 rounded-lg shadow"
                                >
                                    <img src="{{ asset($person->image_url) }}" alt="{{ $person->name }}" class="w-20 h-20 rounded-full object-cover shadow-md mb-2">
                                    <p class="font-bold text-[#54a0ff] text-sm sm:text-base">{{ $person->name }}</p>
                                    <p class="text-xs text-gray-600">🎯 {{ $person->related_talent }}</p>
                                    @if ($person->general_talent)
                                        <p class="text-xs text-gray-500">🔍 {{ $person->general_talent }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <button id="{{ $descriptionCloseId }}" class="mt-6 px-4 py-2 bg-gray-500 text-white text-sm rounded hover:bg-gray-600 w-full">
            بستن
        </button>
    </div>
</div>
@endif


@if (!empty($data['suggestions']) || $sectionBooks->isNotEmpty())
<div id="{{ $solutionsModalId }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-[999999] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white rounded-lg w-11/12 sm:w-2/3 md:w-3/4 p-4 max-h-[80vh] overflow-y-auto">

        <h3 class="text-sm md:text-base font-semibold text-[#1dd1a1] mb-4">💡 سوالات متداول مربوط به این استعداد:</h3>

        <div x-data="{ open1: false, open2: false }" class="space-y-4">

            {{-- سوال: راهکارها --}}
            <div class="border rounded-lg">
                <button @click="open1 = !open1" class="w-full flex justify-between items-center p-3 text-right text-[#10ac84] font-medium">
                    <span>➕ راهکار برای تقویت این استعداد چیه؟</span>
                    <span x-show="!open1">⬇️</span>
                    <span x-show="open1">⬆️</span>
                </button>
                <div x-show="open1" x-transition class="p-3 text-sm text-gray-700 space-y-2">
                    <ul class="list-disc pl-5">
                        @foreach ($data['suggestions'] as $tip)
                            <li>🚀 {{ $tip }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- سوال: کتاب‌ها --}}
            @if ($sectionBooks->isNotEmpty())
            <div class="border rounded-lg">
                <button @click="open2 = !open2" class="w-full flex justify-between items-center p-3 text-right text-[#10ac84] font-medium">
                    <span>➕ چه کتاب‌هایی برای والدین پیشنهاد می‌شه؟</span>
                    <span x-show="!open2">⬇️</span>
                    <span x-show="open2">⬆️</span>
                </button>
                <div x-show="open2" x-transition class="p-3">

                    <div 
                        x-data="{
                            currentBook: 0,
                            init() {
                                setInterval(() => {
                                    this.currentBook = (this.currentBook + 1) % {{ $sectionBooks->count() }};
                                }, 3000);
                            }
                        }"
                        class="relative w-full"
                    >
                        <div class="overflow-hidden relative h-48 sm:h-56">
                            @foreach ($sectionBooks as $index => $book)
                            <div x-show="currentBook === {{ $index }}" 
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 transform translate-x-10"
                                 x-transition:enter-end="opacity-100 transform translate-x-0"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform translate-x-0"
                                 x-transition:leave-end="opacity-0 transform -translate-x-10"
                                 class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 space-y-2 bg-gray-50 rounded-lg shadow"
                            >
                                <img src="{{ asset($book->image_url) }}" alt="{{ $book->name }}" class="w-24 h-32 rounded-lg object-cover shadow-md mb-2">
                                <p class="font-bold text-[#54a0ff] text-sm sm:text-base">{{ $book->name }}</p>
                                @if ($book->general_talent)
                                    <p class="text-xs text-gray-600">🎯 {{ $book->general_talent }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            @endif

        </div>

        <button id="{{ $solutionsCloseId }}" class="mt-6 px-4 py-2 bg-gray-500 text-white text-sm rounded hover:bg-gray-600 w-full">
            بستن
        </button>
    </div>
</div>
@endif



{{-- شِیمر استایل --}}
@once
    @push('styles')
        <style>
            .shimmer {
                background: linear-gradient(to right, #f3f3f3 8%, #e0e0e0 18%, #f3f3f3 33%);
                background-size: 800px 104px;
                animation: shimmer 2s infinite linear;
            }

            @keyframes shimmer {
                0% { background-position: -468px 0; }
                100% { background-position: 468px 0; }
            }
        </style>
    @endpush
@endonce

{{-- اسکریپت مدال --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modals = [
            {
                buttonId: '{{ $descriptionButtonId }}',
                modalId: '{{ $descriptionModalId }}',
                closeId: '{{ $descriptionCloseId }}'
            },
            {
                buttonId: '{{ $solutionsButtonId }}',
                modalId: '{{ $solutionsModalId }}',
                closeId: '{{ $solutionsCloseId }}'
            }
        ];

        modals.forEach(({ buttonId, modalId, closeId }) => {
            const button = document.getElementById(buttonId);
            const modal = document.getElementById(modalId);
            const close = document.getElementById(closeId);

            if (button && modal && close) {
                const modalContent = modal.querySelector('.bg-white');

                const openModal = () => {
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100');
                };

                const closeModal = () => {
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    modal.classList.remove('opacity-100');
                };

                button.addEventListener('click', openModal);
                close.addEventListener('click', closeModal);

                modal.addEventListener('click', (e) => {
                    if (!modalContent.contains(e.target)) {
                        closeModal();
                    }
                });
            }
        });
    });

    function fillProgress(id, percent) {
        const circle = document.getElementById('progressRing_' + id);
        const radius = 50;
        const circumference = 2 * Math.PI * radius;
        const duration = 800;
        const start = performance.now();

        function animate(time) {
            const progress = Math.min((time - start) / duration, 1);
            circle.style.strokeDashoffset = circumference - ((percent / 100) * circumference * progress);
            if (progress < 1) requestAnimationFrame(animate);
        }

        requestAnimationFrame(animate);
    }
</script>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
