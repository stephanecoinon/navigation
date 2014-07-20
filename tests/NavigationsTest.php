<?php

use Coinon\Navigation\Navigations;

class NavigationsTest extends NavigationTestCase {

    /** @var array */
    protected $navigationsArray;

    /** @var Navigations */
    protected $navigations;


    public function setUp()
    {
        $this->navigationsArray = [

            'main' => [
                ['title' => 'Home'],
                ['title' => 'About us'],
                ['title' => 'Contact us'],
            ],

            'footer' => [
                ['title' => 'Contact us'],
                ['title' => 'Twitter'],
                ['title' => 'Facebook'],
            ],

        ];
        $this->navigations = new Navigations($this->navigationsArray);
    }

    /**
     * @test
     */
    public function it_can_fetch_a_navigation()
    {
        $this->assertItemsHaveSameTitle(
            $this->navigationsArray['main'],
            $this->navigations->get('main')
        );
    }

    /**
     * @test
     */
    public function it_returns_null_when_a_missing_navigation_is_fetched()
    {
        $this->assertNull($this->navigations->get('missing-nav'));
    }

    /**
     * @test
     */
    public function it_can_count_navigations()
    {
        $this->assertCount(count($this->navigationsArray), $this->navigations);
    }

    /**
     * @test
     */
    public function it_can_count_navigation_items_recursively()
    {
        $this->assertEquals(6, $this->navigations->count(COUNT_RECURSIVE));
    }

}
