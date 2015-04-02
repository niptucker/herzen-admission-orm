<?php

namespace Herzen\Admission\Orm\Form;

/**
* @Entity
* @Table(name="abit_form_field_type")
*/
class FormFieldType {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer",name="id")
    */
    protected $id;

    /**
    * @Column(type="string",length=255,name="name")
    */
    protected $name;

    /**
    * @Column(type="string",length=255,name="label")
    */
    protected $label;

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
     * Set label
     *
     * @param string $label
     *
     * @return FormFieldType
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    public function registerDynamics($tpl, $formField) {
        switch ($this->name) {
            case 'select':
                $tpl->registerList($formField->getName(), $formField->getEnum(), $formField->getVar());

                break;

            default:
                # code...
                break;
        }
    }
}
