<?php

use Coinon\Navigation\Navigation;

/**
 * Base test case class to test this package
 */
abstract class NavigationTestCase extends PHPUnit_Framework_TestCase {

    /**
     * Assert that the items in the navigation object have the same titles as in the expected array
     *
     * @param  array      $expected
     * @param  Navigation $actual
     */
    protected function assertItemsHaveSameTitle(array $expected, Navigation $actual)
    {
        foreach ($expected as $navItemArray)
        {
            $this->assertNotNull($actual->findItemByAttribute('title', $navItemArray['title']));
        }
    }

}
