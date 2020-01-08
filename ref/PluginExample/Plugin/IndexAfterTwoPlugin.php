<?php
namespace Exam\PluginExample\Plugin;

class IndexAfterTwoPlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function afterGetTitle(\Exam\PluginExample\Controller\Index\Index $subject, $result){
		$this->_logger->addDebug('sortOrder="6" Class :IndexAfterTwoPlugin,  Method : beforeDispatch');

		return $result;
	}
}