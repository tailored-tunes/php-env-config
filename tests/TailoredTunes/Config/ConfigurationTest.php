<?php

namespace TailoredTunes\Config;


class ConfigurationTest extends \PHPUnit_Framework_TestCase
{

    public function testDefaultValues()
    {
        $config = new Configuration([]);

        $name = uniqid('name');
        $default = uniqid('value');

        $actual = $config->get($name, $default);
        $expected = $default;

        $this->assertEquals($actual, $expected, 'Default value is not returned');
    }

    public function testNonDefaultValues()
    {
        $name = uniqid('name');
        $realValue = uniqid('realValue');
        $default = uniqid('value');

        $config = new Configuration([$name => $realValue]);

        $actual = $config->get($name, $default);
        $expected = $realValue;

        $this->assertEquals($actual, $expected, 'The real value is not returned');
    }

    public function testDefaultValuesDefine()
    {
        $name = uniqid('name');
        $default = uniqid('value');

        $config = new Configuration([]);

        $config->define($name, $default);
        $expected = $default;

        $this->assertEquals(
            constant($name),
            $expected,
            'The parameter is not defined properly with real value'
        );
    }

    public function testNonDefaultValuesDefine()
    {
        $name = uniqid('name');
        $realValue = uniqid('realValue');
        $default = uniqid('value');

        $config = new Configuration([$name => $realValue]);

        $config->define($name, $default);
        $expected = $realValue;

        $this->assertEquals(
            constant($name),
            $expected,
            'The parameter is not defined properly with real value'
        );
    }
}
