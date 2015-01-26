<?php

namespace Herzen\Admission\Orm;

/**
* @Entity
* @Table(name="abit_faculties")
*/
class Faculty {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer",name="id")
    */
    protected $id;

    /**
     * Faculty code
     * @var integer
     *
     * @Column(name="code", type="integer", nullable=true)
     */
    protected $bookCode;

    /**
     * @var string
     *
     * @Column(name="faculty_name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @Column(name="genitiveCaseName", type="string", length=255, nullable=true)
     */
    protected $genitiveCaseName;

    /**
     * @var string
     *
     * @Column(name="dativeCaseName", type="string", length=255, nullable=true)
     */
    protected $dativeCaseName;

    /**
     * @var string
     *
     * @Column(name="accusativeCaseName", type="string", length=255, nullable=true)
     */
    protected $accusativeCaseName;

    /**
     * @var string
     *
     * @Column(name="accusativePreposition", type="string", length=255, nullable=true)
     */
    protected $accusativePreposition;

    /**
     * @var string
     *
     * @Column(name="shortName", type="string", length=255, nullable=true)
     */
    protected $shortName;

    /**
     * @var string
     *
     * @Column(name="DepartmentType", type="string", length=255, nullable=true)
     */
    // protected $type;

    /**
     * @var integer
     *
     * @Column(name="ref_abit_prorectors", type="integer", nullable=true)
     *
     * @ManyToOne(targetEntity="Prorector", fetch="LAZY")
     * @JoinColumn(name="ref_abit_prorectors", referencedColumnName="id")
     */
    // protected $prorector;

    /**
     * @var integer
     *
     * @Column(name="ref_abit_dean", type="integer", nullable=true)
     *
     * @ManyToOne(targetEntity="Dean", fetch="LAZY")
     * @JoinColumn(name="ref_abit_dean", referencedColumnName="id")
     */
    // private $dean;



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
     * Set bookCode
     *
     * @param integer $bookCode
     *
     * @return Faculty
     */
    public function setBookCode($bookCode)
    {
        $this->bookCode = $bookCode;

        return $this;
    }

    /**
     * Get bookCode
     *
     * @return integer
     */
    public function getBookCode()
    {
        return $this->bookCode;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Faculty
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
     * Set genitiveCaseName
     *
     * @param string $genitiveCaseName
     *
     * @return Faculty
     */
    public function setGenitiveCaseName($genitiveCaseName)
    {
        $this->genitiveCaseName = $genitiveCaseName;

        return $this;
    }

    /**
     * Get genitiveCaseName
     *
     * @return string
     */
    public function getGenitiveCaseName()
    {
        return $this->genitiveCaseName;
    }

    /**
     * Set dativeCaseName
     *
     * @param string $dativeCaseName
     *
     * @return Faculty
     */
    public function setDativeCaseName($dativeCaseName)
    {
        $this->dativeCaseName = $dativeCaseName;

        return $this;
    }

    /**
     * Get dativeCaseName
     *
     * @return string
     */
    public function getDativeCaseName()
    {
        return $this->dativeCaseName;
    }

    /**
     * Set accusativeCaseName
     *
     * @param string $accusativeCaseName
     *
     * @return Faculty
     */
    public function setAccusativeCaseName($accusativeCaseName)
    {
        $this->accusativeCaseName = $accusativeCaseName;

        return $this;
    }

    /**
     * Get accusativeCaseName
     *
     * @return string
     */
    public function getAccusativeCaseName()
    {
        return $this->accusativeCaseName;
    }

    /**
     * Set accusativePreposition
     *
     * @param string $accusativePreposition
     *
     * @return Faculty
     */
    public function setAccusativePreposition($accusativePreposition)
    {
        $this->accusativePreposition = $accusativePreposition;

        return $this;
    }

    /**
     * Get accusativePreposition
     *
     * @return string
     */
    public function getAccusativePreposition()
    {
        return $this->accusativePreposition;
    }

    /**
     * Set shortName
     *
     * @param string $shortName
     *
     * @return Faculty
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }
}
