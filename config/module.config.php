<?php
namespace Midnight\RedirectModule;

return array(
    'service_manager' => array(
        'factories' => array(
            __NAMESPACE__ . '\Service\Redirector' => __NAMESPACE__ . '\Service\RedirectorFactory',
            __NAMESPACE__ . '\Storage' => __NAMESPACE__ . '\Storage\StorageFactory',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => array(dirname(__DIR__) . '/mapping'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Redirect' => __NAMESPACE__,
                ),
            ),
        ),
    ),
);