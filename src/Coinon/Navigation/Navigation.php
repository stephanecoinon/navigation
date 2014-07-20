<?php namespace Coinon\Navigation;

class Navigation implements \Countable {

    /** @var  array */
    protected $items;

    /** @var NavigationItem */
    protected $activeItem = null;

    /**
	 * @param array $navigation
	 */
	function __construct($navigation)
	{
        $this->items = array();
        foreach ($navigation as $item) {
            $this->items[] = new NavigationItem($item);
        }
	}

    /**
     * Make the item with the given slug active
     *
     * @param string $slug
     */
    public function activateItem($slug)
    {
        if ($this->activeItem) $this->activeItem->deactivate();
        $this->activeItem = null;

        $item = $this->findItemBySlug($slug);
        if ($item) {
            $item->activate();
            $this->activeItem = $item;
        }
    }

    /**
     * Returns the number of navigation items
     *
     * @var int
     */
    public function count($mode = COUNT_NORMAL)
    {
        return count($this->items);
    }

    public function all()
    {
        return $this->items;
    }

    /**
     * Find an item by searching for the given attribute name and value
     *
     * @param string $attribute
     * @param mixed $value
     * @return NavigationItem|null
     */
    public function findItemByAttribute($attribute, $value)
    {
        foreach ($this->items as $item)
        {
           if (isset($item->$attribute) && $item->$attribute==$value) return $item;
        }

        return null;
    }

    /**
     * Find the item having the given slug
     *
     * @param string $slug
     * @return NavigationItem|null
     */
    public function findItemBySlug($slug)
    {
        return $this->findItemByAttribute('slug', $slug);
    }

    /**
     * Return whether the item with the given slug is active
     *
     * @param string $slug
     * @return bool
     */
    public function isActive($slug)
    {
        if ($this->activeItem) {
            return $this->activeItem->slug == $slug;
        } else {
            return false;
        }
    }

}
