<?php


namespace StorageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

use Symfony\Component\Serializer\Annotation\Groups as Groups;

/**
 * Описание экзепляра книги в определенной библиотеке
 *
 * @ORM\Entity()
 * @ORM\Table(name="library_book",
 *  uniqueConstraints={@UniqueConstraint(name="library_book_number_unique",columns={"library_id", "number",})}
 * )
 *
 * Class LibraryBook
 * @package StorageBundle\Entity
 */
class LibraryBook
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="libraryBooks")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="Library", inversedBy="libraryBooks")
     * @ORM\JoinColumn(name="library_id", referencedColumnName="id", nullable=false)
     */
    private $library;

    /**
     * Инвентарный номер книги. В каждой библиотеке должны быть свои уникальные неповторяющиеся инвентарные номера
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $number;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return LibraryBook
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set book
     *
     * @param \StorageBundle\Entity\Book $book
     *
     * @return LibraryBook
     */
    public function setBook(\StorageBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @Groups({"Default"})
     *
     * @return \StorageBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set library
     *
     * @param \StorageBundle\Entity\Library $library
     *
     * @return LibraryBook
     */
    public function setLibrary(\StorageBundle\Entity\Library $library = null)
    {
        $this->library = $library;

        return $this;
    }

    /**
     * Get library
     *
     * @return \StorageBundle\Entity\Library
     */
    public function getLibrary()
    {
        return $this->library;
    }
}
