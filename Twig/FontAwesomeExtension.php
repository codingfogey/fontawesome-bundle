<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\Twig;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;

class FontAwesomeExtension extends Twig_Extension
{

    private $allowed_scales = array('lg', '1x', '2x', '3x', '4x', '5x', 'stack-1x', 'stack-2x');
    private $allowed_rotations = array('90', '180', '270');

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'fa_icon' => new Twig_Function_Method(
                    $this, 'faIconFunction', array('pre_escape' => 'html', 'is_safe' => array('html'))
            ),
            'fa_stacked_icon' => new Twig_Function_Method(
                    $this, 'faStackedIconFunction', array('pre_escape' => 'html', 'is_safe' => array('html'))
            ),
        );
    }

    /**
     * 
     * 
     * @param type $icon        Icon name
     * @param array $options    Icon options
     * @return string           
     * 
     *  {
     *      scale:          null,
     *      fixed-width:    false,
     *      list-icon:      false,
     *      border:         false,
     *      pull:           null,
     *      spin:           false,
     *      rotate:         null,
     *      flip:           null,
     *  }
     */
    public function faIconFunction($icon, array $options = array())
    {
        $classes = array();
        if (true === isset($options['scale']) && true === in_array($options['scale'], $this->allowed_scales)) {
            $classes[] = sprintf("fa-%s", $options['scale']);
        }
        if (true === isset($options['fixed-width']) && true === $options['fixed-width']) {
            $classes[] = "fa-fixed-width";
        }
        if (true === isset($options['list-icon']) && true === $options['list-icon']) {
            $classes[] = "fa-li";
        }
        if (true === isset($options['border']) && true === $options['border']) {
            $classes[] = "fa-border";
        }
        if (true === isset($options['pull']) && true === in_array($options['pull'], array('left', 'right'))) {
            $classes[] = sprintf("fa-pull-%s", $options['border']);
        }
        if (true === isset($options['spin']) && true === $options['spin']) {
            $classes[] = "fa-spin";
        }
        if (true === isset($options['rotate']) && true === in_array($options['scale'], $this->allowed_rotations)) {
            $classes[] = sprintf("fa-rotate-%s", $options['rotate']);
        }
        if (true === isset($options['flip']) && true === in_array($options['flip'], array('horizontal', 'vertical'))) {
            $classes[] = sprintf("fa-flip-%s", $options['flip']);
        }
        if (true === isset($options['inverse']) && (true === $options['inverse'])) {
            $classes[] = "fa-inverse";
        }
        if (true === isset($options['classes'])) {
            $classes[] = $options['classes'];
        }

        $classes[] = "fa";
        $classes[] = sprintf("fa-%s", $icon);

        return sprintf('<i class="%s"></i>', implode(' ', $classes));
    }

    /**
     * 
     * @param string $icon1     Foreground icon name
     * @param string $icon2     Background icon name
     * @param array $options1   Foreground icon options
     * @param array $options2   Background icon options
     * @param array $options    Icon container Options
     * @return string
     */
    public function faStackedIconFunction($icon1, $icon2, array $options1 = array(), array $options2 = array(), array $options = array())
    {
        $classes = array();
        $classes[] = "fa-stack";
        if (true === isset($options['scale']) && true === in_array($options['scale'], $this->allowed_scales)) {
            $classes[] = sprintf("fa-%s", $options['scale']);
        }

        $options1['scale'] = 'stack-1x';
        $options2['scale'] = 'stack-2x';

        $output[] = sprintf('<span class="%s">', implode(' ', $classes));
        $output[] = $this->faIconFunction($icon2, $options2);
        $output[] = $this->faIconFunction($icon1, $options1);
        $output[] = '</span>';

        return implode('', $output);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'codingfogey_fontawesome';
    }

}
