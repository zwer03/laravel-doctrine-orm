<?php

namespace App\Listeners;

use App\Entities\Scientist;
use Doctrine\ORM\Event\OnFlushEventArgs;

class ScientistListener
{
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Scientist) {
                $entity->setLastname(strtoupper($entity->getLastname()));
                $meta = $em->getClassMetadata(Scientist::class);
                $uow->recomputeSingleEntityChangeSet($meta, $entity);
            }
        }

        // foreach ($uow->getScheduledEntityUpdates() AS $entity) {

        // }

        // foreach ($uow->getScheduledEntityDeletions() AS $entity) {

        // }

        // foreach ($uow->getScheduledCollectionDeletions() AS $col) {

        // }

        // foreach ($uow->getScheduledCollectionUpdates() AS $col) {

        // }
    }
}
