<?php

namespace Midnight\RedirectModule\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Zend\Stdlib\AbstractOptions;

class DoctrineOptions extends AbstractOptions
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }

    /**
     * @param ObjectManager $repository
     */
    public function setObjectManager($repository)
    {
        $this->objectManager = $repository;
    }
}