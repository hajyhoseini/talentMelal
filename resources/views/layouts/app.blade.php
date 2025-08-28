<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>سامانه استعدادیابی</title>

    <!-- Fonts & Styles -->
    <link href="{{ asset('css/databaseTable.css') }}" rel="stylesheet">
<!-- لینک CSS دیتاتیبل از CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Webfonts/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/databaseTable.css') }}" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- <script src="//unpkg.com/alpinejs" defer></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Style -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body, button, input, select, textarea {
            font-family: 'Vazir', sans-serif !important;
        }

        .custom-page-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            z-index: 0;
            min-height: 100%;
        }

        .custom-page-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
        }

        .shimmer {
            background: linear-gradient(to right, #f3f3f3 8%, #e0e0e0 18%, #f3f3f3 33%);
            background-size: 800px 104px;
            animation: shimmer 1.3s infinite linear;
        }

        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }
            100% {
                background-position: 468px 0;
            }
        }

        /* کارت‌ها با تاخیر نمایان بشن */
        .lazy-card {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s ease;
        }

        .lazy-card.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased custom-page-bg">
    <div class="min-h-screen flex flex-col">
        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
    </div>

    <!-- Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- اول jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- بقیه اسکریپت‌ها -->
<script src="{{ asset('js/global.min.js') }}"></script>
<script src="{{ asset('js/chart.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/deznav-init.js') }}"></script>

<!-- اسکریپت‌های defer (بدون مشکل) -->
<script src="{{ asset('js/loop.js') }}" defer></script>
<script defer src="{{ asset('js/alpine.js') }}"></script>


<!-- jQuery (الزامی برای دیتاتیبل) -->

<!-- DataTables JS -->

    <!-- 📊 Progress Circle Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const circles = document.querySelectorAll('circle[data-score]');
            circles.forEach(circle => {
                const score = parseFloat(circle.getAttribute('data-score')) || 0;
                const percent = Math.min((score / 20) * 100, 100);
                const radius = circle.getAttribute('r') || 50;
                const circumference = 2 * Math.PI * radius;

                circle.style.strokeDasharray = circumference;
                circle.style.strokeDashoffset = circumference;

                let start = null;
                const duration = 800;

                function animate(timestamp) {
                    if (!start) start = timestamp;
                    const progress = Math.min((timestamp - start) / duration, 1);
                    const offset = circumference - (percent / 100) * circumference * progress;
                    circle.style.strokeDashoffset = offset;
                    if (progress < 1) {
                        requestAnimationFrame(animate);
                    }
                }

                requestAnimationFrame(animate);
            });

            // 🔁 کارت‌ها با تاخیر ظاهر بشن (شبیه تلگرام)
            const cards = document.querySelectorAll('.lazy-card');
            setTimeout(() => {
                cards.forEach((el, index) => {
                    setTimeout(() => {
                        el.classList.add('show');
                    }, index * 150); // تاخیر هر کارت
                });
            }, 500); // تاخیر اولیه برای کل
        });
    </script>
<script>
  if (window.jQuery) {
    console.log('jQuery loaded!');
  } else {
    console.log('jQuery NOT loaded!');
  }
</script>

    @stack('scripts')
</body>
</html>
