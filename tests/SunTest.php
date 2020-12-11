<?php

use Carbon\Carbon;
use Spatie\Sun\Sun;
use Spatie\TestTime\TestTime;

beforeEach(function () {
    date_default_timezone_set('Europe/Brussels');

    $now = Carbon::create(2020, 1, 1, 8, 0, 0, 'Europe/Brussels');

    TestTime::freeze($now);

    $coordinatesOfAntwerp = ['lat' => 51.260197, 'lng' => 4.402771];

    $this->sun = new Sun($coordinatesOfAntwerp['lat'], $coordinatesOfAntwerp['lng']);
});


it('can determine if the sun is up now', function () {
    TestTime::freeze($this->sun->sunrise());
    TestTime::subSecond();
    expect($this->sun->sunIsUp())->toBeFalse();

    TestTime::addSecond();
    expect($this->sun->sunIsUp())->toBeTrue();

    TestTime::freeze($this->sun->sunset());
    expect($this->sun->sunIsUp())->toBeTrue();

    TestTime::addSecond();
    expect($this->sun->sunIsUp())->toBeFalse();
});
