<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blutkrankheit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Blutkrankheit
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
     * @ORM\Column(name="mortality", type="integer")
     */
    private $mortality;


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
     * @return Blutkrankheit
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
     * Set mortality
     *
     * @param integer $mortality
     * @return Blutkrankheit
     */
    public function setMortality($mortality)
    {
        $this->mortality = $mortality;

        return $this;
    }

    /**
     * Get mortality
     *
     * @return integer 
     */
    public function getMortality()
    {
        return $this->mortality;
    }
}
