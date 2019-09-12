<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Training\Testimonial\Model\Testimonial;

/**
 * MassEnable class
 * @package Training\Testimonial\Controller\Adminhtml\Index\MassEnable
 */
class MassApprove extends MassAction
{
    /**
     * @param Testimonial $testimonial
     * @return $this
     */
    protected function massAction(Testimonial $testimonial)
    {
        $data->setIsApproved(1);
        $this->testimonialRepository->save($testimonial);
        return $this;
    }
}
