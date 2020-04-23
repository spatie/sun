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

it('can determine sunrise and sunset for the current moment', function () {
    assertEquals('2020-01-01 08:46:41', $this->sun->sunrise()->format('Y-m-d H:i:s'));

    assertEquals('2020-01-01 16:44:43', $this->sun->sunset()->format('Y-m-d H:i:s'));
});

it('can determine if the sun is up now', function () {
    TestTime::freeze($this->sun->sunrise());
    TestTime::subSecond();
    assertFalse($this->sun->sunIsUp());

    TestTime::addSecond();
    assertTrue($this->sun->sunIsUp());

    TestTime::freeze($this->sun->sunset());
    assertTrue($this->sun->sunIsUp());

    TestTime::addSecond();
    assertFalse($this->sun->sunIsUp());
});

it('can determine sunrise and sunset for a specified moment', function () {
    $now = Carbon::create(2020, 4, 23, 11, 20, 0, 'Europe/Brussels');

    assertEquals('2020-04-23 06:29:07', $this->sun->sunrise($now)->format('Y-m-d H:i:s'));

    assertEquals('2020-04-23 20:52:07', $this->sun->sunset($now)->format('Y-m-d H:i:s'));
});
