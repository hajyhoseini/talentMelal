<!-- هدر -->

<!-- سایدبار -->
<div class="deznav rounded-md z-10" style="background: white; box-shadow: 3px 0 3px  rgba(0, 0, 0, 0.3);">
  <div class="deznav-scroll" style="background: white; box-shadow: 3px 0 3px  rgba(0, 0, 0, 0.3);">
    <div class="dropdown header-profile">
      <div class="nav-link flex items-center p-3 bg-[#4cccc]" style="color: #333;">
        <img src="/images/avatar/1.png" width="28" class="rounded-full" alt="">
        <div class="header-info ms-3 flex flex-col items-center justify-center text-center">
          @auth
            <span class="font-w600" style="color: #333;">{{ Auth::user()->name }} <b>{{ Auth::user()->last_name }}</b></span>
            <small class="font-w400 block" style="color: #777;">{{ Auth::user()->email }}</small>
          @else
            <div class="mt-2 flex flex-col items-center gap-2">
              <button type="button" class="login-btn bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition-all duration-300 text-sm ">
                 ورود 
              </button>
            </div>
          @endauth
        </div>
      </div>

      <div class="dropdown-menu dropdown-menu-end">
        @auth
          <a href="./app-profile.html" class="dropdown-item ai-icon" style="color: #333;">
            <span class="ms-2">ویرایش اطلاعات</span>
          </a>
          <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" class="dropdown-item ai-icon" style="color: #333;">
            <span class="ms-2">خروج</span>
          </a>
        @else
          <a href="javascript:void(0);" class="dropdown-item ai-icon login-btn" style="color: #333;">
            <span class="ms-2">ورود</span>
          </a>
        @endauth
      </div>
    </div>

    <!-- منوی اصلی -->
    <ul class="metismenu hidden" id="menu">
      <li>
        <a class="has-arrow ai-icon" href="javascript:void(0)" style="color: #333;">
          <i class="flaticon-025-dashboard"></i>
          <span class="nav-text">داشبورد</span>
        </a>
        <ul>
  @auth
    <li>
      <a href="{{ route('profile.edit') }}" style="color: #777;">ویرایش اطلاعات</a>
    </li>
    <li>
      <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" style="color: #777;">خروج</a>
      <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
      </form>
    </li>
  @else
    <li>
      <a href="javascript:void(0);" class="login-btn" style="color: #777;">ورود</a>
    </li>
  @endauth
</ul>

      </li>

      <li>
        <a class="has-arrow ai-icon" href="javascript:void(0)" style="color: #333;">
          <i class="flaticon-050-info"></i>
          <span class="nav-text">آزمون‌ها</span>
        </a>
        <ul>
<li>
<li>
  <a href="{{ route('exams.completed') }}" style="color: #777;"> آزمون های انجام شده</a>
</li>

          <li><a href="{{ route('exams.index') }}" style="color: #777;">همه آزمون‌ها</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>

<!-- مدال لاگین -->
<div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg max-w-lg w-full mx-4 text-right">
    <div class="flex justify-between items-center">
      <h2 class="text-lg font-bold">ورود به حساب</h2>
      <button id="close-modal-btn" class="text-gray-500 hover:text-gray-700">&times;</button>
    </div>

    <!-- انیمیشن لوتی بالای ایمیل -->
    <div id="lottie-container" class="text-center mt-4 mb-2" style="max-width: 100px; margin: 0 auto; display: none;">
      <div id="lottie-animation" style="width: 100%; height: 100px;"></div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6 mt-2">
      @csrf
      <div>
        <x-label for="email" :value="__('ایمیل')" class="text-gray-700 font-medium block text-left" />
        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus
          class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 text-left" />
      </div>

      <div class="mt-4">
        <x-label for="password" :value="__('رمز عبور')" class="text-gray-700 font-medium block text-left" />
        <x-input id="password" type="password" name="password" required
          class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 text-left" />
      </div>

      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mt-4 gap-4 sm:gap-0">
        <div class="flex items-center">
          <x-checkbox id="remember_me" name="remember" class="text-indigo-600" />
          <x-label for="remember_me" :value="__('مرا به خاطر بسپار')" class="mr-2 text-gray-700" />
        </div>

        <div>
          <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-800">رمز عبور را فراموش کرده‌اید؟</a>
        </div>
      </div>

      <div class="flex flex-col items-center justify-center mt-6 gap-4">
        <x-button class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 px-6 py-3 rounded-md text-lg transition-all duration-300">
          {{ __('ورود') }}
        </x-button>
      </div>
    </form>
  </div>
</div>

<!-- کتابخانه لوتی -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>

<!-- استایل‌ها -->
<style>
  #login-modal {
    display: none;
  }

  #login-modal.show {
    display: flex;
  }

  #close-modal-btn {
    font-size: 24px;
    cursor: pointer;
  }

  #lottie-container {
    display: none;
  }
  #lottie-container {
    display: none;
    max-width: 100px;
    height: 100px;
  }

  #lottie-animation {
    width: 100%;
    height: 100%;
  }
.deznav .header-profile img {
  width: 70px;
  height: 70px;
  object-fit: cover;
  aspect-ratio: 1 / 1;
  border-radius: 50%;
}

</style>

<!-- اسکریپت مربوط به مدال و لوتی -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const loginButtons = document.querySelectorAll(".login-btn");
    const loginModal = document.getElementById("login-modal");
    const closeModalBtn = document.getElementById("close-modal-btn");
    const lottieContainer = document.getElementById('lottie-container');
    const lottieAnimationContainer = document.getElementById('lottie-animation');
    let typingTimer;
    let animation;

    loginButtons.forEach(btn => {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        loginModal.classList.add("show");

        if (!animation) {
          animation = lottie.loadAnimation({
            container: lottieAnimationContainer,
            renderer: 'svg',
            loop: true,
            autoplay: false,
            path: '/animations/login-loader.json'
          });
        }
      });
    });

    closeModalBtn.addEventListener("click", function () {
      loginModal.classList.remove("show");
      hideLottie();
    });

    window.addEventListener("click", function (event) {
      if (event.target === loginModal) {
        loginModal.classList.remove("show");
        hideLottie();
      }
    });

    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    [emailInput, passwordInput].forEach(input => {
      input.addEventListener('input', function () {
        showLottie();

        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
          hideLottie();
        }, 1500); // توقف 0.4 ثانیه‌ای بعد از تایپ
      });
    });

    function showLottie() {
      lottieContainer.style.display = 'block';
      if (animation && !animation.isPlaying) {
        animation.play();
      }
    }

    function hideLottie() {
      if (animation) animation.stop();
      lottieContainer.style.display = 'none';
    }
  });
</script>

