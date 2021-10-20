<?php

namespace App\Entity;

use App\Repository\BookRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\Column(type="date")
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isReserved;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isBorrowed;




    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, mappedBy="book", cascade={"persist", "remove"})
     */
    private $reservation;


    public function __construct()
    {
        $this->isReserved = false;
        $this->isBorrowed = false;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getIsReserved(): ?Bool
    {
        return $this->isReserved;
    }

    public function setIsReserved($isReserved): self
    {
        $this->isReserved = $isReserved;
        return $this;
    }

    public function getIsBorrowed(): ?Bool
    {
        return $this->isBorrowed;
    }

    public function setIsBorrowed($isBorrowed): self
    {
        $this->isBorrowed = $isBorrowed;
        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        // set the owning side of the relation if necessary
        if ($reservation->getBook() !== $this) {
            $reservation->setBook($this);
        }

        $this->reservation = $reservation;

        return $this;
    }

    /* *
     * Savoir si un user à réserver ce livre
     * @param User $user
     * @return bool
     * /
    public function isReservedByUser(User $user):bool
    {

        if( $this->getReservation()->getUser() === $user )
        {
            return true;
        }

        return false;
    }*/
}
