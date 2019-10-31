<?php

/**
 * Encryptor / Decryptor functionality
 */

namespace Practice\Test\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

use Magento\Framework\Encryption\EncryptorInterface;

class Decryptor extends Action
{
    const PASSWORDSTRING = 'admin@01';

    protected $encryptor;

    public function __construct(
        Context $context,
        EncryptorInterface $encryptor
    )
    {
        $this->encryptor = $encryptor;

        return parent::__construct($context);
    }

    public function execute()
    {
        $encryptedString = $this->encryptor->encrypt(Decryptor::PASSWORDSTRING);
        echo "Encrypted = ".$encryptedString."<br >";

        $decryptedString = $this->encryptor->decrypt($encryptedString);
        echo "Decrypted = ".$decryptedString."<br >";

        //$decryptedString = 'Decrypted = '.$this->encryptor->decrypt(self::PASSWORDSTRING);
        //return $this->resultFactory->create(ResultFactory::TYPE_RAW)->setContents($decryptedString);
    }
}
