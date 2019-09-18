<?php

namespace Training\Testimonial\Controller\Index;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\HTTP\Header;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\MediaStorage\Model\File\Uploader;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Training\Testimonial\Helper\Data;
use Training\Testimonial\Model\TestimonialFactory;

/**
 * Class Save
 * @package Training\Testimonial\Controller\Index
 */
class Save extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var TestimonialFactory
     */
    protected $_testimonialFactory;

    /**
     * @var Filesystem
     */
    protected $_filesystem;

    /**
     * @var Header
     */
    protected $_httpHeader;

    /**
     * @var RemoteAddress|Header
     */
    protected $_remoteAddress;

    /**
     * @var UploaderFactory|UploadFactory
     */
    protected $_fileUploaderFactory;

    /**
     * @var Filesystem\Directory\WriteInterface
     */
    protected $_mediaDirectory;

    /**
     * @var string
     */
    protected $uploadFileMediaDirectoryPath = 'training/testimonials/';

    /**
     * @var TimezoneInterface
     */
    protected $_timezoneInterface;

    /**
     * @var Data
     */
    protected $_helperData;

    /**
     * @var UrlInterface
     */
    protected $_urlInterface;

    /**
     * Save constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param TestimonialFactory $testimonialFactory
     * @param Filesystem $filesystem
     * @param Header $header
     * @param RemoteAddress $remoteAddress
     * @param UploaderFactory $fileUploaderFactory
     * @param TimezoneInterface $timezoneInterface
     * @throws FileSystemException
     */
    public function __construct(
        Context $context,
        UrlInterface $urlInterface,
        Data $helperData,
        PageFactory $pageFactory,
        TestimonialFactory $testimonialFactory,
        Filesystem $filesystem,
        Header $header,
        RemoteAddress $remoteAddress,
        UploaderFactory $fileUploaderFactory,
        TimezoneInterface $timezoneInterface
    ) {
        $this->_helperData   = $helperData;
        $this->_urlInterface = $urlInterface;

        $this->_pageFactory        = $pageFactory;
        $this->_testimonialFactory = $testimonialFactory;

        $this->_filesystem          = $filesystem;
        $this->_mediaDirectory      = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;

        $this->_httpHeader    = $header;
        $this->_remoteAddress = $remoteAddress;

        $this->_timezoneInterface = $timezoneInterface;

        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        if ($this->_helperData->getGeneralConfig('module_enable')) {
            if ($this->getRequest()->isPost()) {
                $input = $this->getRequest()->getPostValue();
                $files = $this->getRequest()->getFiles();

                $input['user_ip']    = $this->_remoteAddress->getRemoteAddress();
                $input['user_agent'] = $this->_httpHeader->getHttpUserAgent();

                $imageUploadSuccess = true;

                if ($files['image']['name']) {
                    try {
                        $target = $this->_mediaDirectory->getAbsolutePath($this->uploadFileMediaDirectoryPath);

                        /**
                         * @var $uploader Uploader
                         */
                        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);

                        /**
                         * Allowed extension types
                         */
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

                        /**
                         * Rename file name if already exists
                         */
                        $uploader->setAllowRenameFiles(true);

                        /**
                         * Upload file in custom folder "uploadedFiles"
                         */
                        $result = $uploader->save($target);

                        if ($result['file']) {
                            $this->messageManager->addSuccessMessage(__('File has been uploaded successfully.'));
                        }

                        $input['image'] = str_ireplace('/var/www/html/magento2/', '', $result['path']) . $uploader->getUploadedFileName();
                    } catch (Exception $e) {
                        $imageUploadSuccess = false;
                        $this->messageManager->addErrorMessage($e->getMessage() . __(' Allowed file extensions: \'jpg\', \'jpeg\', \'gif\', \'png\''));
                    }
                }

                $input['added_on']   = $this->_timezoneInterface->date()->format('Y-m-d H:i:s');
                $input['updated_on'] = $this->_timezoneInterface->date()->format('Y-m-d H:i:s');

                /**
                 * Additional condition for record insertion
                 */
                if (!$input['id']) {
                    unset($input['id']);
                }

                $testimonial = $this->_testimonialFactory->create();

                try {
                    if (!$imageUploadSuccess) {
                        throw new Exception();
                    }

                    $testimonial->setData($input)->save();
                    $this->messageManager->addSuccessMessage(__("Record saved successfully."));
                } catch (Exception $exception) {
                    $this->messageManager->addErrorMessage(__("Record saved failed, please try again."));
                }

                return $this->_redirect('testimonial/index/listview');
            }
        } else {
            $this->_redirect($this->_urlInterface->getBaseUrl());
        }
    }
}
