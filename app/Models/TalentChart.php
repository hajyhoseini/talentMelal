<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentChart extends Model
{
    use HasFactory;

    // نام جدول (اگر اسم جدول با مدل فرق داشته باشه، اینو تعریف می‌کنیم)
    protected $table = 'talent_charts';

    // فیلدهای قابل پر شدن
    protected $fillable = [
        'chart_type',
        'description',
        'quiz_id',
    ];

    // اگر می‌خوای کوییز رو به صورت رابطه مدل داشته باشی (فرض جدول quizzes هست)
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
