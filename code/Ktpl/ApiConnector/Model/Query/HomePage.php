<?php 

namespace Ktpl\ApiConnector\Model\Query;

/**
 * HomePage class
 * @package Ktpl\Appconnector\Model
 */
class HomePage
{
    /**
     * @var ValidationComposite
     */
    public $validationComposite;

	public function __construct(
		\Magento\Cms\Model\PageRepository\ValidationComposite $validationComposite
    )
    {
    	$this->validationComposite = $validationComposite;
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('IN');
    }

	/**
	 * {@inheritdoc}
	 */
	public function getHomePage($id)
	{
        $homepageData['cartItems'] = 0;
        $homepageData['slider'] = "slider-123-abc-321";
        $homepageData['categories'] = $this->validationComposite->getById($id);

        $pages[0]['label'] = "Press";
        $pages[0]['id'] = "15";
        $pages[0]['contentType'] = "cms-abc-xyz";
        $pages[1]['label'] = "Sky";
        $pages[1]['id'] = "48";
        $pages[1]['contentType'] = "cms";

        $homepageData['footer'] = $pages;
        $homepageData['footer']['copyright'] = "Copyright © 2019 Sky. All rights reserved";
        $homepageData['footer']['phone'] = "1-800-SKY-5077";
        $homepageData['localization']['lsFacebook'] = "Facebook";
        $homepageData['localization']['lsInstagram'] = "Instagram";
        $homepageData['status'] = "status";
        $homepageData['text'] = "Configuration loaded successfully.";

        return $homepageData;
	}
}
