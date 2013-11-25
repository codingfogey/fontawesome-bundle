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
        $this->assertEquals('codingfogey_fontawesome', $this->extension->getName());
    }

    public function testGetFilters()
    {
        $this->assertCount(0, $this->extension->getFilters());
    }

    public function testGetFunctions()
    {
        $this->assertCount(2, $this->extension->getFunctions());
    }

    public function testfaIconFilter()
    {
        $this->assertEquals(
                '<i class="fa fa-twitter"></i>', $this->extension->faIconFunction('twitter')
        );
    }

    public function testfaStackedIconFilter()
    {
        $this->assertEquals(
                '<span class="fa-stack"><i class="fa-stack-2x fa fa-square-o"></i><i class="fa-stack-1x fa fa-twitter"></i></span>', $this->extension->faStackedIconFunction('twitter', 'square-o')
        );
    }

}
