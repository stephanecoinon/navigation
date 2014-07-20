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

    /**
     * @test
     */
    public function it_uses_the_slug_as_the_default_url()
    {
        $item = new NavigationItem(['title' => 'About Us']);
        $this->assertEquals('about-us', $item->url);
    }

    /**
     * @test
     */
    public function it_can_handle_absolute_urls()
    {
        $itemArray = [
            'title' => 'twitter',
            'url'   => 'https://twitter.com/username',
        ];
        $item = new NavigationItem($itemArray);

        $this->assertEquals($itemArray['url'], $item->url);
    }

}
