CodingfogeyFontAwesomeBundle
============================

[![Latest Stable Version](https://poser.pugx.org/codingfogey/fontawesome-bundle/v/stable.png)](https://packagist.org/packages/codingfogey/fontawesome-bundle)
[![Latest Unstable Version](https://poser.pugx.org/codingfogey/fontawesome-bundle/v/unstable.png)](https://packagist.org/packages/codingfogey/fontawesome-bundle)
[![Build Status](https://travis-ci.org/codingfogey/fontawesome-bundle.png)](https://travis-ci.org/codingfogey/fontawesome-bundle)
[![Total Downloads](https://poser.pugx.org/codingfogey/fontawesome-bundle/downloads.png)](https://packagist.org/packages/codingfogey/fontawesome-bundle)

[![knpbundles.com](http://knpbundles.com/codingfogey/fontawesome-bundle/badge-short)](http://knpbundles.com/codingfogey/fontawesome-bundle)


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
            "codingfogey/fontawesome-bundle": "dev-master"
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

The current version has not much to configure. Only the path to your Font Awesome installation directory has to be set.

    codingfogey_font_awesome:
        assets_dir: %kernel.root_dir%/../path/to/font-awesome


Usage
-----

Currently the bundle provides one command to install the font files to the `web/fonts` directory:

    app/console codingfogey:fontawesome:install
    
There is also a `ScriptHandler` for conveniently doing this automatically on each `composer install` or `composer update`:

    ...
    "scripts": {
        "post-install-cmd": [
            ...
            "Codingfogey\\Bundle\\FontAwesomeBundle\\Composer\\ScriptHandler::install"
        ],
        "post-update-cmd": [
            ...
            "Codingfogey\\Bundle\\FontAwesomeBundle\\Composer\\ScriptHandler::install"
        ]
    },
    ...


Additionally it provides a [Twig](http://twig.sensiolabs.org/) function to include the icons:

    {{ fa('edit') }}

will create

    <i class="fa fa-edit"></i>

TODO
----

Look [here](../../issues?milestone=&state=open)


License
-------

- This bundle is licensed under the [MIT License](http://opensource.org/licenses/MIT)
- For Font Awesome you can find licensing information [here](http://fortawesome.github.io/Font-Awesome/license/)


Acknowledgment
--------------

- This bundle is mainly inspired by [braincrafted/bootstrap-bundle](https://github.com/braincrafted/bootstrap-bundle.git) and most of the code is taken from there.
