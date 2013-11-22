<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\Twig;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;

class FontAwesomeExtension extends Twig_Extension
{

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'fa' => new Twig_Function_Method(
                    $this, 'faFunction', array('pre_escape' => 'html', 'is_safe' => array('html'))
            )
        );
    }

    public function faFunction($icon)
    {
        return sprintf('<i class="fa fa-%s"></i>', $icon);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'codingfogey_fontawesome';
    }

}
