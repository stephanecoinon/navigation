<?php

use Coinon\Navigation\NavigationItem;

class NavigationItemTest extends NavigationTestCase {

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    function it_requires_mandatory_attributes()
    {
        new NavigationItem([]);
    }

    /**
     * @test
     */
    function it_sets_default_attributes()
    {
        $item = new NavigationItem(['title' => 'About Us']);
        $this->assertEquals('about-us', $item->slug, 'Slug should be slugified title');
        $this->assertFalse($item->isActive());
    }

}
