<?php

namespace App\Service;

class Statistics
{
    const MARATHON_DISTANCE = 42.195;

    public function marathonTime(int $meters, int $seconds)
    {
        $secondsPerMeter = $meters / $seconds;

        return $secondsPerMeter * (self::MARATHON_DISTANCE * 1000);
    }

    public function mph(int $meters, int $seconds)
    {
        $metersPerSecond = $meters / $seconds;

        return $metersPerSecond * 3600;
    }
}
