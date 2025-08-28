<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base sm:text-lg md:text-xl text-center font-bold py-2 text-teal-900">
            📜 نتایج آزمون
        </h2>
        
    </x-slot>


@php
    $labels = array_keys($results);  // لیبل‌ها: استعدادها
    $scores = array_map(fn($item) => $item['percentage'] ?? 0, $results);  // مقادیر درصد
@endphp

@php
    $sectionCounter = 1;
    function convertToPersianNumber($number) {
        $farsiDigits = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return str_replace(range(0, 9), $farsiDigits, $number);
    }
@endphp


<style>
    canvas {
    height: 200px !important;
    max-height: 200px !important;
}

    @media print {
        .page-break {
            page-break-before: always;
            break-before: page;
        }
    }
    .page-break:first-child {
        page-break-before: auto;
        break-before: auto;
    }

    ol li {
        list-style-type: decimal !important;
    }

    body {
        margin: 0;
        font-family: 'Vazirmatn', sans-serif;
        min-height: 100vh;
        color: #333;
    }
#abilityChart {
    border-radius: 1rem;
    background-color: #969BA0;
    box-shadow: 0 4px 8px #969BA0;
}


.border-gradient {
    border: 3px solid;
    border-image-slice: 1;
    border-width: 3px;
    border-image-source: linear-gradient(to right, #374151, #6B7280, #D1D5DB);
    border-radius: 1rem;
}


    .no-padding {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .full-width-card {
        width: 100% !important;
        max-width: none !important;
        border-radius: 0 !important;
        padding: 0.75rem !important;
        box-sizing: border-box;
    }
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body {
            background: white !important;
            color: black !important;
        }
    }

    /* استایل درباره ما */
    .about-section {
        background: #969BA0;
        border-radius: 0.5rem;
        padding: 2rem 2.5rem;
        margin: 2rem auto;
        max-width: 900px;
        color: #1e293b;
        line-height: 1.6;
        font-size: 1rem;
        box-sizing: border-box;
    }
    .about-section > div.inner-white-box {
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem 2rem;
        box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }
    .about-section h2 {
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 1rem;
        color: black;
        text-align: center;
    }
    .about-section p {
        margin-bottom: 1rem;
        font-weight: 500;
        direction: rtl;
        color: #334155;
    }
</style>



    <div class="flex-1 pt-6 no-padding">
$results = $this->analyze($answers);
dd($results);
ظ
        <div class="text-center bg-[#04cccc] border border-teal-300 full-width-card shadow-lg relative overflow-hidden transition duration-300 hover:shadow-2xl text-xs sm:text-sm">
<div class="page-break"></div>
 <div class="flex flex-col items-center   justify-center pt-6">
     <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12 mb-2">
          <div class="info-box bg-white py-2 rounded-2xl"> <span class="info-box-icon bg-transparent"><i class="ti-face-smile text-black text-2xl mb-2 "></i></span>
            <div class="info-box-content">
              <h6 class="info-box-text text-black mt-1">میزان رضایت</h6>
      <h1 class="text-black border-3 border-black rounded-md inline-block p-1">87%</h1>
      <br>
              <span class="progress-description text-black"> میزان درصد افزایش این ماه 20% </span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-sm-6 col-xs-12 mb-2 ">
          <div class="info-box bg-white py-2 rounded-2xl  text-black"> <span class="mt-2 info-box-icon bg-transparent"><i class="ti-bar-chart text-2xl "></i></span>
            <div class="info-box-content">
              <h6 class="info-box-text text-black mt-1">آزمون دهندگان جدید ماه</h6>
      <h1 class="text-black border-3 border-black rounded-md inline-block p-1">34+</h1>
      <br>
              <span class="progress-description text-black"> میزان درصد افزایش این ماه 30% </span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
      <div class="col-lg-3  col-sm-6 col-xs-12">
  
  <div class="info-box bg-white rounded-2xl mb-2 py-2  flex flex-col items-center text-center">
    
    <span class="info-box-icon bg-transparent mb-1">
      <i class="ti-check text-2xl"></i>
    </span>
    
    <div class="info-box-content flex flex-col items-center">
      
      <h6 class="info-box-text text-black">آزمون های جدید این ماه</h6>
      
      <h1 class="text-black border-3 border-black rounded-md inline-block p-1">3+</h1>
      
      <span class="progress-description text-black"> میزان درصد افزایش این ماه 25% </span>
    
    </div>

  </div>

</div>


        <!-- /.col -->
       <div class="col-lg-3 col-sm-6 col-xs-12    ">
  <div class="info-box bg-white py-2 rounded-2xl flex flex-col items-center text-center">
    
    <span class="info-box-icon bg-transparent mb-1">
      <i class="ti-alert text-2xl"></i>
    </span>
    
    <div class="info-box-content flex flex-col items-center">
      
      <h6 class="info-box-text text-black">میزان درصد دقت آزمون ها</h6>
      
      <h1 class="text-black border-3 border-black rounded-md inline-block p-1">80%</h1>
      
      <span class="progress-description text-black"> میزان درصد افزایش این ماه 25% </span>
    
    </div>

  </div>
</div>

        <!-- /.col --> 
      </div>
      <div class="border mt-8  bg-white border-yellow-300 font-semibold rounded-lg shadow-md p-3 sm:p-6 md:p-8 mb-10 text-gray-800 leading-relaxed text-justify">
    
    <h3 class="text-lg font-bold bg-[#0a7b7b] my-1 text-center text-white mb-4 rounded-lg mx-auto py-2 w-5/6">
        🌟 نتایج آزمون استعدادیابی 🌟
    </h3>
<div class="border-3 p-3 rounded-md border-[#04cccc]" style="white-space: pre-line;">
    {{ $reportDescription }}
</div>


</div>
   @php
    $charts = [
        ['type' => 'ability_chart', 'id' => 'abilityChart'],
        ['type' => 'radar_chart', 'id' => 'radarChart'],
        ['type' => 'scatter_chart', 'id' => 'scatterChart'],
        ['type' => 'bubble_chart', 'id' => 'bubbleChart'],
        ['type' => 'polar_chart', 'id' => 'polarChart'],
        ['type' => 'horizontal_bar_chart', 'id' => 'horizontalBarChart'],
    ];

    $chartTitles = [
        'ability_chart' => '🎯 نمودار درصدی توانایی‌ها',
        'radar_chart' => '📊 نمودار رادار توانایی‌ها',
        'scatter_chart' => '📍 نمودار پراکندگی',
        'bubble_chart' => '💬 نمودار حبابی استعدادها',
        'polar_chart' => '🧭 نمودار قطبی توزیع استعدادها',
        'horizontal_bar_chart' => '📈 نمودار میله‌ای افقی استعدادها',
    ];
@endphp
@foreach(array_chunk($charts, 2) as $chartPair)
    <div class="page-break mb-10 w-full" style="page-break-after: always;">
        @foreach($chartPair as $chart)
            @php
                $item = $talentCharts->firstWhere('chart_type', $chart['type']);
            @endphp
            
            <div class="border bg-[#04cccc] border-teal-300 rounded-lg shadow-lg mb-10 p-2 sm:p-4 md:p-6 w-full">
                
                <h3 class="bg-white p-1 rounded text-center text-lg sm:text-xl md:text-2xl font-semibold text-gray-800 mb-4 sm:mb-6">
                    {{ $chartTitles[$chart['type']] ?? 'عنوان موجود نیست' }}
                </h3>

                <div class="chart-container flex justify-center  w-full">
                    <canvas id="{{ $chart['id'] }}" 
                        class="w-full py-3 px-3 max-w-sm sm:max-w-sm md:max-w-lg h-64 sm:h-72 md:h-80 lg:h-96 bg-white rounded-xl shadow-md"></canvas>
                </div>

                <p class="mt-4 md:w-3/4 mx-auto font-bold text-black px-2 py-2 rounded-md bg-white text-sm sm:text-base md:text-lg text-justify leading-relaxed">
                    {{ $item->description ?? 'توضیح برای این نمودار موجود نیست.' }}
                </p>
            </div>

        @endforeach
    </div>
@endforeach


        </div>
    </div>



            @foreach ($results as $section => $data)
                {{-- صفحه جدید برای شروع هر استعداد جدید --}}
                <div class="page-break"></div>

                {{-- بخش خلاصه عملکرد استعداد --}}
                <div class="mt-2 bg-[#04cccc] rounded-lg py-2 px-3">
                    <div class="bg-white w-7/8 mx-auto p-1/2 rounded-lg ">
                        <h2 class="text-lg font-bold bg-[#0a7b7b] my-1 text-center text-white mb-4 rounded-lg mx-auto py-2 w-5/6">
                            📜 خلاصه‌ای از عملکرد شما در آزمون
                        </h2>
                    </div>

                    <div class="bg-white py-2 rounded-lg w-full lg:w-1/3 mx-auto">
                        <h3 class="font-bold mt-1 text-base p-3 mb-3 bg-blue-300 rounded-lg w-4/5 mx-auto text-center leading-relaxed">
                            <span class="text-white bg-[#0a7b7b] p-2 rounded-lg">بخش {{ convertToPersianNumber($sectionCounter) }}</span>
                            <span class="text-black font-bold">- {{ $section }}</span>
                        </h3>
                    </div>

                    @if (!empty($data['description']))
                        <p class="font-bold text-base bg-white rounded-lg p-3 w-full lg:w-2/3 mx-auto mt-3 leading-relaxed text-left">
                            <span class="text-white mb-1 text-lg bg-[#0a7b7b] p-1 rounded-lg font-semibold">توضیح استعداد:</span>
                            <span class="text-black px-1 font-bold text-center">{{ $data['description'] }}</span>
                        </p>
                    @endif

                    <div class="flex w-2/3 lg:w-1/5 mx-auto bg-white p-1 rounded-lg justify-center gap-4 ">
                        <p class="text-gray-700 font-bold bg-blue-300 rounded-lg p-3 text-sm leading-relaxed mt-2">
                            <span class="text-white bg-[#0a7b7b] p-1 rounded-lg font-semibold">امتیاز:</span>
                            <span class="text-black font-bold">{{ $data['score'] }}</span>
                        </p>

                        <p class="text-gray-700 font-bold bg-blue-300 rounded-lg p-3 text-sm leading-relaxed mt-1">
                            <span class="text-white bg-[#0a7b7b] p-1 rounded-lg font-semibold">سطح:</span>
                            <span class="text-black font-bold">
                                @if ($data['level'] == 'high')
                                    عالی
                                @elseif ($data['level'] == 'medium')
                                    متوسط
                                @else
                                    پایین
                                @endif
                            </span>
                        </p>
                    </div>

                    <p class="font-bold text-base bg-white rounded-lg p-2 w-full lg:w-2/3 mx-auto mt-3 leading-relaxed text-left">
                        <span class="text-white  mb-1 text-lg bg-[#0a7b7b] px-2 py-1 rounded-lg font-semibold ">تفسیر:</span>
                        <span class="text-black font-bold">{{ $data['interpretation'] }}</span>
                    </p>
                </div>

                {{-- صفحه جدید برای پیشنهادات --}}
                @if (!empty($data['suggestions']))
                    <div class="page-break"></div>
                                    <div class="mt-4 bg-[#04cccc] rounded-lg py-2 px-3">

                     <div class=" w-7/8 bg-white mx-auto p-1/2 rounded-lg">
                    <h4 class="text-lg font-bold bg-[#0a7b7b] my-1 text-white mb-2 text-center rounded-lg mx-auto py-2 w-5/6">😉 پیشنهادات</h4>
                     </div>
                    <div class="bg-white  rounded-xl">
  <p class="text-center bg-white text-sm text-black mb-1 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
  در این بخش، نکاتی برای کمک به رشد و تقویت استعدادهای فرزندتان ارائه شده است. این پیشنهادها با توجه به ویژگی‌های فردی او طراحی شده‌اند تا بتوانید بهتر مسیر پیشرفت او را همراهی کنید. همراهی شما نقش مهمی در شکوفایی توانایی‌های فرزندتان خواهد داشت.
</p>

</div>

                    <ol class="text-left text-black font-bold text-base mt-3 bg-white/75 rounded-lg  px-8 py-1 w-full lg:w-2/3 mx-auto leading-relaxed space-y-2" style="list-style-position: inside; direction: rtl;">
                        @foreach ($data['suggestions'] as $suggestion)
                            <li class="bg-white p-1 list-decimal rounded-md">{{ $suggestion }}</li>
                        @endforeach
                    </ol>
                @endif
                                    </div>
                {{-- صفحه جدید جدا برای شغل‌های پیشنهادی --}}
                @if (isset($featuredCareers[$section]) && $featuredCareers[$section]->count())
                    <div class="page-break"></div>
                                                        <div class="mt-4 bg-[#04cccc] rounded-lg py-2 px-3">
                                                            <div class="bg-white w-7/8 mx-auto p-1/2 rounded-lg ">
                    <h4 class="text-lg text-center font-bold bg-[#0a7b7b] my-1 text-white mb-2 rounded-lg mx-auto py-2 w-5/6">
                        💼 شغل‌های پیشنهادی بر اساس استعداد کودک شما
                    </h4>
                                                            </div>
                    <div class="bg-[#0a7b7b]/40  rounded-xl">
                        <p class="text-center mt-2 bg-white text-sm text-black mb-4 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
                            این شغل‌ها بر اساس استعداد برجسته کودک شما در این بخش انتخاب شده‌اند و می‌توانند مسیر مناسبی برای آینده‌ی شغلی فرزندتان باشند.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 py-2 rounded-md bg-white/70 mt-2 md:grid-cols-2 lg:grid-cols-4 gap-4 px-2 max-w-6xl mx-auto mb-6">
                     @foreach ($featuredCareers[$section] ?? [] as $chunk)
    @foreach ($chunk as $career)
                            <div class="bg-[#04cccc] rounded-lg shadow-md p-2 text-center hover:shadow-lg transition">
                                <div class="w-full h-28 overflow-hidden rounded mb-1 flex items-center justify-center bg-gray-100">
                                    <img src="{{ $career->career_image_url }}" alt="{{ $career->career_title }}" class="max-w-full max-h-full object-contain">
                                </div>
                                <p class="font-bold py-2 rounded-md bg-white text-xs text-black mb-1">{{ $career->career_title }}</p>
<p class="font-bold text-xs mt-1 py-1 rounded-md bg-[#0a7b7b] text-white leading-relaxed line-clamp-3">
    {{ $career->career_description }}
</p>
                            </div>
                                @endforeach
                        @endforeach
                    </div>
                @endif
                                                        </div>
                {{-- صفحه جدید جدا برای کتاب‌های پیشنهادی والدین --}}
                @if (isset($featuredBooks[$section]) && $featuredBooks[$section]->count())
                    <div class="page-break"></div>
                    
                     <div class="mt-4 bg-[#04cccc] rounded-lg py-2 px-3">
                        <div class="bg-white w-7/8 mx-auto p-1/2 rounded-lg ">
                    <h4 class="text-lg text-center font-bold bg-[#0a7b7b] my-1 text-white mb-2 rounded-lg mx-auto py-2 w-5/6">
                        📚 کتاب‌های پیشنهادی والدین
                    </h4>
                        </div>
                    <div class="bg-[#0a7b7b]/40  rounded-xl">
                        <p class="text-center mt-3 bg-white text-sm text-black mb-4 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
                            والدین گرامی، مطالعه این کتاب‌ها می‌تواند در درک بهتر استعدادها و حمایت از فرزندان در مسیر رشد و شکوفایی استعدادهایشان بسیار مفید باشد.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 py-2 rounded-md bg-white/70 mt-2 md:grid-cols-2 lg:grid-cols-4 gap-4 px-2 max-w-6xl mx-auto mb-6">
                        @foreach ($featuredBooks[$section] ?? [] as $chunk)
                            @foreach ($chunk as $book)
                            <div class="bg-[#04cccc] rounded-lg shadow-md p-2 text-center hover:shadow-lg transition">
                                    <div class="w-full h-28 overflow-hidden rounded mb-1 flex items-center justify-center bg-gray-100">
                                        <img src="{{ $book->image_url }}" alt="{{ $book->name }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <p class="font-bold py-2 mt-2 rounded-md bg-white text-xs text-black mb-1">{{ $book->name }}</p>
                                    <p class="font-bold text-xs mt-1 py-2 rounded-md bg-[#0a7b7b] text-white leading-relaxed">{{ $book->general_talent }}</p>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                     </div>
                {{-- صفحه جدید برای چهره‌های برجسته --}}
                @if (isset($featuredPeople[$section]) && $featuredPeople[$section]->count())
                    <div class="page-break"></div>
                     <div class="mt-4 bg-[#04cccc] rounded-lg py-2 px-3">
                                                <div class="bg-white w-7/8 mx-auto p-1/2 rounded-lg ">
                    <h4 class="text-lg text-center font-bold bg-[#0a7b7b] my-1 text-white mb-2 rounded-lg mx-auto py-2 w-5/6">
                        🌟 چهره‌های برجسته در این حوزه استعدادی
                    </h4>
                                                </div>
                    <div class="bg-[#0a7b7b]/40  rounded-xl">
                        <p class="text-center mt-3 bg-white text-sm text-black mb-4 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
با تعدادی از افراد شاخص و الهام‌بخش در این حوزه آشنا می‌شوید؛ مسیر موفقیت آن‌ها می‌تواند انگیزه‌ای برای شکوفایی استعدادهای شما باشد.                        </p>
                    </div>
                    <div class="grid grid-cols-2 py-2 rounded-md bg-white/70 mt-2 md:grid-cols-2 lg:grid-cols-4 gap-4 px-2 max-w-6xl mx-auto mb-6">
                        @foreach ($featuredPeople[$section] as $chunk)
                            @foreach ($chunk as $person)
                            <div class="bg-[#04cccc] rounded-lg shadow-md p-2 text-center hover:shadow-lg transition">
                                    <div class="w-full h-28 overflow-hidden rounded mb-1 flex items-center justify-center bg-gray-100">
                                        <img src="{{ $person->image_url }}" alt="{{ $person->name }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <p class="font-bold py-2 mt-1 rounded-md bg-white text-xs text-black mb-1">{{ $person->name }}</p>
                                    <p class="font-bold text-xs mt-1 py-2 rounded-md bg-[#0a7b7b] text-white leading-relaxed">{{ $person->general_talent }}</p>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                    </div>
                @php $sectionCounter++; @endphp
            @endforeach
        </div>

        <div class="w-full flex justify-center">
            <button id="downloadPdfBtn" class="mt-2 mb-3 px-3 py-2 bg-gray-500 text-white text-xs rounded-md hover:bg-gray-400 focus:outline-none transition">
                دانلود PDF
            </button>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    
    document.getElementById('downloadPdfBtn').addEventListener('click', () => {
        window.print();
    });
    
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    
    const labels = @json($labels);
    const scoresObject = @json($scores);
    const scores = labels.map(label => scoresObject[label] || 0);
     
const horizontalBarConfig = {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            data: scores,
            backgroundColor: '#04cccc',
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    color: '#475569',
                    callback: value => `${value}%`,
                    font: {
                        family: 'Vazirmatn, sans-serif',
                        size: 10
                    }
                },
                grid: {
                    color: 'rgba(203, 213, 225, 0.3)'
                }
            },
            y: {
                ticks: {
                    color: '#1f2937',
                    font: {
                        family: 'Vazirmatn, sans-serif',
                        size: 7
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: context => `${context.label}: ${context.raw}%`
                }
            },
            datalabels: {  // فعال کردن پلاگین دیتا لیبل
                anchor: 'end',          // قرار گرفتن روی انتهای میله
                align: 'right',         // چسبیده به سمت راست میله (خارج نمودار)
                color: '#1f2937',       // رنگ متن
                font: {
                    family: 'Vazirmatn, sans-serif',
                    weight: 'bold',
                    size: 10
                },
                formatter: value => `${value}%`  // فرمت متن
            }
        }
    },
    plugins: [ChartDataLabels]  // ثبت پلاگین
};

new Chart(document.getElementById('horizontalBarChart').getContext('2d'), horizontalBarConfig);


    const polarConfig = {
    type: 'polarArea',
    data: {
        labels: labels,
        datasets: [{
            data: scores,
            backgroundColor: [
                'rgba(14, 165, 233, 0.7)',
                'rgba(34, 197, 94, 0.7)',
                'rgba(249, 115, 22, 0.7)',
                'rgba(139, 92, 246, 0.7)',
                'rgba(244, 63, 94, 0.7)',
                'rgba(234, 179, 8, 0.7)',
                'rgba(6, 182, 212, 0.7)'
            ],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            r: {
                ticks: {
                    color: '#475569',
                    font: {
                        family: 'Vazirmatn, sans-serif',
                        size: 10
                    }
                },
                grid: {
                    color: 'rgba(203, 213, 225, 0.3)'
                }
            }
        },
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    font: {
                        family: 'Vazirmatn, sans-serif',
                        size: 9
                    },
                    color: '#1f2937'
                }
            },
            tooltip: {
                callbacks: {
                    label: context => `${context.label}: ${context.raw}%`
                }
            }
        }
    }
};

// bubble chart
const bubbleData = labels.map((label, index) => ({
    x: index + 1,        // اندیس استعداد
    y: scores[index],    // درصد توانایی
    r: (scores[index] / 10) + 5   // شعاع حباب بر اساس نمره
}));

const bubbleConfig = {
    type: 'bubble',
    data: {
        datasets: [{
            label: 'نمودار چندبُعدی (حبابی)',
            data: bubbleData,
            backgroundColor: 'rgba(14, 165, 233, 0.6)', // آبی
            borderColor: 'rgba(14, 165, 233, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                title: { display: true },
                ticks: {
                    callback: (value) => labels[value - 1] || '',
                    color: '#334155',
                    font: { family: 'Vazirmatn, sans-serif', size: 5 }
                },
                grid: { color: 'rgba(203, 213, 225, 0.3)' }
            },
            y: {
                title: { display: true, text: 'درصد' },
                beginAtZero: true,
                max: 100,
                ticks: {
                    callback: val => val + '%',
                    color: '#475569',
                    font: { family: 'Vazirmatn, sans-serif', size: 10 }
                },
                grid: { color: 'rgba(203, 213, 225, 0.3)' }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: ctx => `${labels[ctx.raw.x - 1]}: ${ctx.raw.y}%`
                }
            }
        }
    }
};

 // تولید رنگ‌ها بر اساس شرط نمره
const barColors = scores.map(score => score > 50 ? 'rgba(4, 204, 204, 0.85)' : 'rgba(10, 123, 123, 0.85)');
const borderColors = barColors.map(c => c.replace('0.85', '1'));

// پیکربندی نمودار میله‌ای
const barConfig = {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'درصد توانایی',
            data: scores,
            backgroundColor: barColors,
            borderColor: borderColors,
            borderWidth: 1.5,
            borderRadius: 12,
            barThickness: 25,
            hoverBackgroundColor: 'rgba(15, 118, 110, 0.9)'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 900,
            easing: 'easeOutCubic'
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    callback: value => value + '%',
                    color: '#475569',
                    font: {
                        family: 'Vazirmatn, sans-serif',
                        size: 10,
                        weight: '500'
                    }
                },
                grid: {
                    color: 'rgba(203, 213, 225, 0.3)',
                    drawBorder: false
                }
            },
            x: {
                ticks: {
                    color: '#334155',
                    font: {
                        family: 'Vazirmatn, sans-serif',
                        size: 9
                    }
                },
                grid: { display: false }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#f9fafb',
                borderColor: '#cbd5e1',
                borderWidth: 1,
                titleColor: '#1f2937',
                bodyColor: '#111827',
                titleFont: {
                    family: 'Vazirmatn, sans-serif',
                    weight: 'bold',
                    size: 11
                },
                bodyFont: {
                    family: 'Vazirmatn, sans-serif',
                    size: 10
                },
                padding: 10,
                callbacks: {
                    label: context => `درصد: ${context.parsed.y}%`
                }
            }
        }
    }
};


    // رادار (رنگ قرمز)
    const radarConfig = {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [{
                label: 'درصد توانایی',
                data: scores,
                fill: true,
                backgroundColor: '#04cccc',  // قرمز روشن
                borderColor: '#0a7b7b',       // قرمز تیره
                pointBackgroundColor: '#04cccc',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#0a7b7b'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        backdropColor: 'transparent',
                        color: '#475569',
                        font: {
                            family: 'Vazirmatn, sans-serif',
                            size: 10
                        }
                    },
                    grid: { color: 'rgba(203, 213, 225, 0.3)' },
                    angleLines: { color: 'rgba(203, 213, 225, 0.3)' },
                    pointLabels: {
                        color: '#334155',
                        font: {
                            family: 'Vazirmatn, sans-serif',
                            size: 10
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    };

    // پراکندگی (قرمز)
    const scatterData = labels.map((label, index) => ({
        x: index + 1,
        y: scores[index]
    }));

    const scatterConfig = {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'درصد توانایی بر حسب استعداد',
                data: scatterData,
                backgroundColor: '#04cccc', // قرمز
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    title: { display: true },
                    ticks: {
                        stepSize: 1,
                        callback: (value, index) => labels[value - 1] || value,
                        color: '#334155',
                        font: {
                            family: 'Vazirmatn, sans-serif',
                            size: 10
                        }
                    },
                    grid: { color: 'rgba(203, 213, 225, 0.3)' }
                },
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: { display: true, text: 'درصد توانایی' },
                    ticks: {
                        callback: value => value + '%',
                        color: '#475569',
                        font: {
                            family: 'Vazirmatn, sans-serif',
                            size: 10
                        }
                    },
                    grid: { color: 'rgba(203, 213, 225, 0.3)' }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => `${labels[ctx.parsed.x - 1]}: ${ctx.parsed.y}%`
                    }
                }
            }
        }
    };

    // doughnut chart
    const totalPercentage = scores.reduce((a, b) => a + b, 0) / scores.length;
    const formattedPercentage = totalPercentage.toFixed(1);

    const doughnutData = {
        labels: ['درصد کل', 'باقی‌مانده'],
        datasets: [{
            data: [totalPercentage, 100 - totalPercentage],
            backgroundColor: ['rgba(15, 118, 110, 0.85)', 'rgba(203, 213, 225, 0.3)'],
            borderWidth: 0,
            cutout: '75%'
        }]
    };

    const doughnutConfig = {
        type: 'doughnut',
        data: doughnutData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: { duration: 800, easing: 'easeOutCubic' },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            },
            cutout: '75%'
        }
    };

    // اجرای نمودارها
    document.addEventListener('DOMContentLoaded', () => {
        new Chart(document.getElementById('abilityChart'), barConfig);
        new Chart(document.getElementById('radarChart'), radarConfig);
        new Chart(document.getElementById('scatterChart'), scatterConfig);
        new Chart(document.getElementById('doughnutChart'), doughnutConfig);
new Chart(document.getElementById('bubbleChart'), bubbleConfig);
new Chart(document.getElementById('polarChart'), polarConfig);

        document.getElementById('doughnutCenterText').textContent = formattedPercentage + '%';
    });
</script>




</x-app-layout>
