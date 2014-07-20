<?php

use Coinon\Navigation\Navigation;
use Coinon\Navigation\NavigationItem;

class NavigationTest extends NavigationTestCase {

    /** @var  NavigationItem */
    protected $item;

    /** @var  Navigation */
    protected $navigation;

    function setUp()
    {
        $itemArray = ['title' => 'Contact us', 'slug' => 'contact'];
        $navigationArray = [
            ['title' => 'Welcome to our website'],
            ['title' => 'About us'],
            $itemArray,
        ];
        $this->navigation = new Navigation($navigationArray);
        $this->item = new NavigationItem($itemArray);
    }

    /**
     * @test
     */
    public function it_can_load_a_config()
	{
        $this->assertEquals($this->item, $this->navigation->findItemBySlug('contact'));
        $this->assertCount(3, $this->navigation);
	}

    /**
     * @test
     */
    public function it_can_activate_an_item()
    {
        $this->navigation->activateItem('contact');
        $this->assertTrue($this->navigation->isActive('contact'));
        $this->assertTrue($this->navigation->findItemBySlug('contact')->isActive(), 'Ensure active item state is active');

        $this->navigation->activateItem('about-us');
        $this->assertFalse($this->navigation->isActive('contact'), 'Ensure previous active item is now inactive');
        $this->assertFalse($this->navigation->findItemBySlug('contact')->isActive(), 'Ensure previous active item state is now inactive');
        $this->assertTrue($this->navigation->isActive('about-us'), 'Ensure new item is active');
    }

}
