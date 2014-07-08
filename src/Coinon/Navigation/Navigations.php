<?php namespace Coinon\Navigation;

class Navigations {

    function __construct(array $navigations)
    {
        foreach ($navigations as $navName => $navigation)
        {
            $this->navigations[$navName] = new Navigation($navigation);
        }
    }

}
