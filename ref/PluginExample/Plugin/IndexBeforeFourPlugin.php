<?php
namespace Exam\PluginExample\Plugin;

class IndexBeforeFourPlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function beforeSetTitle(\Exam\PluginExample\Controller\Index\Index $subject){
		$this->_logger->addDebug('sortOrder="11" Class :IndexBeforeFourPlugin,  Method : beforeDispatch');

		return 'test';
	}
}