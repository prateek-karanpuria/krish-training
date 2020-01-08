<?php
namespace Exam\PluginExample\Plugin;

class IndexAfterFivePlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function afterSetTitle(\Exam\PluginExample\Controller\Index\Index $subject, $result){
		$this->_logger->addDebug('sortOrder="5" Class :IndexAfterFivePlugin,  Method : afterDispatch');

		return $result;
	}
}