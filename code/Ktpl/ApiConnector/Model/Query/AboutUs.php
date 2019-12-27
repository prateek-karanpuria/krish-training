<?php

namespace Ktpl\ApiConnector\Model\Query;

/**
 * AboutUs class
 * @package Ktpl\ApiConnector\Model\Query
 */
class AboutUs
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
    }

    /**
     * {@inheritdoc}
     */
    public function getAboutPage($id)
    {
        $aboutUs[] = "About Sky Mobile-123";
        $aboutUs[] = $this->validationComposite->getById($id)->getData('content') ?? '';
        $aboutUs['status'] = "success";
        $aboutUs['text'] = "CMS content data loaded successfully.";

        return $data[] = $aboutUs;
    }
}
