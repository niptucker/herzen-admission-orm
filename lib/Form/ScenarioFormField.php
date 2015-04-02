<?php

namespace Herzen\Admission\Orm\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Herzen\Admission\Orm\Form\FormField;
use Herzen\Admission\Orm\Form\Scenario;

/**
 * @Entity
 * @Table(name="abit_scenario_form_field")
 */
class ScenarioFormField {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id")
     */
    protected $id;

    /**
     * @var Scenario
     *
     * @ManyToOne(targetEntity="Scenario")
     * @JoinColumn(name="ref_abit_scenario", referencedColumnName="id")
     */
    protected $scenario;

    /**
     * @var FormField
     *
     * @ManyToOne(targetEntity="FormField")
     * @JoinColumn(name="ref_abit_form_field", referencedColumnName="id")
     */
    protected $formField;

    /**
     * @Column(type="integer", name="order")
     */
    protected $order;


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
     * Set order
     *
     * @param integer $order
     *
     * @return ScenarioFormField
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set scenario
     *
     * @param \Herzen\Admission\Orm\Form\Scenario $scenario
     *
     * @return ScenarioFormField
     */
    public function setScenario(\Herzen\Admission\Orm\Form\Scenario $scenario = null)
    {
        $this->scenario = $scenario;

        return $this;
    }

    /**
     * Get scenario
     *
     * @return \Herzen\Admission\Orm\Form\Scenario
     */
    public function getScenario()
    {
        return $this->scenario;
    }

    /**
     * Set formField
     *
     * @param \Herzen\Admission\Orm\Form\FormField $formField
     *
     * @return ScenarioFormField
     */
    public function setFormField(\Herzen\Admission\Orm\Form\FormField $formField = null)
    {
        $this->formField = $formField;

        return $this;
    }

    /**
     * Get formField
     *
     * @return \Herzen\Admission\Orm\Form\FormField
     */
    public function getFormField()
    {
        return $this->formField;
    }
}
