<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;

class FontAwesomeExtension extends Twig_Extension
{
    private $allowedOptions = array(
        'icon' => 'fa-%s',
        'scale' => 'fa-%s',
        'fixed-width' => 'fa-fw',
        'list-icon' => 'fa-li',
        'border' => 'fa-border',
        'pull' => 'fa-pull-%s',
        'spin' => 'fa-spin',
        'rotate' => 'fa-rotate-%s',
        'flip' => 'fa-flip-%s',
        'inverse' => 'fa-inverse'
    );

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'fa_icon' => new Twig_Function_Method(
                $this, 'faIconFunction', array('pre_escape' => 'html', 'is_safe' => array('html'))
            ),
        );
    }

    /**
     *
     *
     * @param  mixed  $icon Icon name
     * @return string
     *
     *  {
     *      name:           "globe"
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
    public function faIconFunction($icon1, $icon2 = null, $container = null)
    {

        if (null === $icon2) {
            return $this->createSimpleIcon($icon1);
        }

        return $this->createStackedIcon($icon1, $icon2, $container);
    }

    public function createSimpleIcon($icon)
    {

        $classes = array('fa');

        if (true === is_array($icon)) {
            foreach ($this->allowedOptions as $option => $template) {
                if (true === isset($icon[$option])) {
                    $classes[] = sprintf($template, $icon[$option]);
                }
            }
            if (true === isset($icon['classes'])) {
                $classes[] = implode(' ', $icon['classes']);
            }
        } else {
            $classes[] = sprintf("fa-%s", $icon);
        }

        return sprintf('<i class="%s"></i>', implode(' ', $classes));
    }

    /**
     *
     * @param  mixed  $icon1     Foreground icon name
     * @param  mixed  $icon2     Background icon name
     * @param  array  $container Icon container Options
     * @return string
     */
    protected function createStackedIcon($icon1, $icon2, $container = null)
    {

        $classes = array(
            'fa-stack'
        );

        if (true === isset($container['scale'])) {
            $classes[] = sprintf("fa-%s", $container['scale']);
        }
        if (true === isset($container['classes'])) {
            $classes[] = implode(' ', $icon['classes']);
        }

        $containerType = true === isset($container['type']) ? $container['type'] : 'span';

        $output[] = sprintf('<%s class="%s">', $containerType, implode(' ', $classes));
        $output[] = $this->createSimpleIcon($icon2);
        $output[] = $this->createSimpleIcon($icon1);
        $output[] = sprintf('</%s>', $containerType);

        return implode('', $output);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'codingfogey_font_awesome';
    }
}
