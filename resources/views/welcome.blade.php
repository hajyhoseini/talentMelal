<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>سامانه آزمون ملل </title>
  <link rel="shortcut icon" href="icons/melalLogo.jpg">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      margin: 0;
      font-family: 'Vazirmatn', sans-serif;
      background-color: #E5E7EB;
      min-height: 100vh;
      color: #333;
    }

    .dashboard-cards,
    .dashboard-cards-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 28px;
      margin-top: 50px;
      padding: 0 5%;
    }

    .card,
    .skeleton-card {
      background: rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(0, 150, 150, 0.1);
      border-radius: 22px;
      padding: 24px 20px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 28px rgba(0, 128, 128, 0.07);
      text-align: center;
      overflow: hidden;
      text-decoration: none;
      transition: all 0.3s ease-in-out;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 30px rgba(0, 128, 128, 0.12);
    }

    .card-img {
      width: 100%;
      height: 160px;
      border-radius: 14px;
      object-fit: cover;
      margin-bottom: 18px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
      opacity: 0;
      transition: opacity 0.6s ease-in-out;
    }

    .card-img.lazy-img-loaded {
      opacity: 1;
    }

    .card-title {
      font-size: 20px;
      font-weight: 700;
      margin: 0 auto;
      padding: 8px 14px;
      border-radius: 12px;
      display: inline-block;
    }

    .card-text {
      font-size: 25px;
      margin-top: 14px;
      line-height: 1.9;
      border-radius: 10px;
    }

    .footer {
      text-align: center;
      padding: 30px 0;
      font-size: 14px;
      color: #777;
    }

    .skeleton-card {
      position: relative;
      overflow: hidden;
    }

    .skeleton-shimmer {
      position: absolute;
      top: 0;
      left: -150px;
      width: 100px;
      height: 100%;
      background: linear-gradient(120deg, transparent, rgba(255,255,255,0.5), transparent);
      animation: shimmer 1.6s infinite;
    }

    @keyframes shimmer {
      100% {
        transform: translateX(400px);
      }
    }

    .skeleton-img,
    .skeleton-title,
    .skeleton-text {
      background-color: rgba(200, 200, 200, 0.3);
      border-radius: 10px;
      margin-bottom: 12px;
    }

    .skeleton-img {
      height: 160px;
      margin-bottom: 20px;
    }

    .skeleton-title {
      height: 24px;
      width: 60%;
      margin: 0 auto;
    }

    .skeleton-text {
      height: 18px;
      width: 80%;
      margin: 10px auto;
    }

    .real-cards .card {
      opacity: 0;
      transform: translateY(40px);
      transition: all 0.8s ease;
    }

    .real-cards .card.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .card {
  position: relative;
  border: 1px solid rgba(0, 128, 128, 0.1);
  border-radius: 22px;
  padding: 26px 20px;
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 22px rgba(0, 150, 150, 0.08);
  text-align: center;
  text-decoration: none;
  transition: all 0.3s ease-in-out;
  overflow: hidden;
}

.card:hover {
  transform: translateY(-8px) scale(1.015);
  box-shadow: 0 12px 35px rgba(0, 150, 150, 0.15);
}

.card::before {
  content: '';
  position: absolute;
  top: -60px;
  right: -60px;
  width: 120px;
  height: 120px;
  transform: rotate(45deg);
}

.card-icon {
  font-size: 60px;
  margin-bottom: 12px;
  color: #008080;
  opacity: 0.8;
}

.card-title {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 8px;
}

.card-text {
  font-size: 15px;
  line-height: 1.8;
  padding: 10px 14px;
  border-radius: 12px;
}

    @media (max-width: 768px) {
      .dashboard-cards,
      .dashboard-cards-section {
        grid-template-columns: 1fr;
      }
    }
    .dashboard-cards {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  padding: 16px;
}

.card {
  background-color: white;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  padding: 20px;
  text-align: center;
  transition: 0.3s ease;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
}

.card-icon {
  font-size: 24px;
  margin-bottom: 8px;
}

.card-title {
  font-weight: bold;
  margin-bottom: 6px;
}

.card-text {

  font-size: 14px;
}

/* حالت 4 ستونه در دسکتاپ */
@media (min-width: 1024px) {
  .dashboard-cards {
    grid-template-columns: repeat(4, 1fr);
  }
}

  </style>
</head>

<body>

  <div class="header">
    <nav class="navbar"></nav>
  </div>

  <div id="main-wrapper">
    @include('layouts.components.imageHeader')
    @include('layouts.components.sidebar')
  

  <div class="content-body">
    <div class="container-fluid">

 <div class="mx-auto bg-white  mt-10 mb-8 text-center    border border-teal-200 rounded-3xl p-6 sm:p-7 shadow-xl relative overflow-hidden transition duration-300 hover:shadow-2xl text-sm sm:text-base">

  <h2 class="text-xl w-1/2 mx-auto sm:text-2xl md:text-3xl py-2 rounded-lg bg-[#E5E7EB] font-extrabold text-black mb-3 sm:mb-4">
    🌟 سامانه استعدادیابی ملل
  </h2>

  <p class="text-sm w-full mx-auto bg-[#E5E7EB] sm:text-base rounded-lg md:text-lg text-gray-800 font-semibold py-3 leading-relaxed sm:leading-loose ">
    بنیاد ملل ، همراه شما در مسیر کشف و شکوفایی استعدادها. <br />
    با آزمون‌های دقیق، تحلیل‌های هوشمند و راهکارهای فردی‌سازی‌شده، <br />
    آینده‌ای روشن‌تر، فقط یک تصمیم با شما فاصله دارد. <br />
    امروز شروع کن، فردا بدرخش!
  </p>
</div>



 

  <style>
    .fade {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #2d3748;
      padding: 16px;
      max-width: 320px;
      margin: 0 auto;
    }
  </style>
</div>


<div class="dashboard-cards">
  <div class="card">
    <div class="card-icon bg-[#969BA0] w-fit p-2 mx-auto rounded-pill">💰</div>
    <div class="card-title bg-[#E5E7EB] z-20 w-fit p-2 mx-auto rounded-lg px-2"> اعتبار کیف پول شما</div>
    <div class="card-text bg-[#E5E7EB] w-fit mx-auto">100,000 تومان</div>
  </div>

  <div class="card">
    <div class="card-icon bg-[#969BA0] w-fit p-2 mx-auto rounded-pill">📝</div>
    <div class="card-title bg-[#E5E7EB] z-20 w-fit p-2 mx-auto rounded-lg px-2">آزمون‌های آماده انجام</div>
    <div class="card-text bg-[#E5E7EB] w-fit mx-auto">{{ count($exams) }} آزمون</div>
  </div>

  <div class="card">
    <div class="card-icon bg-[#969BA0] w-fit p-2 mx-auto rounded-pill">🛍️</div>
    <div class="card-title bg-[#E5E7EB] z-20 w-fit p-2 mx-auto rounded-lg px-2">محصولات خریداری شده</div>
    <div class="card-text bg-[#E5E7EB] w-fit mx-auto">5 محصول</div>
  </div>

  <div class="card">
    <div class="card-icon bg-[#969BA0] w-fit p-2 mx-auto rounded-pill">🎓</div>
    <div class="card-title bg-[#E5E7EB] z-20 w-fit p-2 mx-auto rounded-lg px-2">بسته‌های آموزشی شما</div>
    <div class="card-text bg-[#E5E7EB] w-fit mx-auto">3 بسته فعال</div>
  </div>
</div>


      <!-- اسکلت بار -->
      <div class="dashboard-cards-section skeletons">
        @for ($i = 0; $i < 4; $i++)
          <div class="skeleton-card">
            <div class="skeleton-img"></div>
            <div class="skeleton-title"></div>
            <div class="skeleton-text"></div>
            <div class="skeleton-shimmer"></div>
          </div>
        @endfor
      </div>

      <!-- کارت‌های واقعی -->
   <!-- کارت‌های واقعی آزمون -->
     <h2 class="text-xl text-center  w-2/3   mx-auto sm:text-2xl md:text-3xl py-3 rounded-lg bg-white font-extrabold text-black mb-3 sm:mb-2 mt-3">
    ازمون های استعداد یابی
</h2>
   <div class="dashboard-cards-section real-cards" style="display: none;">
     
   @if ($exams->isEmpty())
          <p>هیچ آزمونی برای نمایش وجود ندارد.</p>
        @else
@foreach ($exams as $exam)
  <a href="{{ route('login', ['quiz_id' => $exam->id]) }}" class="card">
    <img src="{{ asset($exam->image ?? 'images/default.jpg') }}" alt="{{ $exam->title }}" class="card-img lazy-img" loading="lazy">
    <div class="card-title">{{ $exam->title }}</div>
    <div class="card-text">{{ Str::limit($exam->description, 120) }}</div>
  </a>
@endforeach

        @endif
      </div>
      <section class="mt-16 text-center text-sm text-gray-600 px-4">
  🧠 آیا می‌دانستید؟  
  <span class="block mt-2 text-teal-800 font-semibold">یادگیری مستمر، تنها تفاوت پایدار میان افراد موفق و متوسط است.</span>
</section>


@include('layouts.components.faq')

<footer>
<x-footer/>
</footer>
    </div>
  </div>
  </div>
 


  <script src="js/global.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/deznav-init.js"></script>

  <!-- Lazy Load + Skeleton + Intersection Observer -->
  <script>
     // باز و بسته کردن تماس و سوالات
     document.querySelectorAll('.contact-button').forEach((button) => {
      button.addEventListener('click', () => {
        const answer = button.nextElementSibling;
        answer.classList.toggle('hidden');
      });
    });

    document.querySelectorAll('.faq-question').forEach((question) => {
      question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        answer.classList.toggle('hidden');
      });
    });

    // بارگذاری کارت‌ها بعد از ۲ ثانیه بدون نیاز به اسکرول
    document.addEventListener("DOMContentLoaded", function () {
      const skeletons = document.querySelector('.skeletons');
      const realCards = document.querySelector('.real-cards');
      const cards = realCards.querySelectorAll('.card');

      setTimeout(() => {
        // مخفی‌سازی اسکلت‌ها
        skeletons.style.display = 'none';
        // نمایش کارت‌ها
        realCards.style.display = 'grid';

        cards.forEach((card, index) => {
          setTimeout(() => {
            card.classList.add('visible');
            const img = card.querySelector('.lazy-img');
            if (img && !img.classList.contains('lazy-img-loaded')) {
              img.onload = () => img.classList.add('lazy-img-loaded');
              if (img.complete) img.classList.add('lazy-img-loaded');
            }
          }, index * 100);
        });
      }, 2000); // ۲ ثانیه صبر
    });
    document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('welcomeModal');
    const closeBtn = document.getElementById('closeWelcomeModal');

    // بررسی اینکه آیا قبلاً مدال نمایش داده شده یا نه
    const hasSeenModal = localStorage.getItem('welcomeModalSeen');

    if (!hasSeenModal) {
      // نمایش مدال پس از کمی تاخیر
      setTimeout(() => {
        modal.classList.remove('hidden');
      }, 1000);
    }

    closeBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
      // ذخیره اینکه کاربر مدال رو دیده
      localStorage.setItem('welcomeModalSeen', 'true');
    });
  });

</script>
<!-- Modal خوش‌آمدگویی با Lottie -->
<div id="welcomeModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-2xl shadow-xl p-6 max-w-md w-1/2 text-center">
    
    <!-- انیمیشن Lottie -->
    <lottie-player
      src="https://assets9.lottiefiles.com/packages/lf20_myejiggj.json"
      background="transparent"
      speed="1"
      style="width: 150px; height: 150px; margin: 0 auto;"
      loop
      autoplay
    ></lottie-player>

    <!-- متن خوش آمدگویی -->
    <h2 class="text-xl font-bold text-teal-800 mt-4 mb-2">👋 به سامانه استعدادیابی ملل خوش آمدید</h2>
    <p class="text-gray-700 text-sm leading-relaxed">
      اینجا جایی برای کشف و شکوفایی استعدادهای شماست. <br>
      با ما همراه باشید تا مسیر رشدتان را باهم بسازیم. <br>
      از همراهی‌تان خوشحالیم!
    </p>

    <!-- دکمه بستن -->
    <button id="closeWelcomeModal" class="mt-4 px-6 py-2 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition-all">
      شروع کنید
    </button>
  </div>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

</body>
</html>
