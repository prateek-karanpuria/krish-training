<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Training\Testimonial\Model\Testimonial;

/**
 * MassEnable class
 * @package Training\Testimonial\Controller\Adminhtml\Index\MassEnable
 */
class MassApprove extends \Training\Testimonial\Controller\Adminhtml\Index\MassAction
{
    /**
     * @param Testimonial $testimonial
     * @return $this
     */
    protected function massAction(Testimonial $testimonial)
    {
        $testimonial->setIsApproved(1);
        $this->testimonialRepository->save($testimonial);
        return $this;
    }
}
