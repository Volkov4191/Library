<?php

namespace StorageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Отношение авторов и их книг
 *
 * @ORM\Entity()
 * @ORM\Table(name="book_author")
 *
 * @package StorageBundle\Entity
 */
class BookAuthor
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="bookAuthors")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="bookAuthors")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;

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
     * Set book
     *
     * @param \StorageBundle\Entity\Book $book
     *
     * @return BookAuthor
     */
    public function setBook(\StorageBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \StorageBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set author
     *
     * @param \StorageBundle\Entity\Author $author
     *
     * @return BookAuthor
     */
    public function setAuthor(\StorageBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \StorageBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
