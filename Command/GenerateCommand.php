<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\Command;

use Codingfogey\Bundle\FontAwesomeBundle\Utility\PathUtility;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends ContainerAwareCommand
{
    /** @var PathUtility */
    private $pathUtility;

    /**
     * {@inheritDoc}
     */
    public function __construct($name = null)
    {
        $this->pathUtility = new PathUtility();

        parent::__construct($name);
    }

    /**
     * {@inheritDoc}
     *
     * @codeCoverageIgnore
     */
    protected function configure()
    {
        $this
            ->setName('codingfogey:fontawesome:generate')
            ->setDescription('Generates a custom font-awesome.less')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getContainer()->getParameter('codingfogey_font_awesome.customize');

        if (false === isset($config['variables_file']) || null === $config['variables_file']) {
            $output->writeln('<error>Found no custom variables.less file.</error>');

            return;
        }

//        $filter = $this->getContainer()->getParameter('codingfogey_font_awesome.less_filter');
//        if ('less' !== $filter && 'lessphp' !== $filter) {
//            $output->writeln(
//                '<error>Bundle must be configured with "less" or "lessphp" to generated fontawesome.less</error>'
//            );
//
//            return;
//        }

        $output->writeln('<comment>Found custom variables file. Generating...</comment>');
        $this->executeGenerateFontAwesome($config);
        $output->writeln(sprintf('Saved to <info>%s</info>', $config['font_awesome_output']));
    }

    protected function executeGenerateFontAwesome(array $config)
    {
        // In the template for font-awesome.less we need the path where Font Awesomes .less files are stored and the path
        // to the variables.less file.
        // Absolute path do not work in LESSs import statement, we have to calculate the relative ones

        $lessDir = $this->pathUtility->getRelativePath(
            dirname($config['font_awesome_output']),
            $this->getContainer()->getParameter('codingfogey_font_awesome.assets_dir')
        );
        $variablesDir = $this->pathUtility->getRelativePath(
            dirname($config['font_awesome_output']),
            dirname($config['variables_file'])
        );
        $variablesFile = sprintf(
            '%s%s%s',
            $variablesDir,
            strlen($variablesDir) > 0 ? '/' : '',
            basename($config['variables_file'])
        );

        // We can now use Twig to render the fontawesome.less file and save it
        $content = $this->getContainer()->get('twig')->render(
            $config['font_awesome_template'],
            array(
                'variables_file' => $variablesFile,
                'assets_dir'     => $lessDir
            )
        );
        file_put_contents($config['font_awesome_output'], $content);
    }
}