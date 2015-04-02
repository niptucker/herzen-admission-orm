<?php

namespace Herzen\Admission\Orm\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Herzen\Admission\Orm\Form\ScenarioFormField;

/**
* @Entity
* @Table(name="abit_scenario")
*/
class Scenario {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer", name="id")
    */
    protected $id;

    /**
    * @Column(type="string", length=255, name="name")
    */
    protected $name;

    /**
    * @Column(type="string", length=500, name="description")
    */
    protected $description;

    /**
     * @ManyToMany(targetEntity="ScenarioFormField")
     * @JoinTable(name="abit_scenario_form_field",
     *     joinColumns={@JoinColumn(name="ref_abit_scenario", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="ref_abit_form_field", referencedColumnName="id")}
     * )
     */
    protected $scenarioFormFields;

    /**
     * @Column(type="boolean", name="is_foreign", nullable=false)
     */
    protected $isForeign;

    /**
     * @Column(type="boolean", name="is_magister", nullable=false)
     */
    protected $isMagister;

    /**
     * @Column(type="boolean", name="is_transfer", nullable=false)
     */
    protected $isTransfer;

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
     * @return Entrant
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
     * Constructor
     */
    public function __construct()
    {
        $this->scenarioFormFields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add scenarioFormField
     *
     * @param \Herzen\Admission\Orm\Form\ScenarioFormField $scenarioFormField
     *
     * @return Scenario
     */
    public function addScenarioFormField(\Herzen\Admission\Orm\Form\ScenarioFormField $scenarioFormField)
    {
        $this->scenarioFormFields[] = $scenarioFormField;

        return $this;
    }

    /**
     * Remove scenarioFormField
     *
     * @param \Herzen\Admission\Orm\Form\ScenarioFormField $scenarioFormField
     */
    public function removeScenarioFormField(\Herzen\Admission\Orm\Form\ScenarioFormField $scenarioFormField)
    {
        $this->scenarioFormFields->removeElement($scenarioFormField);
    }

    /**
     * Get scenarioFormFields
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScenarioFormFields()
    {
        return $this->scenarioFormFields;
    }

    /**
     * Set isForeign
     *
     * @param boolean $isForeign
     *
     * @return Scenario
     */
    public function setIsForeign($isForeign)
    {
        $this->isForeign = $isForeign;

        return $this;
    }

    /**
     * Get isForeign
     *
     * @return boolean
     */
    public function getIsForeign()
    {
        return $this->isForeign;
    }

    /**
     * Set isTransfer
     *
     * @param boolean $isTransfer
     *
     * @return Scenario
     */
    public function setIsTransfer($isTransfer)
    {
        $this->isTransfer = $isTransfer;

        return $this;
    }

    /**
     * Get isTransfer
     *
     * @return boolean
     */
    public function getIsTransfer()
    {
        return $this->isTransfer;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Scenario
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

    public function registerDynamics($tpl, $section) {
        foreach ($this->getScenarioFormFields() as $scenarioFormField) {
            if ($scenarioFormField->getFormField()->getSection() == $section) {
                $scenarioFormField->getFormField()->registerDynamics($tpl);
            }
        }
    }

    /**
     * Set isMagister
     *
     * @param boolean $isMagister
     *
     * @return Scenario
     */
    public function setIsMagister($isMagister)
    {
        $this->isMagister = $isMagister;

        return $this;
    }

    /**
     * Get isMagister
     *
     * @return boolean
     */
    public function getIsMagister()
    {
        return $this->isMagister;
    }
}
