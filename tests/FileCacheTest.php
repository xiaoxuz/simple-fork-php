<?php

/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/6/22
 * Time: 16:22
 */
class FileCacheTest extends PHPUnit_Framework_TestCase
{

    public function additionProvider()
    {
        return [
            ["/tmp/cache1", "key1", "value1"],
            ["/tmp/cache2", "key2", "value2"],
            ["/tmp/cache3", "key3", "value3"],
            ["/tmp/cache4", "key4", "value4"]
        ];
    }

    public function testCache($path, $key, $value) {
        $cache = new \Jenner\SimpleFork\Cache\FileCache($path);
        $this->assertTrue(file_exists($path));
        $this->assertTrue($cache->set($key, $value, 10));
        $this->assertEquals($cache->get($key), $value);
        sleep(11);
        $this->assertNull($cache->get($key));
        $this->assertTrue($cache->set($key, $value));
        $this->assertTrue($cache->delete($key));
        $this->assertNull($cache->get($key));
        $this->assertTrue($cache->flush());
        $this->assertFalse(file_exists($path));
    }
}