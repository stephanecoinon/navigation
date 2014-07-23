# Navigation [![Build Status](https://travis-ci.org/stephanecoinon/navigation.svg?branch=master)](https://travis-ci.org/stephanecoinon/navigation)

Simple handler for navigation configuration.

## Installation

In your terminal, just run:

```bash
composer require "stephanecoinon/navigation":"dev-master"
```

## Usage

### Create a single navigation

```php

// Add this code in your controller

use Coinon\Navigation\Navigation;

// Describe the navigation items
// Ideally, you should load this from a configuration file
// Each item can define the following keys:
//   title:  (mandatory) title to display on the link
//   slug:   (optional)  if omitted, the package will slugify the title
//   active: (optional)  flag to say whether the item is the
//                       currently active one, true by default
//   url:    (optional)  absolute URL or URL relative to the
//                       base URL passed to constructor.
//                       Using the slug by default
//
$navConfiguration = [
    ['title' => 'Home'],
    ['title' => 'About us'],
    [
        'title' => 'Contact us',
        'slug'  => 'contact',  // will be used for URL in this case
    ],
];

// The base URL in second argument is optional
$navigation = new Navigation($navConfiguration, 'http://app.dev:8000');
// Flag the active item by slug
$navigation->activateItem('about-us');

// then pass $navigations to your views


// Add this code in your view

<ul>
<?php foreach ($navigation->all() as $navItem): ?>
  <li <?=$navItem->isActive() ? 'class="active"' : '' ?>>
    <a href="<?=$navItem->url ?>"><?=$navItem->title ?></a>
  </li>
<?php endforeach; ?>
</ul>
```

### Create multiple navigations

`Navigation` can handle multiple navigations when you need them for main horizontal menu, side bar, footer navigation...

```php

// Add this code in your controller

use Coinon\Navigation\Navigations; // note the plural

// Ideally, you should load this from a configuration file
$navConfiguration = [

    // main navigation
    'main' => [
        ['title' => 'Home'],
        ['title' => 'About us'],
        ['title' => 'Contact us'],
    ],

    // footer navigation
    'footer' => [
        ['title' => 'Contact us'],
        [
            'title' => 'Twitter',
            'url'   => 'https://www.twitter.com/breizik29',
        ],
        ['title' => 'Facebook'],
    ],

];

$navigations = new Navigations($navConfiguration, 'http://app.dev:8000');
$navigations->get('main')->activateItem('contact-us');
$navigations->get('footer')->activateItem('contact-us');

// then pass $navigations to your views


// Add this code in the view that displays the main navigation

<ul>
<?php foreach ($navigations->get('main')->all() as $navItem): ?>
  <li <?=$navItem->isActive() ? 'class="active"' : '' ?>>
    <a href="<?=$navItem->url ?>"><?=$navItem->title ?></a>
  </li>
<?php endforeach; ?>
</ul>

// You can access the footer navigation in a similar way using $navigations->get('footer')->all()
```
