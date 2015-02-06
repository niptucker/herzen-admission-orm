<?php

namespace Herzen\Admission\Orm;

/**
* @Entity
* @Table(name="abit_eduprograms")
*/
class EducationalProgram {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer",name="id")
    */
    protected $id;


    /**
     * @var string
     *
     * @Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @Column(name="description", type="text", length=65535, nullable=false)
     */
    protected $description;

    /**
     * @var string
     *
     * @Column(name="url", type="string", length=1024, nullable=false)
     */
    protected $url;


    /**
    * @OneToMany(targetEntity="EntranceTest", mappedBy="educationalProgram")
    */
    protected $entranceTests;



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
     * Set title
     *
     * @param string $title
     *
     * @return EducationalProgram
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return EducationalProgram
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return EducationalProgram
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entranceTests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entranceTest
     *
     * @param EntranceTest $entranceTest
     *
     * @return EducationalProgram
     */
    public function addEntranceTest(EntranceTest $entranceTest)
    {
        $this->entranceTests[] = $entranceTest;

        return $this;
    }

    /**
     * Remove entranceTest
     *
     * @param EntranceTest $entranceTest
     */
    public function removeEntranceTest(EntranceTest $entranceTest)
    {
        $this->entranceTests->removeElement($entranceTest);
    }

    /**
     * Get entranceTests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntranceTests()
    {
        return $this->entranceTests;
    }
}
