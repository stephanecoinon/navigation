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
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('http://localhost'),          'http:// should be absolute');
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('https://localhost'),         'https:// should be absolute');
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('ftp://localhost'),           'ftp:// should be absolute');
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('//localhost'),               '// should be absolute');
        $this->assertTrue(NavigationHelper::isAbsoluteUrl('javascript:alert("hello")'), 'javascript: should be absolute');
        $this->assertFalse(NavigationHelper::isAbsoluteUrl('products/1'),               'products/1 should be relative');
        $this->assertFalse(NavigationHelper::isAbsoluteUrl('/'),                        '/ should be relative');
        $this->assertFalse(NavigationHelper::isAbsoluteUrl(''),                         'empty url should be relative');
    }

}
