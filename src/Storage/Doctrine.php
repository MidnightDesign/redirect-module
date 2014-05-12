<?php

namespace Midnight\RedirectModule\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Midnight\RedirectModule\Redirect;

class Doctrine implements StorageInterface
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param DoctrineOptions $options
     */
    function __construct(DoctrineOptions $options)
    {
        $this->objectManager = $options->getObjectManager();
    }

    /**
     * @param string $from
     *
     * @return string
     */
    public function getTo($from)
    {
        /** @var $redirect Redirect */
        $redirect = $this->objectManager->getRepository('Midnight\RedirectModule\Redirect')->findOneBy(array('from' => $from));
        if (!$redirect) {
            return null;
        }
        return $redirect->getTo();
    }

    /**
     * @param string $from
     * @param string $to
     *
     * @return void
     */
    public function create($from, $to)
    {
        $redirect = new Redirect();
        $redirect->setFrom($from);
        $redirect->setTo($to);
        $objectManager = $this->objectManager;
        $objectManager->persist($redirect);
        $objectManager->flush();
    }
}