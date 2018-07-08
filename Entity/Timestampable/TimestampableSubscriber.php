<?php

namespace App\Doctrine\EventSubscriber;

use App\Entity\TimestampableInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use DateTime;

/**
 * Class TimestampableSubscriber
 * @package App\Doctrine\EventSubscriber
 */
class TimestampableSubscriber implements EventSubscriber
{
    /**
     * @inheritdoc
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if ($entity instanceof TimestampableInterface) {
            if (!$entity->getCreated()) {
                $entity->setCreated(new DateTime());
            }

            if (!$entity->getUpdated()) {
                $entity->setUpdated(new DateTime());
            }
        }
    }

    /**
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate(PreUpdateEventArgs $event)
    {
        $entity = $event->getEntity();

        if ($entity instanceof TimestampableInterface) {
            if (!$entity->getUpdated()) {
                $entity->setUpdated(new DateTime());
            }
        }
    }
}
