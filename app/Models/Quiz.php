<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'title',
        'description',
        'description_min',
        'slug',
        'image',
        'image_main',
        'des_results',
        'report_description'
    ];

    // 👇 روابط زیر رو اضافه کردیم برای Eager Loading

    // رابطه با ستون‌های آزمون (Quiz Columns)
    public function columns()
    {
        return $this->hasMany(QuizColumn::class, 'quiz_id');
    }

    // رابطه با سطوح نتایج (Result Levels)
    public function resultLevels()
    {
        return $this->hasMany(QuizResultLevel::class, 'quiz_id');
    }

    // رابطه با افراد برجسته (Featured People)
    public function featuredPeople()
    {
        return $this->hasMany(FeaturedPerson::class, 'quiz_id');
    }

    // رابطه با کتاب‌های برجسته (Featured Books)
    public function featuredBooks()
    {
        return $this->hasMany(FeaturedBook::class, 'quiz_id');
    }

    // رابطه با توصیه‌ها و تفسیرهای مربوط به هوش‌ها (Talent Insights)
    public function talentInsights()
    {
        return $this->hasMany(TalentInsight::class, 'quiz_id');
    }
}
