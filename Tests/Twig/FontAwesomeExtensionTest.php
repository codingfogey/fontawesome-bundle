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
        $this->assertCount(2, $this->extension->getFunctions());
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

    public function testFaIconFunctionStacked()
    {
        $icon1 = array('icon' => 'flag', 'inverse' => true);
        $icon2 = array('icon' => 'circle',);
        $this->assertEquals(
                '<span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-flag fa-stack-1x fa-inverse"></i></span>', $this->extension->faIconFunction($icon1, $icon2)
        );
    }
}
