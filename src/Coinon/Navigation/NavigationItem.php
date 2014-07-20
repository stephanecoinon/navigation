<?php namespace Coinon\Navigation;

use Cocur\Slugify\Slugify;

class NavigationItem {

    /** @var  string */
	public $slug;
    /** @var  string */
	public $title;
    /** @var  bool */
    protected $active;

    /**
     * @var string
     */
    public $url;


    /**
     * @param array  $attributes
     * @throws \InvalidArgumentException if $attributes doesn't contain the required keys
     */
    function __construct(array $attributes) {
        if ( ! isset($attributes['title'])) throw new \InvalidArgumentException('Navigation item title is required');
        if ( ! isset($attributes['slug'])) {
            $slugify = new Slugify;
            $attributes['slug'] = $slugify->slugify($attributes['title']);
        }
        isset($attributes['active']) OR $attributes['active'] = false;
        isset($attributes['url']) OR $attributes['url'] = $attributes['slug'];

        foreach (['title', 'slug', 'active', 'url'] as $attributeName)
        {
            $this->$attributeName = $attributes[$attributeName];
        }
	}

    public function activate()
    {
        $this->active = true;
    }

    public function deactivate()
    {
        $this->active = false;
    }

    public function isActive()
    {
        return $this->active;
    }

}
