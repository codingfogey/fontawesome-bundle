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
        $this->assertEquals('codingfogey_fontawesome',
                            $this->extension->getName());
    }

    public function testGetFilters()
    {
        $this->assertCount(0, $this->extension->getFilters());
    }

    public function testGetFunctions()
    {
        $this->assertCount(2, $this->extension->getFunctions());
    }

    public function testFaIconFilterSimple()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter')
        );
    }

    public function testFaIconFilterScaleAllowed()
    {
        $this->assertEquals(
            '<i class="fa-3x fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('scale' => '3x'))
        );
    }

    public function testFaIconFilterScaleNotAllowed()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('scale' => '7'))
        );
    }

    public function testFaIconFilterFixedWidth()
    {
        $this->assertEquals(
            '<i class="fa-fixed-width fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter',
                                             array('fixed-width' => true))
        );
    }

    public function testFaIconFilterFixedWidthNonBoolean()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter',
                                             array('fiexed-width' => 'alfred'))
        );
    }

    public function testFaIconFilterListIcon()
    {
        $this->assertEquals(
            '<i class="fa-li fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter',
                                             array('list-icon' => true))
        );
    }

    public function testFaIconFilterListIconNonBoolean()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter',
                                             array('list-icon' => 'alfred'))
        );
    }

    public function testFaIconFilterBorder()
    {
        $this->assertEquals(
            '<i class="fa-border fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('border' => true))
        );
    }

    public function testFaIconFilterBorderNonBoolean()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter',
                                             array('border' => 'alfred'))
        );
    }

    public function testFaIconFilterPull()
    {
        $this->assertEquals(
            '<i class="fa-pull-left fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('pull' => 'left'))
        );
    }

    public function testFaIconFilterPullNotAllowed()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('pull' => 'bit'))
        );
    }

    public function testFaIconFilterSpin()
    {
        $this->assertEquals(
            '<i class="fa-spin fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('spin' => true))
        );
    }

    public function testFaIconFilterSpinNonBoolean()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('spin' => 'dr'))
        );
    }

    public function testFaIconFilterRotate()
    {
        $this->assertEquals(
            '<i class="fa-rotate-180 fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('rotate' => '180'))
        );
    }

    public function testFaIconFilterRotateNotAllowed()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter',
                                             array('rotate' => 'ebgngr'))
        );
    }

    public function testFaStackedIconFilter()
    {
        $this->assertEquals(
            '<span class="fa-stack"><i class="fa-stack-2x fa fa-square-o"></i><i class="fa-stack-1x fa fa-twitter"></i></span>',
            $this->extension->faStackedIconFunction('twitter', 'square-o')
        );
    }

    public function testFaIconFilterFlip()
    {
        $this->assertEquals(
            '<i class="fa-flip-horizontal fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter',
                                             array('flip' => 'horizontal'))
        );
    }

    public function testFaIconFilterFlipNotAllowed()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('flip' => 'pilf'))
        );
    }

    public function testFaIconFilterInverse()
    {
        $this->assertEquals(
            '<i class="fa-inverse fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('inverse' => true))
        );
    }

    public function testFaIconFilterInverseNonBoolean()
    {
        $this->assertEquals(
            '<i class="fa fa-twitter"></i>',
            $this->extension->faIconFunction('twitter', array('inverse' => 1234))
        );
    }
}
