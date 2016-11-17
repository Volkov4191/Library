<?php

namespace StorageBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups as Groups;

/**
 * Библиотека, в конкретном городе
 *
 * Class Library
 *
 * @ORM\Entity(repositoryClass="StorageBundle\Repository\Library")
 * @ORM\Table(name="library")
 *
 * @package StorageBundle\Entity
 */
class Library
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="libraries")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="LibraryUser", mappedBy="library", cascade={"persist"})
     * @var ArrayCollection
     */
    private $libraryUsers;

    /**
     * Get id
     *
     * @Groups({"Default"})
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set city
     *
     * @param \StorageBundle\Entity\City $city
     *
     * @return Library
     */
    public function setCity(\StorageBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @Groups({"Default"})
     *
     * @return \StorageBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Library
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @Groups({"Default"})
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->libraryUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add libraryUser
     *
     * @param \StorageBundle\Entity\LibraryUser $libraryUser
     *
     * @return Library
     */
    public function addLibraryUser(\StorageBundle\Entity\LibraryUser $libraryUser)
    {
        $this->libraryUsers[] = $libraryUser;

        return $this;
    }

    /**
     * Remove libraryUser
     *
     * @param \StorageBundle\Entity\LibraryUser $libraryUser
     */
    public function removeLibraryUser(\StorageBundle\Entity\LibraryUser $libraryUser)
    {
        $this->libraryUsers->removeElement($libraryUser);
    }

    /**
     * Get libraryUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLibraryUsers()
    {
        return $this->libraryUsers;
    }
}
