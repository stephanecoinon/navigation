<?php namespace Coinon\Navigation;

/**
 * Repository of navigations if you need multiple ones
 */
class Navigations implements \Countable {

    protected $navigations = [];

    /**
     * @param array  $navigations
     * @param string $baseUrl
     */
    function __construct(array $navigations, $baseUrl = '')
    {
        foreach ($navigations as $navName => $navigation)
        {
            $this->navigations[$navName] = new Navigation($navigation, $baseUrl);
        }
    }

    /**
     * Get a navigation
     *
     * @param  string $navName
     * @return Navigation|null
     */
    public function get($navName)
    {
        return isset($this->navigations[$navName]) ? $this->navigations[$navName] : null;
    }

    /**
     * Returns the number of navigations loaded
     *
     * @var int
     */
    public function count($mode = COUNT_NORMAL)
    {
        $count = 0;

        if ($mode == COUNT_RECURSIVE) {
            foreach ($this->all() as $nav)
            {
                $count += $nav->count();
            }
        } else {
            $count = count($this->navigations);
        }

        return $count;
    }

    /**
     * Fetch all navigations
     *
     * @return array Array of <code>Navigation</code>
     */
    public function all()
    {
        return $this->navigations;
    }

}
