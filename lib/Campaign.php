<?php

namespace Herzen\Admission\Orm;

use Herzen\Enrollment\EnrollmentInterface;

/**
 * Admission Campaign
 *
 * @Table(name="abit_campaigns")
 * @Entity
 */
class Campaign {

    /**
     * @var integer
     *
     * @Id
     * @Column(name="id", type="integer", nullable=false)
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=200, nullable=false)
     */
    protected $name;

    /**
     * @var \DateTime
     *
     * @Column(name="year", type="date", nullable=true)
     */
    protected $year;

    /**
    * @OneToMany(targetEntity="CompetitiveGroup", mappedBy="campaign")
    */
    protected $competitiveGroups;


    protected function __construct() {
        $this->competitiveGroups = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Campaign
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
     * Set year
     *
     * @param \DateTime $year
     *
     * @return Campaign
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Add competitiveGroup
     *
     * @param \Herzen\Admission\Orm\CompetitiveGroup $competitiveGroup
     *
     * @return Campaign
     */
    public function addCompetitiveGroup(\Herzen\Admission\Orm\CompetitiveGroup $competitiveGroup)
    {
        $this->competitiveGroups[] = $competitiveGroup;

        return $this;
    }

    /**
     * Remove competitiveGroup
     *
     * @param \Herzen\Admission\Orm\CompetitiveGroup $competitiveGroup
     */
    public function removeCompetitiveGroup(\Herzen\Admission\Orm\CompetitiveGroup $competitiveGroup)
    {
        $this->competitiveGroups->removeElement($competitiveGroup);
    }

    /**
     * Get competitiveGroups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitiveGroups()
    {
        return $this->competitiveGroups;
    }
}
