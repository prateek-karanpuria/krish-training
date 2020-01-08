<?php
namespace Exam\PluginExample\Plugin;

class IndexAfterThreePlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function afterGetTitle(\Exam\PluginExample\Controller\Index\Index $subject, $result){
		$this->_logger->addDebug('sortOrder="10" Class :IndexAfterThreePlugin,  Method : beforeDispatch');

		return $result;
	}
}