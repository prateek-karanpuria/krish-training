<?php
 
namespace Ktpl\WageWysiwyg\Model\Cms\Wysiwyg\Images;

/**
 * Storage class
 * @package Ktpl\WageWysiwyg\Model\Cms\Wysiwyg\Images
 */
class Storage extends \Magento\Cms\Model\Wysiwyg\Images\Storage
{

    /**
     * [uploadFile description]
     * 
     * @param  [type] $targetPath
     * @param  [type] $type
     * @return [type]
     */
    public function uploadFile($targetPath, $type = null)
    {
        /**
         * @var \Magento\MediaStorage\Model\File\Uploader $uploader
         */
        $uploader = $this->_uploaderFactory->create(['fileId' => 'image']);
        $allowed = $this->getAllowedExtensions($type);

        if ($allowed) $uploader->setAllowedExtensions($allowed);
        
        $uploader->setAllowRenameFiles(true);
        $uploader->setFilesDispersion(false);
        $result = $uploader->save($targetPath);
 
        if (!$result)
        {
            throw new \Magento\Framework\Exception\LocalizedException(__('We can\'t upload the file right now.'));
        }
 
        /**
         * Change Start
         */
        if (strtolower($uploader->getFileExtension()) !== 'pdf') {
            // Create Thumbnail
            $this->resizeFile($targetPath . '/' . $uploader->getUploadedFileName(), true);
        }
 
        $result['cookie'] = [
            'name' => $this->getSession()->getName(),
            'value' => $this->getSession()->getSessionId(),
            'lifetime' => $this->getSession()->getCookieLifetime(),
            'path' => $this->getSession()->getCookiePath(),
            'domain' => $this->getSession()->getCookieDomain(),
        ];
 
        return $result;
    }

    /**
     * Thumbnail URL getter
     *
     * @param  string $filePath original file path
     * @param  bool $checkFile OPTIONAL is it necessary to check file availability
     * @return string|false
     */
    public function getThumbnailUrl($filePath, $checkFile = false)
    {
        $mediaRootDir = $this->_cmsWysiwygImages->getStorageRoot();

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        if (strtolower($fileExtension) === 'pdf') {
            return $this->_assetRepo->getUrlWithParams('Ktpl_WageWysiwyg::images/pdf.svg', []);
        }

        if (strpos($filePath, $mediaRootDir) === 0)
        {
            $thumbSuffix = self::THUMBS_DIRECTORY_NAME . substr($filePath, strlen($mediaRootDir));

            if (!$checkFile || $this->_directory->isExist($this->_directory->getRelativePath($mediaRootDir . '/' . $thumbSuffix)))
            {                   
                $thumbSuffix = substr(
                    $mediaRootDir,
                    strlen($this->_directory->getAbsolutePath())
                ) . '/' . $thumbSuffix;

                $randomIndex = '?rand=' . time();

                return str_replace('\\', '/', $this->_cmsWysiwygImages->getBaseUrl() . $thumbSuffix) . $randomIndex;
            }
        }

        return false;
    }
}
