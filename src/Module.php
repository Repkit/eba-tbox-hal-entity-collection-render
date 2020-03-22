<?php
namespace TBoxHalEntityCollectionRender;

use TBoxHalEntityCollectionRender\Listener\EntityCollectionRenderListener;

class Module
{
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

    public function onBootstrap(\Zend\Mvc\MvcEvent $E)
    {
        $sharedManager = $E->getApplication()->getEventManager()->getSharedManager();
        // perform attachments at get.post in order to override collection page size
        $sharedManager->attach(
            \ZF\Rest\RestController::class,
            'get.post', 
            array(
                new EntityCollectionRenderListener(),
                'getEntityPost'
            )
        );
    }
}
