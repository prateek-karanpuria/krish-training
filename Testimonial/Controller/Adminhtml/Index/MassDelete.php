<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Training\Testimonial\Model\Testimonial;

/**
 * MassDelete class
 * @package Training\Testimonial\Controller\Adminhtml\Index\MassDelete
 */
class MassDelete extends MassAction
{
    /**
     * @param Testimonial $testimonial
     * @return $this
     */
    protected function massAction(Testimonial $testimonial)
    {
        $this->testimonialRepository->delete($testimonial);
        return $this;
    }
}
