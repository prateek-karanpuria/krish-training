<?php
namespace Exam\PluginExample\Plugin;

class IndexBeforeOnePlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function beforeSetTitle(\Exam\PluginExample\Controller\Index\Index $subject){
		$this->_logger->addDebug('sortOrder="1" Class :IndexBeforeOnePlugin,  Method : beforeDispatch');

		return 'test';
	}
}