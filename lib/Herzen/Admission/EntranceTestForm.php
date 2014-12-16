<?php

namespace Herzen\Admission;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="abit_entrance_test_forms")
 */
class EntranceTestForm {

    /**
     * @var integer
     *
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;


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
     *
     * @return EntranceTestForm
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
}
