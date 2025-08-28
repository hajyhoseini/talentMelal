<?php
namespace App\Services\Strategies;

use App\Models\TalentInsight;

class Quiz3InterpretationStrategy implements InterpretationStrategyInterface
{
    public function analyze(array $answers): array
    {
        $results = [];

        // جمع امتیازها به تفکیک بخش
        foreach ($answers as $answer) {
            $section = $answer->section;

            if (!isset($results[$section])) {
                $results[$section] = ['score' => 0, 'count' => 0];
            }

            $results[$section]['score'] += $answer->answer_value;
            $results[$section]['count']++;

        }

        // تعیین سطح بندی 4 مرحله‌ای و گرفتن تفسیر و پیشنهاد از DB
        foreach ($results as $section => &$data) {

            $avgScore = $data['score'] / $data['count'];

           
            if ($avgScore >= 2.7) {
                $level = 'high';
            } elseif ($avgScore >= 1.3) {
                $level = 'medium';
            } else {
                $level = 'low';
            }


            $insight = TalentInsight::where('section', $section)
                ->where('level', $level)
                ->first();

            $data['level'] = $level;
            $data['interpretation'] = $insight ? $insight->interpretation : 'تفسیر یافت نشد.';
            $data['suggestions'] = $insight && $insight->suggestions
                ? array_filter(preg_split('/\r\n|\r|\n/', trim($insight->suggestions)))
                : [];
        }

        return $results;
    }
}
