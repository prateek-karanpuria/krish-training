<?php

namespace Training\Testimonial\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * class PrintName
 * @package Training\Testimonial\Console\Command
 */
class PrintName extends Command
{
    const NAME = 'name';

    public function configure()
    {
        $this->setName("print:name")
             ->setDescription("Print Name")
             ->setAliases(["p:n", "p1:n1"])
             ->addArgument(
                self::NAME,
                InputArgument::REQUIRED,
                'Name'
            );
    }

    /**
     * [execute description]
     * @param  InputInterface  $input  [description]
     * @param  OutputInterface $output [description]
     * @return [type]                  [description]
     */
    public function execute(
        InputInterface $input,
        OutputInterface $output
    )
    {
        $output->writeln("Name entered is ".$input->getArgument(self::NAME));
    }
}
