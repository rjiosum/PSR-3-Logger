<?php declare(strict_types=1);

namespace Tests\Unit\Utility;

use App\Utility\Config;
use Exception;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    /** @test */
    public function can_parse_config_file_and_get_value_of_corresponding_key()
    {
        $expected = 'Logger';
        $actual = Config::get('app.name');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function will_throw_exception_if_file_is_not_found()
    {
        $this->expectException(Exception::class);
        Config::get('wrong');
    }

    /** @test */
    public function will_throw_exception_if_specified_key_is_not_found()
    {
        $this->expectException(Exception::class);
        Config::get('app.invalid');
    }

}