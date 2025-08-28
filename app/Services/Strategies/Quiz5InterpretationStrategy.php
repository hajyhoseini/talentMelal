<?php
// app/Services/Strategies/DefaultInterpretationStrategy.php

namespace App\Services\Strategies;

use App\Models\TalentInsight;

class Quiz5InterpretationStrategy implements InterpretationStrategyInterface
{
    public function analyze(array $answers): array
    {
        $results = [];

        foreach ($answers as $answer) {
            $section = $answer->section;

            if (!isset($results[$section])) {
                $results[$section] = ['score' => 0];
            }

            $results[$section]['score'] += $answer->answer_value;
        }

        foreach ($results as $section => &$data) {
            $score = $data['score'];

            if ($score >= 35) {
                $level = 'high';
            } elseif ($score >= 20) {
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
