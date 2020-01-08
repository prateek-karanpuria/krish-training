<?php
namespace Exam\PluginExample\Plugin;

class IndexAfterFourPlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function afterSetTitle(\Exam\PluginExample\Controller\Index\Index $subject, $result){
		$this->_logger->addDebug('sortOrder="13" Class :IndexAfterFourPlugin,  Method : beforeDispatch');

		return $result;
	}
}