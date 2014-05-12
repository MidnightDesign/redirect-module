<?php

namespace Midnight\RedirectModule;

use Midnight\RedirectModule\Service\Redirector;
use Zend\EventManager\EventInterface;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include dirname(__DIR__) . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Callback method for dispatch and dispatch.error events.
     *
     * @param MvcEvent $event
     */
    public function onDispatch(MvcEvent $event)
    {
        /* @var $response \Zend\Http\Response */
        $response = $event->getResponse();
        if (!method_exists($response, 'getStatusCode') || $response->getStatusCode() !== 404) {
            return;
        }
        $request        = $event->getRequest();
        if(!$request instanceof Request) {
            return;
        }
        $serviceManager = $event->getApplication()->getServiceManager();
        /** @var $redirector Redirector */
        $redirector   = $serviceManager->get(__NAMESPACE__ . '\Service\Redirector');

        $destination = $redirector->getDestination($request);
        if (!$destination) {
            return;
        }

        $redirector->redirect($response, $destination);
    }

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $event)
    {
        // Attach for dispatch, and dispatch.error (with low priority to make sure statusCode gets set)
        /* @var $eventManager \Zend\EventManager\EventManagerInterface */
        $eventManager = $event->getTarget()->getEventManager();
        $callback     = array($this, 'onDispatch');
        $priority     = -9999999;
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, $callback, $priority);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, $callback, $priority);
    }
}
