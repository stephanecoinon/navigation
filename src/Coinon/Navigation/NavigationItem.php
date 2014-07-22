<?php namespace Coinon\Navigation;

use Cocur\Slugify\Slugify;

class NavigationItem {

    /**
     * @var string
     */
	public $slug;

    /**
     * @var string
     */
	public $title;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $baseUrl;


    /**
     * @param array  $attributes
     * @param string $baseUrl    (optional) Base URL used to prefix the URLs
     * @throws \InvalidArgumentException if $attributes doesn't contain the required keys
     */
    function __construct(array $attributes, $baseUrl='') {
        $this->baseUrl = $baseUrl;

        if ( ! isset($attributes['title'])) throw new \InvalidArgumentException('Navigation item title is required');
        if ( ! isset($attributes['slug'])) {
            $slugify = new Slugify;
            $attributes['slug'] = $slugify->slugify($attributes['title']);
        }
        isset($attributes['active']) OR $attributes['active'] = false;
        isset($attributes['url']) OR $attributes['url'] = $attributes['slug'];

        if ( ! NavigationHelper::isAbsoluteUrl($attributes['url'])) {
            $attributes['url'] = NavigationHelper::concatPath([$this->baseUrl, $attributes['url']]);
        }

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
