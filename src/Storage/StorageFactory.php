<?php

namespace Midnight\RedirectModule\Storage;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StorageFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new DoctrineOptions();
        $objectManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $options->setObjectManager($objectManager);
        return new Doctrine($options);
    }
}