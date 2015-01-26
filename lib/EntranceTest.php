<?php

namespace Herzen\Admission\Orm;

/**
* @Entity
* @Table(name="abit_eduprograms_entrance_tests_links")
*/
class EntranceTest {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer", name="id")
    */
    protected $id;

    /**
    * @ManyToOne(targetEntity="EducationalProgram", fetch="LAZY")
    * @JoinColumn(name="ref_abit_eduprograms", referencedColumnName="id")
    */
    protected $educationalProgram;

    /**
    * @ManyToOne(targetEntity="EntranceTestSubject", fetch="LAZY")
    * @JoinColumn(name="ref_abit_entrance_tests", referencedColumnName="id")
    */
    protected $entranceTestSubject;

    /**
    * @ManyToOne(targetEntity="EntranceTestForm", fetch="LAZY")
    * @JoinColumn(name="ref_abit_entrance_test_forms", referencedColumnName="id")
    */
    protected $entranceTestForm;


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
     * Set educationalProgram
     *
     * @param EducationalProgram $educationalProgram
     *
     * @return EntranceTest
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
     * Set entranceTestSubject
     *
     * @param EntranceTestSubject $entranceTestSubject
     *
     * @return EntranceTest
     */
    public function setEntranceTestSubject(EntranceTestSubject $entranceTestSubject = null)
    {
        $this->entranceTestSubject = $entranceTestSubject;

        return $this;
    }

    /**
     * Get entranceTestSubject
     *
     * @return EntranceTestSubject
     */
    public function getEntranceTestSubject()
    {
        return $this->entranceTestSubject;
    }

    /**
     * Set entranceTestForm
     *
     * @param EntranceTestForm $entranceTestForm
     *
     * @return EntranceTest
     */
    public function setEntranceTestForm(EntranceTestForm $entranceTestForm = null)
    {
        $this->entranceTestForm = $entranceTestForm;

        return $this;
    }

    /**
     * Get entranceTestForm
     *
     * @return EntranceTestForm
     */
    public function getEntranceTestForm()
    {
        return $this->entranceTestForm;
    }
}
