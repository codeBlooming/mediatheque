<?php

namespace App\EventSubscriber;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setBorrowedBook'],
            BeforeEntityDeletedEvent::class=>['unSetBorrowedBook']
        ];
    }


    public function setBorrowedBook(BeforeEntityUpdatedEvent $event )
    {
        $reservation = $event->getEntityInstance();

        if(!($reservation instanceof Reservation))
        {
            return;
        }
        $now = new \DateTime('now');

        if($reservation->getBook()->getIsBorrowed())
        {
            if(is_null($reservation->getBorrowedDate()))
            {
                $reservation->setBorrowedDate($now);
            }
        }else
        {
            $reservation->deleteBorrowedDate();
        }
    }

    public function unSetBorrowedBook (BeforeEntityDeletedEvent $event)
    {
        $reservation = $event->getEntityInstance();
        if(!($reservation instanceof Reservation))
        {
            return;
        }
        $reservation->getBook()->setIsBorrowed(false);
        $reservation->getBook()->setIsReserved(false);
        $reservation->deleteBorrowedDate();
    }

}