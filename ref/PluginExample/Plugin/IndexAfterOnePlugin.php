<?php
namespace Exam\PluginExample\Plugin;

class IndexAfterOnePlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function afterGetTitle(\Exam\PluginExample\Controller\Index\Index $subject, $result){
		$this->_logger->addDebug('sortOrder="3" Class :IndexAfterOnePlugin,  Method : beforeDispatch');

		
		return $result;
	}
}