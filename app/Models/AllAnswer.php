<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllAnswer extends Model
{
    use HasFactory;

    protected $table = 'all_answers';

    protected $fillable = [
        'user_id',
        'quiz_id',
        'section',
        'question_id',
        'answer_value',
        'trait',   // اضافه شده، نال ایبل است
    ];

    public $timestamps = true;

    /**
     * پاسخ جدید ایجاد می‌کند یا اگر از قبل وجود داشت، آن را بروزرسانی می‌کند.
     */
    public static function updateOrCreateAnswer($userId, $quizId, $questionId, $section, $answerValue, $trait = null)
    {
        return self::updateOrCreate(
            [
                'user_id'     => $userId,
                'quiz_id'     => $quizId,
                'question_id' => $questionId,
            ],
            [
                'section'      => $section,
                'answer_value' => $answerValue,
                'trait'        => $trait,  // اضافه شده به بروزرسانی
            ]
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(AllQuestion::class, 'question_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
