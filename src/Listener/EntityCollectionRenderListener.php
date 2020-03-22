<?php

namespace TBoxHalEntityCollectionRender\Listener;

use Zend\EventManager\Event;

class EntityCollectionRenderListener
{
    
    public function getEntityPost(Event $Event)
    {
        $entity = $Event->getParam('entity');
        if ($entity instanceof \Zf\Hal\Collection) {
            if ($entity->getCollection()->getTotalItemCount()) {
                $entity->setPageSize($entity->getCollection()->getTotalItemCount());
            }
        }
    }
}
