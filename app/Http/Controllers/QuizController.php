<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\QuizService;

class QuizController extends Controller
{
    protected QuizService $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * نمایش صفحه کوییز به همراه سوالات و گزینه‌ها
     */
public function showQuiz($quizId)
{
    // گرفتن کوییز بر اساس quizId
    $quiz = $this->quizService->getQuizById($quizId);

    if (!$quiz) {
        return abort(404, 'کوییز پیدا نشد.');
    }

    // گرفتن سوالات گروه‌بندی شده بر اساس همون quizId
    $questions = $this->quizService->getGroupedQuestions($quiz->id);

    return view('quiz.show', compact('quiz', 'questions'));
}

    /**
     * ثبت پاسخ‌ها
     */
public function submitAnswers(Request $request)
{
    $data = $request->all();

    $quizId = $data['quiz_id'];
    $userId = auth()->id();

    $answers = [];

    foreach ($data as $key => $value) {
        if (str_starts_with($key, 'question_')) {
            $questionId = intval(str_replace('question_', '', $key));
            
            // اگر $value آرایه است، answer_value و trait رو جدا می‌کنیم
            if (is_array($value)) {
                $answerValue = $value['answer_value'] ?? null;
                $trait = $value['trait'] ?? null;
            } else {
                $answerValue = $value;
                $trait = null;
            }

            $answers[$questionId] = [
                'answer_value' => $answerValue,
                'trait' => $trait,
            ];
        }
    }

    app(\App\Services\QuizService::class)->saveAnswers($answers, $quizId, $userId);

    return redirect()->route('quiz.results', ['userId' => $userId, 'quizId' => $quizId])
                     ->with('success', 'پاسخ‌ها ثبت شدند');
}





    /**
     * نمایش کوییزهای گرفته شده توسط کاربر
     */
    public function showUserQuizzes()
    {
        $userId = Auth::id();
        $quizzes = $this->quizService->getUserQuizzes($userId);

        return view('user.quizzes', compact('quizzes'));
    }

    /**
     * نمایش نتایج کوییز اخیر کاربر
     */public function showResults(Request $request, $userId, $quizId)
{
    $user = \App\Models\User::findOrFail($userId);

    $results = $this->quizService->getQuizResults($userId, $quizId);
    $maxScores = $this->quizService->getMaxScoresBySection($quizId);

    $quiz = \App\Models\Quiz::find($quizId);
    $desResults = $quiz ? $quiz->des_results : null;

    $columns = \App\Models\QuizColumn::where('quiz_id', $quizId)->get()->keyBy('column_name');

    foreach ($results as $section => &$data) {
        $data['description'] = $columns[$section]->talent_description ?? null;
    }
    unset($data);

    $resultLevels = \App\Models\QuizResultLevel::where('quiz_id', $quizId)
                        ->orderBy('min_score', 'desc')
                        ->get();

    $featuredPeople = \App\Models\FeaturedPerson::where('quiz_id', $quizId)->get();

    $featuredBooks = \App\Models\FeaturedBook::where('quiz_id', $quizId)->get();

    if ($request->has('suggestions')) {
        $suggestions = $request->input('suggestions');

        foreach ($suggestions as $section => $suggestionText) {
            \App\Models\TalentInsight::updateOrCreate(
                [
                    'quiz_id' => $quizId,
                    'section' => $section,
                ],
                [
                    'suggestions' => $suggestionText,
                ]
            );
        }
    }

    // واکشی suggestions از دیتابیس برای ارسال به ویو
    $suggestionsFromDb = \App\Models\TalentInsight::where('quiz_id', $quizId)
                        ->pluck('suggestions', 'section')
                        ->toArray();
$interpretationsFromDb = \App\Models\TalentInsight::where('quiz_id', $quizId)
                    ->pluck('interpretation', 'section')
                    ->toArray();
                    \Log::info('Results from QuizService:', $results);

    return view('quiz.results', [
        'user' => $user,
        'results' => $results,
        'desResults' => $desResults,
        'maxScores' => $maxScores,
        'userId' => $userId,
        'quizId' => $quizId,
        'resultLevels' => $resultLevels,
        'columns' => $columns,
        'featuredPeople' => $featuredPeople,
        'featuredBooks' => $featuredBooks,
        'suggestions' => $suggestionsFromDb, // اضافه شد
        'interpretations' => $interpretationsFromDb,
    ]);
}







    /**
     * نمایش نتایج کوییز (نمایش متفاوت)
     */
public function showResults2($userId, $quizId) 
{
    $results = $this->quizService->getQuizResults((int)$userId, (int)$quizId);
    $maxScores = $this->quizService->getMaxScoresBySection((int)$quizId);
    $quiz = \App\Models\Quiz::findOrFail($quizId);
    $reportDescription = $quiz->report_description;

    $columns = \App\Models\QuizColumn::where('quiz_id', $quizId)->get()->keyBy('column_name');

    foreach ($results as $section => &$data) {
        $max = $maxScores[$section] ?? null;
        if ($max && $max > 0) {
            $data['percentage'] = round(($data['score'] / $max) * 100, 1);
        } else {
            $data['percentage'] = null;
        }
        $data['description'] = $columns[$section]->talent_description ?? null;
    }
    unset($data);

    $featuredPeople = \App\Models\FeaturedPerson::where('quiz_id', $quizId)->get();
    $peopleGrouped = $featuredPeople->groupBy('related_talent');

    $featuredBooks = \App\Models\FeaturedBook::where('quiz_id', $quizId)->get();
    $booksGrouped = $featuredBooks->groupBy('general_talent');

    $suggestedCareers = \App\Models\SuggestedCareer::where('quiz_id', $quizId)->get();
    $careersGrouped = $suggestedCareers->groupBy('talent_name');

    $featuredBySectionPeople = [];
    $featuredBySectionBooks = [];
    $featuredBySectionCareers = [];

    foreach ($results as $section => $data) {
        $people = $peopleGrouped->get($section, collect());
        $featuredBySectionPeople[$section] = $people->chunk(4);

        $books = $booksGrouped->get($section, collect());
        $featuredBySectionBooks[$section] = $books->chunk(2);

        $careers = $careersGrouped->get($section, collect());
        $featuredBySectionCareers[$section] = $careers->chunk(6);
    }

    $talentCharts = \App\Models\TalentChart::where('quiz_id', $quizId)->get();

    // اضافه کردن دریافت رنگ‌ها از جدول project_colors
    $projectColors = \App\Models\ProjectColor::all();

    return view('user.results', [
        'results' => $results,
        'featuredPeople' => $featuredBySectionPeople,
        'featuredBooks' => $featuredBySectionBooks,
        'featuredCareers' => $featuredBySectionCareers,
        'talentCharts' => $talentCharts,
        'reportDescription' => $reportDescription ?? '',
        'projectColors' => $projectColors,  // ارسال رنگ‌ها به ویو
    ]);
}








}
