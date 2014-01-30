<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\DependencyInjection;

/**
 * Description of AsseticConfiguration
 *
 * @author ernst
 */
class AsseticConfiguration
{

    public function build(array $config)
    {
        $output = array();

        if ('/' !== substr($config['output_dir'], -1) && strlen($config['output_dir']) > 0) {
            $config['output_dir'] .= '/';
        }

        switch ($config['filter']) {
            case 'none' :
                $output['fontawesome_css'] = $this->copyCss($config);
                break;
            case 'less' :
                $output['fontawesome_css'] = $this->buildWithLess($config);
                break;
            case 'sass' :
                $output['fontawesome_css'] = $this->buildWithSass($config);
                break;
        }

        return $output;
    }

    protected function copyCss(array $config)
    {
        $inputs[] = $config['assets_dir'] . '/css/font-awesome.css';

        return array(
            'inputs' => $inputs,
            'filters' => array(),
            'output' => $config['output_dir'] . 'css/fontawesome.css'
        );
    }

    protected function buildWithLess(array $config)
    {
        $fontawesomeFile = $config['assets_dir'] . '/less/font-awesome.less';
        if (true === isset($config['customize']['variables_file']) &&
            null !== $config['customize']['variables_file']) {
            $fontawesomeFile = $config['customize']['font_awesome_output'];
        }

        $inputs = array(
            $fontawesomeFile,
        );

        return array(
            'inputs' => $inputs,
            'filters' => array($config['filter']),
            'output' => $config['output_dir'] . 'css/fontawesome.css'
        );
    }

    protected function buildWithSass(array $config)
    {
        $fontawesomeFile = $config['assets_dir'] . '/scss/font-awesome.scss';
        if (true === isset($config['customize']['variables_file']) &&
            null !== $config['customize']['variables_file']) {
            $fontawesomeFile = $config['customize']['font_awesome_output'];
        }

        $inputs = array(
            $fontawesomeFile,
        );

        return array(
            'inputs' => $inputs,
            'filters' => array($config['filter']),
            'output' => $config['output_dir'] . 'css/fontawesome.css'
        );
    }
}
