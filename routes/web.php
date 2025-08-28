<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizBuilderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MbtiQuizController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminResultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// آزمون‌ها
Route::middleware(['auth'])->group(function () {
    Route::get('/exams/{id}', [ExamController::class, 'show'])->name('exams.show');
    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/start/{id}', [ExamController::class, 'start'])->name('exams.start');
    Route::get('/completed-tests', [ExamController::class, 'completedExams'])->name('exams.completed');

    // پروفایل
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// کوییزها (همه مسیرها با auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/quiz/{quizId}', [QuizController::class, 'showQuiz'])->name('quiz.show');
    Route::post('/quiz/{quizId}', [QuizController::class, 'submitAnswers'])->name('quiz.submit');
    Route::get('/quiz/results/{userId}/{quizId}', [QuizController::class, 'showResults'])->name('quiz.results');
    Route::get('/user/results/{userId}/{quizId}', [QuizController::class, 'showResults2'])->name('user.results');
});

// آزمون MBTI
Route::get('/mbti-quiz', [MbtiQuizController::class, 'show'])->name('mbti.quiz');
Route::get('/mbti-quiz/start', [MbtiQuizController::class, 'start'])->name('quiz.start');
Route::get('/mbti-quiz/questions', [MbtiQuizController::class, 'showQuestions'])->name('mbti.questions');
Route::post('/mbti-quiz/submit', [MbtiQuizController::class, 'storeAnswers'])->name('mbti.submit');
Route::post('/mbti-quiz/answers', [MbtiQuizController::class, 'storeAnswers'])->name('mbti.storeAnswers');
Route::get('/mbti-quiz/results', [MbtiQuizController::class, 'showResults'])->name('mbti.results');

// فرم ساخت آزمون مرحله‌ای
Route::get('/quiz-builder', function () {
    return view('quiz-builder');
})->name('quiz.builder');

// تست‌ها
Route::get('/test', [MbtiQuizController::class, 'test'])->name('test');
Route::get('/test2', [MbtiQuizController::class, 'test2'])->name('test2');

// تفسیر آزمون
Route::get('/exams/{id}/interpretation', [ExamController::class, 'interpretation'])->name('exams.interpretation');

// نتایج ادمین
Route::get('/admin/results', [AdminResultController::class, 'index'])->name('admin.results.index');
Route::get('/admin/results/{userId}/{quizId}', [AdminResultController::class, 'show'])->name('admin.results.show');

// مسیر لاگین (احراز هویت + ریدایرکت به quiz در صورت وجود)
Route::get('/login', [RegisteredUserController::class, 'create'])->name('login');
Route::post('/login', [RegisteredUserController::class, 'store']);
