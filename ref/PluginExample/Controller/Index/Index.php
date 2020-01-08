<?php
namespace Exam\PluginExample\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{	
	protected $_logger = null;

	protected $title;

	public function __construct(
		Context $context,
		\Psr\Log\LoggerInterface $logger
	) {
		$this->_logger = $logger;
		parent::__construct($context);
	}

	/*public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'Plugin main text'));
		$this->_eventManager->dispatch('plugin_example_event', ['mp_text' => $textDisplay]);
		echo $textDisplay->getText();
		$this->_logger->addDebug('Class :Index,  Method : execute');
		//exit;
	}*/



	public function execute()
	{
		echo $this->setTitle('Welcome');
		echo $this->getTitle();
	}

	public function setTitle($title)
	{
		return $this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}
}