<?php
namespace App\Services\Strategies;

use App\Models\TalentInsight;

class Quiz2InterpretationStrategy implements InterpretationStrategyInterface
{
    public function analyze(array $answers): array
    {
        $results = [];

        foreach ($answers as $answer) {
            error_log("Answer section: " . $answer->section . ", value: " . $answer->answer_value);
            
            $section = $answer->section;

            if (!isset($results[$section])) {
                $results[$section] = ['score' => 0, 'count' => 0];
            }

            $results[$section]['score'] += $answer->answer_value;
            $results[$section]['count']++;
        }

        foreach ($results as $section => &$data) {
            $totalScore = $data['score'];
            $count = $data['count'];
            $maxScore = $count * 5; // فرض بیشترین نمره ۵

            error_log("Section: {$section} | Total Score: {$totalScore} | Count: {$count} | Max Score: {$maxScore}");

            $percentage = ($totalScore / $maxScore) * 100;

            if ($percentage >= 80) {
                $level = 'very_high';
            } elseif ($percentage >= 60) {
                $level = 'high';
            } elseif ($percentage >= 40) {
                $level = 'medium';
            } else {
                $level = 'low';
            }

            error_log("Determined Level: {$level} (Percentage: {$percentage}%)");

            $insight = TalentInsight::where('section', $section)
                ->where('level', $level)
                ->first();

            if (!$insight) {
                error_log("No insight found for section: {$section}, level: {$level}");
            } else {
                error_log("Insight found for section: {$section}, level: {$level}");
            }

            $data['level'] = $level;
            $data['interpretation'] = $insight ? $insight->interpretation : 'تفسیر یافت نشد.';
            $data['suggestions'] = $insight && $insight->suggestions
                ? array_filter(preg_split('/\r\n|\r|\n/', trim($insight->suggestions)))
                : [];
        }

        return $results;
    }
}
