<?php

namespace App\Listeners;

use App\Entities\Scientist;
use Illuminate\Support\Facades\Log;
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

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof Scientist) {
                $changeSet = $uow->getEntityChangeSet($entity);
                if (
                    isset($changeSet) &&
                    $changeSet['firstname'] &&
                    $changeSet['firstname'][0] !== $changeSet['firstname'][1]
                ) {
                    $id = $entity->getId();
                    Log::info('Scientist with id: ' . $id . ' has been updated its firstname');
                } else {
                    Log::info('Scientist has been updated');
                }
            }
        }

        // foreach ($uow->getScheduledEntityDeletions() AS $entity) {

        // }

        // foreach ($uow->getScheduledCollectionDeletions() AS $col) {

        // }

        // foreach ($uow->getScheduledCollectionUpdates() AS $col) {

        // }
    }
}
