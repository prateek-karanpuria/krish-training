<?php 

namespace SussexDev\Sample\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use SussexDev\Sample\Model\DataFactory;
use Magento\Framework\Console\Cli;

#use Psr\Log\LoggerInterface;

class AddRow extends Command
{
    const DATA_TITLE = 'data_title';
    const DATA_DESCRIPTION = 'data_description';

    protected $dataFactory;
    protected $logger;

    public function __construct(
        DataFactory $dataFactory,
        LoggerInterface $logger
    )
    {
        $this->dataFactory = $dataFactory;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('sussexdev:data:add')
            ->addArgument(
                self::DATA_TITLE,
                InputArgument::REQUIRED,
                'Data Title'
            )->addArgument(
                self::DATA_DESCRIPTION,
                InputArgument::OPTIONAL,
                'Data Description'
            );
        parent::configure();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    )
    {
        $item = $this->dataFactory->create();
        //$item->setDataTitle($input->getArgument(self::DATA_TITLE));
        $item->setRowData(self::DATA_TITLE, $input->getArgument(self::DATA_TITLE));
        $item->setDataDescription($input->getArgument(self::DATA_DESCRIPTION));
        //$item->setIsActive('is_active', 1);
        $item->save();

        $this->logger->debug('Sample record was saved!');
        return Cli::RETURN_SUCCESS;
    }
}
