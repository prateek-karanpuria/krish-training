<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Training\Testimonial\Model\Testimonial;

/**
 * MassEnable class
 * @package Training\Testimonial\Controller\Adminhtml\Index\MassEnable
 */
class MassReject extends MassAction
{
    /**
     * @param Testimonial $testimonial
     * @return $this
     */
    protected function massAction(Testimonial $testimonial)
    {
        $data->setIsApproved(2);
        $this->testimonialRepository->save($testimonial);
        return $this;
    }
}
