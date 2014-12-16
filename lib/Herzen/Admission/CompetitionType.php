<?php

namespace Herzen\Admission;

use Doctrine\ORM\Mapping as ORM;

/**
* @Entity
* @Table(name="abit_competition_type")
*/
class CompetitionType {

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
    private $name;

    /**
     * @var string
     *
     * @Column(name="shortname", type="string", length=50, nullable=false)
     */
    private $shortname;

    /**
     * @var boolean
     *
     * @Column(name="is_vocational", type="boolean", nullable=false)
     */
    private $isVocational;

    /**
     * @var boolean
     *
     * @Column(name="is_crimean", type="boolean", nullable=false)
     */
    private $isCrimean;

    /**
     * @var string
     *
     * @Column(name="abbr", type="string", length=50, nullable=false)
     */
    private $abbr;


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
     * @return CompetitionType
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
     * Set shortname
     *
     * @param string $shortname
     *
     * @return CompetitionType
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set isVocational
     *
     * @param boolean $isVocational
     *
     * @return CompetitionType
     */
    public function setIsVocational($isVocational)
    {
        $this->isVocational = $isVocational;

        return $this;
    }

    /**
     * Get isVocational
     *
     * @return boolean
     */
    public function getIsVocational()
    {
        return $this->isVocational;
    }

    /**
     * Set isCrimean
     *
     * @param boolean $isCrimean
     *
     * @return CompetitionType
     */
    public function setIsCrimean($isCrimean)
    {
        $this->isCrimean = $isCrimean;

        return $this;
    }

    /**
     * Get isCrimean
     *
     * @return boolean
     */
    public function getIsCrimean()
    {
        return $this->isCrimean;
    }

    /**
     * Set abbr
     *
     * @param string $abbr
     *
     * @return CompetitionType
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }
}
