<?php
namespace Exam\PluginExample\Plugin;

class IndexBeforeOTwoPlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function beforeSetTitle(\Exam\PluginExample\Controller\Index\Index $subject){
		$this->_logger->addDebug('sortOrder="4" Class :IndexBeforeOTwoPlugin,  Method : beforeDispatch');

		return 'test';
	}
}