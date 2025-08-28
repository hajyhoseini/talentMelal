<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';

    protected $primaryKey = 'option_id'; // اضافه شده

    protected $fillable = [
        'label',
        'question_id',
        'value',
        'quiz_id',
        'weight',
        'trait',
    ];

    public $timestamps = true;

    public function question()
    {
        return $this->belongsTo(AllQuestion::class, 'question_id');
    }
}
