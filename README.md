CodingfogeyFontAwesomeBundle
============================

About
------

This Bundle makes it easy to integrate [Font Awesome](http://fortawesome.github.io/Font-Awesome/) into your [Symfony2](http://symfony.com/) projects.


Prerequisites
-------------

- Font Awesome installed somewhere in your project


Installation
------------

First add `codinfogey/fontawesome-bundle` to `composer.json`:

    {
        "require": {
            "codingfogey/fontawesome-bundle": "*@dev"
        }
    }

Then add `CodingfogeyFontAwesomeBundle` to your `AppKernel.php`:

    ...
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Codingfogey\Bundle\FontAwesomeBundle\CodingfogeyFontAwesomeBundle()
        );
        ...
    }
    ...


Configuration
-------------

The configuration is very easy. 

    codingfogey_font_awesome:
        assets_dir: %kernel.root_dir%/../path/to/font-awesome


Usage
-----

Currently the bundle brings one command to install the font files to the `web` directory:

    app/console codingfogey:fontawesome:install

Additionally it brings a [Twig](http://twig.sensiolabs.org/) function to include icons:

    {{ fa('edit') }}

will create

    <span class="fa fa-edit"></span>


License
-------

- This bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- For Font Awesome you can find licensing information [here](http://fortawesome.github.io/Font-Awesome/license/)

Acknowledgment
--------------

- This bundle is inspired by [braincrafted/bootstrap-bundle](https://github.com/braincrafted/bootstrap-bundle.git) and most of the code is taken from there.
