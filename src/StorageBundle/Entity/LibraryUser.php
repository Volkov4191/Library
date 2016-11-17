<?php

namespace StorageBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups as Groups;

/**
 * Абонименты библиотек
 *
 * @ORM\Entity()
 * @ORM\Table(name="library_user")
 *
 * Class LibraryUser
 * @package StorageBundle\Entity
 */
class LibraryUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="libraryUsers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Library", inversedBy="libraryUsers")
     * @ORM\JoinColumn(name="library_id", referencedColumnName="id", nullable=false)
     */
    private $library;

    /**
     * @ORM\OneToMany(targetEntity="Rent", mappedBy="libraryUser", cascade={"persist"})
     * @var ArrayCollection
     */
    private $rents;

    /**
     * Get id
     *
     * @return integer
     * @Groups({"Default"})
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \StorageBundle\Entity\User $user
     *
     * @return LibraryUser
     */
    public function setUser(\StorageBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @Groups({"Default"})
     * @return \StorageBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set library
     *
     * @param \StorageBundle\Entity\Library $library
     *
     * @return LibraryUser
     */
    public function setLibrary(\StorageBundle\Entity\Library $library)
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rent
     *
     * @param \StorageBundle\Entity\Rent $rent
     *
     * @return LibraryUser
     */
    public function addRent(\StorageBundle\Entity\Rent $rent)
    {
        $this->rents[] = $rent;

        return $this;
    }

    /**
     * Remove rent
     *
     * @param \StorageBundle\Entity\Rent $rent
     */
    public function removeRent(\StorageBundle\Entity\Rent $rent)
    {
        $this->rents->removeElement($rent);
    }

    /**
     * Get rents
     *
     * @return Rent[]
     */
    public function getRents()
    {
        return $this->rents;
    }
}
