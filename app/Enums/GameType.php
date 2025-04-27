<?php

namespace App\Enums;

enum GameType: string
{
    case ROULETTE = 'roulette';

    public function getOptions() {}
}
