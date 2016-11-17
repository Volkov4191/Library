<?php

namespace StorageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups as Groups;

/**
 * Город, в котором располагаются бибилиотеки
 *
 * Class City
 *
 * @ORM\Entity
 * @ORM\Table(name="city")
 *
 * @package StorageBundle\Entity
 */
class City
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

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
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @Groups({"Default"})
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
