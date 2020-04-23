<?php

namespace Spatie\Sun\Tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Spatie\Sun\Sun;
use Spatie\TestTime\TestTime;

class SunTest extends TestCase
{
    private Sun $sun;

    public function setUp(): void
    {
        parent::setUp();

        date_default_timezone_set('Europe/Brussels');

        $now = Carbon::create(2020, 1, 1, 8, 0, 0, 'Europe/Brussels');

        TestTime::freeze($now);

        $coordinatesOfAntwerp = ['lat' => 51.260197, 'lng' => 4.402771];

        $this->sun = new Sun($coordinatesOfAntwerp['lat'], $coordinatesOfAntwerp['lng']);
    }

    /** @test */
    public function it_can_determine_sunrise_and_sunset_for_the_current_moment()
    {
        $this->assertEquals('2020-01-01 08:46:41', $this->sun->sunrise()->format('Y-m-d H:i:s'));

        $this->assertEquals('2020-01-01 16:44:43', $this->sun->sunset()->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_can_determine_if_the_sun_is_up_now()
    {
        TestTime::freeze($this->sun->sunrise());
        TestTime::subSecond();
        $this->assertFalse($this->sun->sunIsUp());

        TestTime::addSecond();
        $this->assertTrue($this->sun->sunIsUp());

        TestTime::freeze($this->sun->sunset());
        $this->assertTrue($this->sun->sunIsUp());

        TestTime::addSecond();
        $this->assertFalse($this->sun->sunIsUp());
    }

    /** @test */
    public function it_can_determine_sunrise_and_sunset_for_a_specified_moment()
    {
        $now = Carbon::create(2020, 4, 23, 11, 20, 0, 'Europe/Brussels');

        $this->assertEquals('2020-04-23 06:29:07', $this->sun->sunrise($now)->format('Y-m-d H:i:s'));

        $this->assertEquals('2020-04-23 20:52:07', $this->sun->sunset($now)->format('Y-m-d H:i:s'));
    }
}
