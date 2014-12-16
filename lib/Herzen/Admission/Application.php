<?php

namespace Herzen\Admission;

use Doctrine\ORM\Mapping as ORM;

/**
* @Entity
* @Table(name="abit_entrant")
*/
class Application {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer",name="id")
    */
    protected $id;

    /**
    * @Column(type="integer",name="ref_abit_eabitstate")
    */
    protected $status;

    /**
    * @Column(type="datetime",name="inputdate")
    */
    protected $signingDate;

    /**
    * @Column(type="integer",name="scoresum")
    */
    protected $pointsTotal;

    /**
    * @Column(type="boolean",name="is_original")
    */
    protected $original;

    /**
    * @Column(type="integer",name="ref_abit_competition_type")
    */
    protected $competitionType;

    /**
    * @OneToOne(targetEntity="CompetitiveGroup",fetch="LAZY")
    * @JoinColumn(name="ref_abit_abiteducompgroup",referencedColumnName="id")
    */
    protected $competitiveGroup;

    /**
    * @OneToOne(targetEntity="Entrant",fetch="LAZY")
    * @JoinColumn(name="ref_abit_abiturients",referencedColumnName="id")
    */
    protected $entrant;

    /**
     * Set status
     *
     * @param integer $status
     * @return Application
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Application
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set signingDate
     *
     * @param \DateTime $signingDate
     * @return Application
     */
    public function setSigningDate($signingDate)
    {
        $this->signingDate = $signingDate;

        return $this;
    }

    /**
     * Get signingDate
     *
     * @return \DateTime
     */
    public function getSigningDate()
    {
        return $this->signingDate;
    }

    /**
     * Set entrant
     *
     * @param integer $entrant
     * @return Application
     */
    public function setEntrant($entrant)
    {
        $this->entrant = $entrant;

        return $this;
    }

    /**
     * Get entrant
     *
     * @return integer
     */
    public function getEntrant()
    {
        return $this->entrant;
    }

    /**
     * Set pointsTotal
     *
     * @param integer $pointsTotal
     * @return Application
     */
    public function setPointsTotal($pointsTotal)
    {
        $this->pointsTotal = $pointsTotal;

        return $this;
    }

    /**
     * Get pointsTotal
     *
     * @return integer
     */
    public function getPointsTotal()
    {
        return $this->pointsTotal;
    }

    /**
     * Set original
     *
     * @param boolean $original
     * @return Application
     */
    public function setOriginal($original)
    {
        $this->original = $original;

        return $this;
    }

    /**
     * Get original
     *
     * @return boolean
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Set competitionType
     *
     * @param \int $competitionType
     * @return Application
     */
    public function setCompetitionType(\int $competitionType)
    {
        $this->competitionType = $competitionType;

        return $this;
    }

    /**
     * Get competitionType
     *
     * @return \int
     */
    public function getCompetitionType()
    {
        return $this->competitionType;
    }

    /**
     * Set competitiveGroup
     *
     * @param CompetitiveGroup $competitiveGroup
     * @return Application
     */
    public function setCompetitiveGroup(\int $competitiveGroup)
    {
        $this->competitiveGroup = $competitiveGroup;

        return $this;
    }

    /**
     * Get competitiveGroup
     *
     * @return CompetitiveGroup
     */
    public function getCompetitiveGroup()
    {
        return $this->competitiveGroup;
    }
}
