<?php

namespace Midnight\RedirectModule\Service;

use Midnight\RedirectModule\Storage\StorageInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RedirectorFactory implements FactoryInterface
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
        $storage = $serviceLocator->get('Redirect\Storage');
        if (!$storage instanceof StorageInterface) {
            throw new \RuntimeException(sprintf('Expected to get an instance of Redirect\Storager\StorageInterface from the service manager. Got %s.', get_class($storage)));
        }
        return new Redirector($storage);
    }
}