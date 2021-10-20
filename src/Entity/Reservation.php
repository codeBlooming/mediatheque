<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Book::class, inversedBy="reservation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\Column(type="datetime")
     */
    private $reservedDate;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $borrowedDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(Book $book): self
    {
        $this->book = $book;

        return $this;
    }


    public function getReservedDate(): ?\DateTimeInterface
    {
        return $this->reservedDate;
    }

    public function setReservedDate(\DateTimeInterface $reservedDate): self
    {
        $this->reservedDate = $reservedDate;

        return $this;
    }


    public function getBorrowedDate(): ?\DateTimeInterface
    {
        return $this->borrowedDate;
    }

    public function setBorrowedDate(\DateTimeInterface $borrowedDate): self
    {

        $this->borrowedDate = $borrowedDate;

        return $this;
    }

    public function deleteBorrowedDate() : self
    {
        $this->borrowedDate = null;
        return $this;
    }
}
