<?php

namespace App\Enums;

enum JobTypeEnum: int
{
    case FULL_TIME = 0;
    case PART_TIME = 1;
    case CONTRACT = 2;
    case FREELANCE = 3;

    public function label(): string
    {
        return match($this) {
            self::FULL_TIME => 'full-time',
            self::PART_TIME => 'part-time',
            self::CONTRACT => 'contract',
            self::FREELANCE => 'freelance',
        };
    }
}
