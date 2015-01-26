<?php

namespace Herzen\Admission\Orm;

/**
* @Entity
* @Table(name="abit_abiturients")
*/
class Entrant implements UniversallyUniqueIdentifiable {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer",name="id")
    */
    protected $id;

    /**
    * @Column(type="string",length=255,name="lastname")
    */
    protected $lastname;

    /**
    * @Column(type="string",length=255,name="firstname")
    */
    protected $firstname;

    /**
    * @Column(type="string",length=255,name="patronymic")
    */
    protected $patronymic;

    /**
    * @Column(type="string",length=50,name="passport_series")
    */
    protected $identityDocumentSeries;

    /**
    * @Column(type="string",length=50,name="passport_num")
    */
    protected $identityDocumentNumber;

    /**
    * @Column(type="datetime",name="reg_datetime")
    */
    protected $registrationDate;

    /**
     * @Column(name="user_uuid", type="string", length=36, nullable=true)
     */
    protected $uuid;


    /**
    * @OneToMany(targetEntity="Application",mappedBy="entrant")
    */
    protected $applications;

    public function getFIO() {
        return trim($this->getLastname()." ".$this->getFirstname()." ".$this->getPatronymic());
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
     * Set lastname
     *
     * @param string $lastname
     * @return Entrant
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Entrant
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set patronymic
     *
     * @param string $patronymic
     * @return Entrant
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    /**
     * Get patronymic
     *
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->applications = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add applications
     *
     * @param Application $applications
     * @return Entrant
     */
    public function addApplication(Application $applications)
    {
        $this->applications[] = $applications;

        return $this;
    }

    /**
     * Remove applications
     *
     * @param Application $applications
     */
    public function removeApplication(Application $applications)
    {
        $this->applications->removeElement($applications);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Set identityDocumentNumber
     *
     * @param string $identityDocumentNumber
     * @return Entrant
     */
    public function setIdentityDocumentNumber($identityDocumentNumber)
    {
        $this->identityDocumentNumber = $identityDocumentNumber;

        return $this;
    }

    /**
     * Get identityDocumentNumber
     *
     * @return string
     */
    public function getIdentityDocumentNumber()
    {
        return $this->identityDocumentNumber;
    }

    /**
     * Set identityDocumentSeries
     *
     * @param string $identityDocumentSeries
     * @return Entrant
     */
    public function setIdentityDocumentSeries($identityDocumentSeries)
    {
        $this->identityDocumentSeries = $identityDocumentSeries;

        return $this;
    }

    /**
     * Get identityDocumentSeries
     *
     * @return string
     */
    public function getIdentityDocumentSeries()
    {
        return $this->identityDocumentSeries;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->signingDate;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     *
     * @return Entrant
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Entrant
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

}
