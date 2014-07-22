<?php

use Coinon\Navigation\NavigationHelper;

class NavigationHelperTest extends NavigationTestCase {

    public function testConcatPath()
    {
        $this->assertEquals('a/b', NavigationHelper::concatPath(['a', 'b']));
        $this->assertEquals('a/b', NavigationHelper::concatPath(['a/', 'b']));
        $this->assertEquals('a/b', NavigationHelper::concatPath(['a', '/b']));
        $this->assertEquals('a/b', NavigationHelper::concatPath(['a/', '/b']));

        $this->assertEquals('a/b/c/', NavigationHelper::concatPath(['a/', 'b', 'c/']));
        $this->assertEquals('a', NavigationHelper::concatPath(['a']));
    }

    public function testIsAbsoluteUrl()
    {
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('http://localhost'));
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('https://localhost'));
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('ftp://localhost'));
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('//localhost'));
        $this->assertFalse(NavigationHelper::isAbsoluteUrl('products/1'));
        $this->assertFalse(NavigationHelper::isAbsoluteUrl('/'));
        $this->assertFalse(NavigationHelper::isAbsoluteUrl(''));
    }

}
