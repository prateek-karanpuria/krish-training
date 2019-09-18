<?php

namespace Training\Testimonial\Block;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;
use Training\Testimonial\Model\TestimonialFactory;

/**
 * Class Add
 * @package Training\Testimonial\Block
 */
class Add extends Template
{

    /**
     * @var TestimonialFactory
     */
    protected $_testimonialFactory;

    /**
     * Add constructor.
     * @param Template\Context $context
     * @param TestimonialFactory $testimonialFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        TestimonialFactory $testimonialFactory,
        array $data = []
    ) {
        $this->_testimonialFactory = $testimonialFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array|RequestInterface
     */
    public function getRequest($param = '')
    {
        if ($param) {
            return parent::getRequest()->getParam($param);
        } else {
            return parent::getRequest()->getParams();
        }
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        $recordId    = $this->getRequest('record') ?? '';
        $testimonial = $this->_testimonialFactory->create();
        $collection  = $testimonial->getCollection()->addFieldToFilter("id", ["eq" => $recordId])->addFieldToFilter("deleted", ["eq" => 0]);

        $data['id'] = $recordId;

        if ($collection) {
            foreach ($collection as $item) {
                $data['name']    = $item->getData('name');
                $data['email']   = $item->getData('email');
                $data['image']   = $item->getData('image');
                $data['ratings'] = $item->getData('ratings');
                $data['message'] = $item->getData('message');
            }
        }
        return $data;
    }
}
