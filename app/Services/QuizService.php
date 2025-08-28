<?php
namespace App\Services;

use App\Models\AllAnswer;
use App\Models\AllQuestion;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;
use App\Services\Strategies\InterpretationStrategyFactory;
use App\Models\QuizColumn;
use Illuminate\Support\Facades\Log;
use App\Models\Option; 
class QuizService
{
    /**
     * دریافت سوالات کوییز مشخص به همراه گزینه‌ها و گروه‌بندی بر اساس بخش (section)
     *
     * @param int|null $quizId
     * @return \Illuminate\Support\Collection
     */
    public function getGroupedQuestions($quizId)
    {
        $questions = AllQuestion::with('options')
            ->where('quiz_id', $quizId)
            ->orderBy('section')
            ->orderBy('id')
            ->get();

        return $questions->groupBy('section');
    }

    /**
     * گرفتن جدیدترین کوییز
     *
     * @return Quiz|null
     */
    public function getLatestQuiz()
    {
        return Quiz::latest()->first();
    }
public function getMaxScoresBySection(int $quizId): array
{
    return QuizColumn::where('quiz_id', $quizId)
                     ->pluck('max_score', 'column_name')
                     ->toArray();
}
    /**
     * ذخیره پاسخ‌ها برای یک کوییز توسط کاربر
     *
     * @param array $answers  // [question_id => answer_value, ...]
     * @param int $quizId
     * @param int $userId
     *
     * @throws \Exception
     */

public function saveAnswers(array $answers, int $quizId, int $userId)
{
    Log::info('شروع ذخیره پاسخ‌ها', compact('userId', 'quizId', 'answers'));

    AllAnswer::where('user_id', $userId)
             ->where('quiz_id', $quizId)
             ->delete();

    foreach ($answers as $questionId => $answerData) {
        $question = AllQuestion::find($questionId);

        if (!$question) {
            Log::error("سوال با ID $questionId یافت نشد!");
            throw new \Exception("سوال با ID $questionId یافت نشد!");
        }

        AllAnswer::create([
            'user_id' => $userId,
            'section' => $question->section,
            'question_id' => $questionId,
            'answer_value' => $answerData['answer_value'] ?? null,
            'trait' => $answerData['trait'] ?? null,
            'quiz_id' => $quizId,
        ]);
    }

    Log::info('ذخیره پاسخ‌ها با موفقیت انجام شد');
}




    /**
     * دریافت کوییزهای گرفته شده توسط کاربر به ترتیب جدیدترین
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public function getUserQuizzes(int $userId)
    {
        return DB::table('all_answers')
            ->where('user_id', $userId)
            ->select('quiz_id', DB::raw('MAX(created_at) as taken_at'))
            ->groupBy('quiz_id')
            ->orderByDesc('taken_at')
            ->get();
    }
public function getQuizById($quizId)
{
    return Quiz::find($quizId);
}

    /**
     * گرفتن نتایج کوییز برای یک کاربر شامل نمره، سطح و تفسیر
     *
     * @param int $userId
     * @param int $quizId
     * @return array
     */
    public function getQuizResults(int $userId, int $quizId): array
    {
        $answers = AllAnswer::where('user_id', $userId)
                            ->where('quiz_id', $quizId)
                            ->get()
                            ->all();
        // انتخاب استراتژی با استفاده از Factory
        $strategy = InterpretationStrategyFactory::make($quizId);

        return $strategy->analyze($answers);
    }
}
