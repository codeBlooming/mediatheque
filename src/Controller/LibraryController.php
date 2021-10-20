<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Reservation;
use App\Entity\User;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;


class LibraryController extends AbstractController
{
    /**
     * @Route("/library", name="library")
     */
    public function index(BookRepository $bookRepository): Response
    {
        $user = $this->getUser();

        if(!$user->getUserValidated())
        {
            return $this->render('home/userUnValidated.html.twig',  []);
        }

        return $this->render('library/index.html.twig', [
            'books' => $bookRepository->findAll()
        ]);
    }

    /**
     * @Route("/borrow", name="borrow")
     * @IsGranted("ROLE_USER")
     */
    public function borrow(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        return $this->render('library/borrowed.html.twig', [
            'reservations' => $reservationRepository->findBy(['user'=>$user])
        ]);
    }

    /* *
     * @Route("/library/add", name="addBook", methods={"GET", "POST"})
     * @IsGranted("ROLE_EMPLOYEE")
     * /
    public function addBook(Request $request, EntityManagerInterface $manager):Response
    {
        $book = new Book();

         $form = $this->createForm(BookType::class, $book);

         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid())
         {
             $manager->persist($book);
             $manager->flush();
             return $this->redirectToRoute('editBook', ['id' => $book->getId()]);
         }
         return $this->render('library/add.html.twig', [
             'formBook' => $form->createView()
         ]);
    }*/

    /**
     * @Route("/library/{id}", name="editBook")
     */
    public function show(Book $book): Response
    {
        return $this->render('library/edit.html.twig', [
            'book' => $book
        ]);
    }


    /**
     * Permet de reserver un livre
     *
     * @Route("/library/{id}/reserve", name="reserveBook")
     *
     * @param Book $book
     * @param EntityManagerInterface $manager
     * @param ReservationRepository $reservationRepository
     * @return Response
     */
    public function reserveBook(Book $book, EntityManagerInterface $manager, ReservationRepository $reservationRepository) : Response
    {
        $user = $this->getUser();

        if(!$user) return $this->json([
            'code' => 403,
            'message' => "Non autorisé"
            ], 403);

       // if($book->isReservedByUser($user)) {
        $resa = $reservationRepository->findOneBy([
            'book' => $book,
            'user' => $user
        ]);
        if($resa) {

            $manager->remove($resa);
            $book->setIsReserved(false);
            $manager->flush();

            return $this->json([
                'code'=>200,
                'isReserved'=>false,
                'message'=>'Réservation annulée'
            ], 200);
        }

        $reservation = new Reservation();
        $reservation->setBook($book)
            ->setUser($user)
            ->setReservedDate(new \DateTime('now'));
        $manager->persist($reservation);

        $book->setIsReserved(true);

        $manager->flush();

        return $this->json([
            'code'=>200,
            'isReserved'=>true,
            'message' => 'Réservation effectuée, merci de venir chercher votre livre'
        ], 200);
    }
}
