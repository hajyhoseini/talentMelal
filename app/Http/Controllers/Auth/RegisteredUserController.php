<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * نمایش فرم ثبت‌نام
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * ذخیره یا ورود کاربر فقط با نام و کد ملی
     */
    public function store(Request $request)
    {
        // اعتبارسنجی فقط نام و کد ملی
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'national_code' => ['required', 'digits:10'],
        ]);

        // جستجوی کاربر با کد ملی
        $user = User::where('national_code', $request->national_code)->first();

        // اگر نبود، ثبت‌نام
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'national_code' => $request->national_code,
                'password' => Hash::make($request->national_code), // رمز پیش‌فرض
            ]);

            event(new Registered($user));
        }

        // ورود
        Auth::login($user);

        // گرفتن quiz_id از request یا استفاده از پیش‌فرض
        $quizId = $request->input('quiz_id', 1);

        // ریدایرکت به صفحه آزمون
return redirect()->route('quiz.show', ['quizId' => $quizId])
    ->with('success', 'خوش آمدید!');

    }
}
