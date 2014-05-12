<?php

namespace Midnight\RedirectModule\Service;

use Midnight\RedirectModule\Storage\StorageInterface;
use Zend\Cache\Storage\Adapter\Apc;
use Zend\Cache\Storage\Adapter\ApcOptions;
use Zend\Http\Request;
use Zend\Http\Response;

class Redirector
{
    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function getDestination(Request $request)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        $query = $uri->getQuery();
        $address = $path . ($query ? '?' . $query : '');
        $cached = $this->getCache()->getItem($address);
        if ($cached) {
            return $cached;
        }
        return $this->getStorage()->getTo($address);
    }

    /**
     * @return \Zend\Cache\Storage\StorageInterface
     */
    private function getCache()
    {
        return new Apc(new ApcOptions());
    }

    /**
     * @return StorageInterface
     */
    private function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param Response $response
     * @param string   $destination
     */
    public function redirect(Response $response, $destination)
    {
        $response
            ->setStatusCode(301)
            ->setReasonPhrase('Moved Permanently')
            ->getHeaders()
            ->addHeaderLine('Location: ' . $destination);
    }
} 