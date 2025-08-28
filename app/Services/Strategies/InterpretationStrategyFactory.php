<?php
namespace App\Services\Strategies;

class InterpretationStrategyFactory
{
    public static function make(int $quizId): InterpretationStrategyInterface
    {
        $map = [
            1 => DefaultInterpretationStrategy::class,
            2 => Quiz2InterpretationStrategy ::class,
            3 => Quiz3InterpretationStrategy ::class,
            // 4 => DefaultInterpretationStrategy::class,
            5 => Quiz5InterpretationStrategy ::class,

        ];

        if (!isset($map[$quizId])) {
            return new DefaultInterpretationStrategy(); // استراتژی پیش‌فرض
        }

        $strategyClass = $map[$quizId];
        return new $strategyClass();
    }
}
