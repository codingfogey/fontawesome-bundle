<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\Tests\Twig;

use Codingfogey\Bundle\FontAwesomeBundle\Twig\FontAwesomeExtension;
use PHPUnit_Framework_TestCase;

/**
 *
 */
class FontAwesomeExtensionTest extends PHPUnit_Framework_TestCase
{

    private $extension;

    public function setUp()
    {
        $this->extension = new FontAwesomeExtension();
    }

    public function testGetName()
    {
        $this->assertEquals('codingfogey_font_awesome', $this->extension->getName());
    }

    public function testGetFilters()
    {
        $this->assertCount(0, $this->extension->getFilters());
    }

    public function testGetFunctions()
    {
        $this->assertCount(1, $this->extension->getFunctions());
    }

    public function testFaIconFunctionSimple()
    {
        $this->assertEquals(
                '<i class="fa fa-twitter"></i>', $this->extension->faIconFunction('twitter')
        );
        $icon = array('icon' => 'twitter');
        $this->assertEquals(
                '<i class="fa fa-twitter"></i>', $this->extension->faIconFunction($icon)
        );
    }

    public function testFaIconFunctionScale()
    {
        $icon = array('icon' => 'twitter');

        $icon['scale'] = 'lg';
        $this->assertEquals(
                '<i class="fa fa-twitter fa-lg"></i>', $this->extension->faIconFunction($icon)
        );

        $icon['scale'] = '2x';
        $this->assertEquals(
                '<i class="fa fa-twitter fa-2x"></i>', $this->extension->faIconFunction($icon)
        );

        $icon['scale'] = '3x';
        $this->assertEquals(
                '<i class="fa fa-twitter fa-3x"></i>', $this->extension->faIconFunction($icon)
        );

        $icon['scale'] = '4x';
        $this->assertEquals(
                '<i class="fa fa-twitter fa-4x"></i>', $this->extension->faIconFunction($icon)
        );

        $icon['scale'] = '5x';
        $this->assertEquals(
                '<i class="fa fa-twitter fa-5x"></i>', $this->extension->faIconFunction($icon)
        );
    }

    public function testFaIconFunctionFixedWidth()
    {
        $icon = array('icon' => 'twitter');

        $icon['fixed-width'] = true;
        $this->assertEquals(
                '<i class="fa fa-twitter fa-fw"></i>', $this->extension->faIconFunction($icon)
        );
    }

    public function testFaIconFunctionPull()
    {
        $icon = array('icon' => 'twitter');

        $icon['pull'] = 'left';
        $this->assertEquals(
                '<i class="fa fa-twitter fa-pull-left"></i>', $this->extension->faIconFunction($icon)
        );

        $icon['pull'] = 'right';
        $this->assertEquals(
                '<i class="fa fa-twitter fa-pull-right"></i>', $this->extension->faIconFunction($icon)
        );
    }

    public function testFaIconFunctionSpin()
    {
        $icon = array('icon' => 'twitter');

        $icon['spin'] = true;
        $this->assertEquals(
                '<i class="fa fa-twitter fa-spin"></i>', $this->extension->faIconFunction($icon)
        );
    }

    public function testFaIconFunctionStacked()
    {
        $icon1 = array('icon' => 'flag', 'inverse' => true);
        $icon2 = array('icon' => 'circle',);
        $this->assertEquals(
                '<span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-flag fa-stack-1x fa-inverse"></i></span>', $this->extension->faIconFunction($icon1, $icon2)
        );
    }
}
