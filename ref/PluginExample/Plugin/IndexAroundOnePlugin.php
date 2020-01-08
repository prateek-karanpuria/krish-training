<?php
namespace Exam\PluginExample\Plugin;

class IndexAroundOnePlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function aroundSetTitle(\Exam\PluginExample\Controller\Index\Index $subject, callable $proceed){
		
		$this->_logger->addDebug('sortOrder="2" Class :IndexAroundOnePlugin Before proceed,  Method : aroundGetTitle');
		$result = $proceed();
		$this->_logger->addDebug('sortOrder="2" Class :IndexAroundOnePlugin After proceed,  Method : aroundGetTitle');

		return $result;
	}
}