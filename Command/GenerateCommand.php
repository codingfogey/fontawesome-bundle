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

        $variablesFilePathParts = pathinfo($config['variables_file']);
        $outputFilePathParts = pathinfo($config['font_awesome_output']);

        if ($variablesFilePathParts['extension'] != $outputFilePathParts['extension'])
        {
            $output->writeln('<error>The variables file and the output file must have the same extension (less/scss).</error>');
            return;
        }

        if ("scss" === $variablesFilePathParts['extension'] && "_" != substr($variablesFilePathParts['basename'], 0, 1))
        {
            $output->writeln('<error>The variables file name must start with an `_`.</error>');
            return;
        }

        if (!is_readable($config['variables_file'])) {
            $output->writeln('<error>Cannot find custom variables file.</error>');
            return;
        }

        if (!is_dir(dirname($config['font_awesome_output'])))
        {
            $output->writeln('<comment>Cannot find target directory. Creating...</comment>');
            mkdir(dirname($config['font_awesome_output']));
            $output->writeln(sprintf('Created directory <info>%s</info>', dirname($config['font_awesome_output'])));
        }

        $renderer = $variablesFilePathParts['extension'];

        $output->writeln('<comment>Found custom variables file. Generating...</comment>');
        $this->executeGenerateFontAwesome($config, $renderer);
        $output->writeln(sprintf('Saved to <info>%s</info>', $config['font_awesome_output']));
    }

    protected function executeGenerateFontAwesome(array $config, $renderer)
    {

        $lessDir = $this->pathUtility->getRelativePath(
            dirname($config['font_awesome_output']),
            $this->getContainer()->getParameter('codingfogey_font_awesome.assets_dir')
        );
        $variablesDir = $this->pathUtility->getRelativePath(
            dirname($config['font_awesome_output']),
            dirname($config['variables_file'])
        );

        $variablesFile = sprintf(
            '%s%s',
            $variablesDir,
            strlen($variablesDir) > 0 ? '/' : '',
            "scss" === $renderer ? substr(basename($config['variables_file'], ".scss"),1) : basename($config['variables_file'])
        );

        $templateFile = sprintf('CodingfogeyFontAwesomeBundle:FontAwesome:fontawesome.%s.twig', $renderer);

        $content = $this->getContainer()->get('twig')->render(
            $templateFile,
            array(
                'variables_file' => $variablesFile,
                'assets_dir'     => $lessDir
            )
        );

        file_put_contents($config['font_awesome_output'], $content);
    }
}
