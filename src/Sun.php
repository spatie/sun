<?php

namespace Spatie\Sun;

use Carbon\Carbon;

class Sun
{
    protected float $lat;

    protected float $lng;

    public function __construct(float $lat, float $lng)
    {
        $this->lat = $lat;

        $this->lng = $lng;
    }

    public function sunIsUp(Carbon $onDay = null): bool
    {
        $onDay = $onDay ?? Carbon::now();

        $sunrise = $this->sunrise($onDay);
        $sunset = $this->sunset($onDay);

        return $onDay->between($sunrise, $sunset);
    }

    public function sunrise(Carbon $onDay = null): Carbon
    {
        $onDay = $onDay ?? Carbon::now();

        $sunriseTimestamp = date_sunrise(
            (int)$onDay->timestamp,
            SUNFUNCS_RET_TIMESTAMP,
            $this->lat,
            $this->lng
        );

        return Carbon::createFromTimestamp($sunriseTimestamp);
    }

    public function zenith(Carbon $onDay = null): Carbon
    {
        $onDay = $onDay ?? Carbon::now();

        $sunTimestamp = date_sun_info(
            (int)$onDay->timestamp,
            $this->lat,
            $this->lng
        )['transit'];

        return Carbon::createFromTimestamp($sunTimestamp);
    }

    public function sunset(Carbon $onDay = null): Carbon
    {
        $onDay = $onDay ?? Carbon::now();

        $sunsetTimestamp = date_sunset(
            (int)$onDay->timestamp,
            SUNFUNCS_RET_TIMESTAMP,
            $this->lat,
            $this->lng
        );

        return Carbon::createFromTimestamp($sunsetTimestamp);
    }
}
