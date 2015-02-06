<?php

namespace Herzen\Admission\Orm;

/**
* @Entity
* @Table(name="abit_abiteducompgroup")
*/
class CompetitiveGroup {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer",name="id")
    */
    protected $id;

    /**
    * @Column(type="integer",name="receptionYear")
    */
    protected $receptionYear;

    /**
     * @var boolean
     *
     * @Column(name="isActive", type="boolean", nullable=false)
     */
    protected $isActive;

    /**
    * @ManyToOne(targetEntity="EducationalProgram",fetch="LAZY")
    * @JoinColumn(name="ref_abit_eduprograms",referencedColumnName="id")
    */
    protected $educationalProgram;

    /**
    * @ManyToOne(targetEntity="Faculty",fetch="LAZY")
    * @JoinColumn(name="ref_abit_faculties",referencedColumnName="id")
    */
    protected $faculty;


    /**************************************************************************/
    /* METHODS                                                                */
    /**************************************************************************/




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
     * Set receptionYear
     *
     * @param integer $receptionYear
     *
     * @return CompetitiveGroup
     */
    public function setReceptionYear($receptionYear)
    {
        $this->receptionYear = $receptionYear;

        return $this;
    }

    /**
     * Get receptionYear
     *
     * @return integer
     */
    public function getReceptionYear()
    {
        return $this->receptionYear;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return CompetitiveGroup
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set educationalProgram
     *
     * @param EducationalProgram $educationalProgram
     *
     * @return CompetitiveGroup
     */
    public function setEducationalProgram(EducationalProgram $educationalProgram = null)
    {
        $this->educationalProgram = $educationalProgram;

        return $this;
    }

    /**
     * Get educationalProgram
     *
     * @return EducationalProgram
     */
    public function getEducationalProgram()
    {
        return $this->educationalProgram;
    }

    /**
     * Set faculty
     *
     * @param \Herzen\Admission\Faculty $faculty
     *
     * @return CompetitiveGroup
     */
    public function setFaculty(\Herzen\Admission\Faculty $faculty = null)
    {
        $this->faculty = $faculty;

        return $this;
    }

    /**
     * Get faculty
     *
     * @return \Herzen\Admission\Faculty
     */
    public function getFaculty()
    {
        return $this->faculty;
    }
}
