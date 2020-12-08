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

it('can determine sunrise, zenith and sunset for the current moment', function () {
    expect($this->sun->sunrise()->format('Y-m-d H:i:s'))->toEqual('2020-01-01 08:46:41');

    expect($this->sun->zenith()->format('Y-m-d H:i:s'))->toEqual('2020-01-01 12:45:42');

    expect($this->sun->sunset()->format('Y-m-d H:i:s'))->toEqual('2020-01-01 16:44:43');
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

it('can determine sunrise, zenith and sunset for a specified moment', function () {
    $now = Carbon::create(2020, 4, 23, 11, 20, 0, 'Europe/Brussels');

    expect($this->sun->sunrise($now)->format('Y-m-d H:i:s'))->toEqual('2020-04-23 06:29:07');

    expect($this->sun->zenith($now)->format('Y-m-d H:i:s'))->toEqual('2020-04-23 13:40:37');

    expect($this->sun->sunset($now)->format('Y-m-d H:i:s'))->toEqual('2020-04-23 20:52:07');
});
