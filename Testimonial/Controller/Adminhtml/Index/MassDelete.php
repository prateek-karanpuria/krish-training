<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Training\Testimonial\Model\Testimonial;

/**
 * MassDelete class
 * @package Training\Testimonial\Controller\Adminhtml\Index\MassDelete
 */
class MassDelete extends \Training\Testimonial\Controller\Adminhtml\Index\MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Testimonial $data)
    {
        $this->testimonialRepository->delete($data);
        return $this;
    }
}
