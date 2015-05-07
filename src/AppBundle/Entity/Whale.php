<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Whale
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Whale
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="feet", type="integer")
     */
    private $feet;


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
     * Set name
     *
     * @param string $name
     * @return Whale
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set feet
     *
     * @param integer $feet
     * @return Whale
     */
    public function setFeet($feet)
    {
        $this->feet = $feet;

        return $this;
    }

    /**
     * Get feet
     *
     * @return integer 
     */
    public function getFeet()
    {
        return $this->feet;
    }
}
