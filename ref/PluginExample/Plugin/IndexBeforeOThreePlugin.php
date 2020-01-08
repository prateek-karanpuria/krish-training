<?php
namespace Exam\PluginExample\Plugin;

class IndexBeforeOThreePlugin {

	protected $_logger = null;

	public function __construct(\Psr\Log\LoggerInterface $logger) {
		$this->_logger = $logger;
	}

	public function beforeSetTitle(\Exam\PluginExample\Controller\Index\Index $subject){
		$this->_logger->addDebug('sortOrder="7" Class :IndexBeforeOThreePlugin,  Method : beforeDispatch');

		return 'test';
	}
}