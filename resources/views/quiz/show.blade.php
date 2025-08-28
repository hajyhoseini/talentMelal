<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">🎯 تست علاقه‌مندی‌های کودکان</h2>
    </x-slot>

   <div class="min-h-screen pt-22 flex justify-center items-center bg-gray-100 bg-mobile"
     style="background-image: url('{{ $quiz->image_url }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;">

        <div class="w-full h-full max-w-2xl p-4 rounded-lg shadow" style="margin-top: -110px;">
        <div id="intro-screen" class="text-center">
    <h3 class="text-3xl bg-white/50 font-bold mb-4 text-black rounded-md py-2">سلام! آماده‌ای شروع کنیم؟</h3>

    <!-- 🔹 توضیحات آزمون -->
  <!-- 🔹 توضیحات آزمون -->
<div class="text-left bg-white/40 rounded-lg p-4 text-gray-800 mb-6 leading-relaxed shadow  text-lg lg:text-xl font-bold">
    {!! $quiz->description_min !!}
</div>




 <button onclick="autoFillAnswers()" class="bg-blue-600 text-xl xl:text-3xl font-bold text-white px-6 py-2 rounded hover:bg-blue-700 mt-4">
        تست خودکار (خیلی زیاد)
    </button>
    <button onclick="startQuiz()" class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800 text-xl xl:text-3xl font-bold">
        شروع
    </button>
</div>


<form method="POST" action="{{ route('quiz.submit', ['quizId' => $quiz->id]) }}" id="quiz-form" class="hidden pt-10">    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
    @csrf

    <div class="text-left pr-8 space-y-3 text-2xl text-black">
        @foreach ($questions as $section => $sectionQuestions)
            <div class="pb-5 mt-4 section {{ $loop->first ? '' : 'hidden' }}" data-section="{{ $loop->index }}">
                <h3 class="text-center text-xl xl:text-3xl font-bold py-4 bg-black/50 rounded-md text-white">{{ $section }}</h3>

                @foreach ($sectionQuestions as $index => $question)
                    <div class="question {{ $loop->first ? '' : 'hidden' }}" data-question="{{ $index }}">
                        <p class="font-semibold mt-4 rounded-md text-xl xl:text-3xl">{{ $question->question }}</p>
                        <div class="mt-10 text-lg xl:text-3xl font-bold">
                            @foreach ($question->options as $option)
                                <div class="answer-option">
                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $option->value }}">
                                    <span>{{ $option->label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- دکمه‌ها و پیشرفت -->
    <div class="flex justify-between items-center">
        <button type="button" onclick="prevStep()" id="prev-btn" class="hidden text-2xl bg-yellow-300 px-6 py-2 rounded font-bold text-black">
            قبلی
        </button>

        <span class="p-2 rounded-md text-2xl font-bold bg-white/50 text-black">
            پیشرفت: <span class="text-xl" id="progress-percent">0%</span>
        </span>
    </div>

    <!-- دکمه ارسال -->
    <div class="flex justify-center">
        <button type="submit" id="submit-btn"
                class="hidden text-xl mb-4 bg-green-500 text-white px-6 py-2 rounded-md flex items-center gap-3 justify-center transition-all">
            <span class="submit-text">ارسال</span>
            <span class="spinner hidden"></span>
        </button>
    </div>
</form>



        </div>
    </div>

    <!-- 🎨 استایل‌ها -->
    <style>
        .pt-22{
            padding-top: 35px;
        }
    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.2);
        border-top: 4px solid white;
        border-radius: 50%;
        width: 1.5rem;
        height: 1.5rem;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
        @keyframes white-border-blink {
            0%, 100% { border: 2px solid transparent; }
            25%, 75% { border: 2px solid white; }
            50% { border: 2px solid transparent; }
        }

        .white-border-animate {
            animation: white-border-blink 0.5s ease;
            border-radius: 8px;
        }

     .answer-option {
    cursor: pointer;
    padding: 6px 12px;
    border-radius: 12px;
    border: 2px solid white;
    transition: all 0.3s ease;
    background-color: rgba(255, 255, 255, 0.1);
    margin-bottom: 12px; /* ✅ فاصله عمودی بین گزینه‌ها */
}

/* هاله سفید با انیمیشن دودی */
@keyframes smokyGlow {
    0% {
        box-shadow: 0 0 0 rgba(0, 0, 0, 0);
    }
    50% {
        box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.4);
    }
    100% {
        box-shadow: 0 0 0 rgba(0, 0, 0, 0);
    }
}


.smoky-glow {
    animation: smokyGlow 0.6s ease-out;
    border-radius: 12px;
}
.answer-option {
    cursor: pointer;
    padding: 6px 12px;
    border-radius: 12px;
    border: 2px solid black; /* بوردر سفید ثابت */
    transition: all 0.3s ease;
    background-color: rgba(255, 255, 255, 0.1); /* برای دید بهتر در بک‌گراند تیره */
}
.answer-option:hover {
    background-color: rgba(255, 255, 255, 0.2); /* افکت هاور ملایم */
}


        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        .fade-out {
            animation: fadeOut 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }

        @media (max-width: 768px) {
            .bg-mobile {
                background-size: contain !important;
                background-repeat: no-repeat !important;
                background-position: right center !important;
            }
        }
    </style>

    <!-- ⚙️ اسکریپت‌ها -->
    <script>
    // هنگام ارسال فرم: نمایش لودینگ
    document.getElementById("quiz-form").addEventListener("submit", function (e) {
        const button = document.getElementById("submit-btn");
        button.querySelector('.submit-text').classList.add('hidden');
        button.querySelector('.spinner').classList.remove('hidden');
        button.disabled = true;
    });

    let currentSection = 0;
    let currentQuestion = 0;

    const sections = document.querySelectorAll(".section");
    const submitBtn = document.getElementById("submit-btn");
    const prevBtn = document.getElementById("prev-btn");

    function startQuiz() {
        document.getElementById("intro-screen").classList.add("fade-out");
        setTimeout(() => {
            document.getElementById("intro-screen").classList.add("hidden");
            const form = document.getElementById("quiz-form");
            form.classList.remove("hidden");
            form.classList.add("fade-in");
            setTimeout(() => form.classList.remove("fade-in"), 300);
            showQuestion();
            updateButtons();
        }, 300);
    }

    function showQuestion() {
        // پنهان کردن همه سوالات
        sections.forEach(section => {
            section.querySelectorAll(".question").forEach(q => q.classList.add("hidden"));
            section.classList.add("hidden");
        });

        const section = sections[currentSection];
        const question = section.querySelectorAll(".question")[currentQuestion];

        section.classList.remove("hidden");
        question.classList.remove("hidden");
    }

    function nextStep() {
        const questions = sections[currentSection].querySelectorAll(".question");
        if (currentQuestion + 1 < questions.length) {
            currentQuestion++;
        } else if (currentSection + 1 < sections.length) {
            currentSection++;
            currentQuestion = 0;
        } else {
            return; // پایان
        }
        showQuestion();
        updateButtons();
        updateProgress();
    }

    function prevStep() {
        if (currentQuestion > 0) {
            currentQuestion--;
        } else if (currentSection > 0) {
            currentSection--;
            currentQuestion = sections[currentSection].querySelectorAll(".question").length - 1;
        } else {
            return; // در اولین سؤال هستیم
        }
        showQuestion();
        updateButtons();
        updateProgress();
    }

    function updateButtons() {
        prevBtn.classList.toggle("hidden", currentSection === 0 && currentQuestion === 0);
        const total = document.querySelectorAll(".question").length;
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        submitBtn.classList.toggle("hidden", answered < total);
    }

    function updateProgress() {
        const total = document.querySelectorAll(".question").length;
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        const percent = Math.round((answered / total) * 100);
        document.getElementById("progress-percent").textContent = percent + "%";
    }

let isTransitioning = false;

function handlePulse(input) {
    if (isTransitioning) return;
    isTransitioning = true;

    const parent = input.closest('.answer-option');
    parent.classList.add('smoky-glow');

    setTimeout(() => {
        parent.classList.remove('smoky-glow');

        const isLastSection = currentSection === sections.length - 1;
        const questions = sections[currentSection].querySelectorAll(".question");
        const isLastQuestion = currentQuestion === questions.length - 1;

        if (isLastSection && isLastQuestion) {
            // سوال آخره؛ فقط دکمه ارسال رو فعال کن
            updateButtons();
            updateProgress();
            isTransitioning = false;
        } else {
            nextStep();
            setTimeout(() => {
                isTransitioning = false;
            }, 350); // صبر کن سوال بعدی بیاد بعد اجازه بده دوباره کلیک بشه
        }
    }, 400); // زمان انیمیشن انتخاب گزینه
}



    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[type="radio"]').forEach(input => {
            input.addEventListener('change', function () {
                handlePulse(this);
            });
        });

        document.querySelectorAll('.answer-option').forEach(option => {
            option.addEventListener('click', function () {
                const input = this.querySelector('input[type="radio"]');
                if (input) {
                    input.checked = true;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });
    });

    function autoFillAnswers() {
        document.querySelectorAll('.question').forEach(question => {
            const input = question.querySelector('input[value="1"]');
            if (input) input.checked = true;
        });
        updateButtons();
        updateProgress();
        alert("همه پاسخ‌ها با «خیلی زیاد» پر شد ✅");
    }
</script>

</x-app-layout>
