<?php

namespace Herzen\Admission\Orm\Form;

use Herzen\Admission\Orm\FormFieldType;

/**
* @Entity
* @Table(name="abit_form_field")
*/
class FormField {

    /**
    * @Id
    * @GeneratedValue(strategy="AUTO")
    * @Column(type="integer",name="id")
    */
    protected $id;

    /**
     * @var FormFieldType
     *
     * @ManyToOne(targetEntity="FormFieldType")
     * @JoinColumn(name="ref_abit_form_field_type", referencedColumnName="id")
     */
    protected $formFieldType;

    /**
    * @Column(type="string",length=255,name="name")
    */
    protected $name;

    /**
    * @Column(type="string",length=255,name="label")
    */
    protected $label;

    /**
    * @Column(type="string",length=255,name="section")
    */
    protected $section;

    /**
    * @Column(type="string",length=255,name="var")
    */
    protected $var;

    /**
    * @Column(type="string",length=255,name="column")
    */
    protected $column;

    /**
    * @Column(type="string",length=255,name="default")
    */
    protected $default;

    /**
    * @Column(type="string",length=255,name="edit_brick")
    */
    protected $editBrick;

    /**
    * @Column(type="string",length=255,name="enum")
    */
    protected $enum;

    /**
    * @Column(type="string",length=255,name="label_true")
    */
    protected $labelTrue;

    /**
    * @Column(type="string",length=255,name="label_false")
    */
    protected $labelFalse;

    /**
    * @Column(type="string",length=255,name="edit_section")
    */
    protected $editSection;

    /**
    * @Column(type="string",length=255,name="heading")
    */
    protected $isHeading;

    /**
    * @Column(type="string",length=255,name="togglable")
    */
    protected $isTogglable;

    /**
    * @Column(type="string",length=255,name="toggle_depend_var")
    */
    protected $toggleDependVar;

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
     * @return FormField
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

    /**
     * Set section
     *
     * @param string $section
     *
     * @return FormField
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set var
     *
     * @param string $var
     *
     * @return FormField
     */
    public function setVar($var)
    {
        $this->var = $var;

        return $this;
    }

    /**
     * Get var
     *
     * @return string
     */
    public function getVar()
    {
        return $this->var;
    }

    /**
     * Set column
     *
     * @param string $column
     *
     * @return FormField
     */
    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Get column
     *
     * @return string
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set default
     *
     * @param string $default
     *
     * @return FormField
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set editBrick
     *
     * @param string $editBrick
     *
     * @return FormField
     */
    public function setEditBrick($editBrick)
    {
        $this->editBrick = $editBrick;

        return $this;
    }

    /**
     * Get editBrick
     *
     * @return string
     */
    public function getEditBrick()
    {
        return $this->editBrick;
    }

    /**
     * Set enum
     *
     * @param string $enum
     *
     * @return FormField
     */
    public function setEnum($enum)
    {
        $this->enum = $enum;

        return $this;
    }

    /**
     * Get enum
     *
     * @return string
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * Set labelTrue
     *
     * @param string $labelTrue
     *
     * @return FormField
     */
    public function setLabelTrue($labelTrue)
    {
        $this->labelTrue = $labelTrue;

        return $this;
    }

    /**
     * Get labelTrue
     *
     * @return string
     */
    public function getLabelTrue()
    {
        return $this->labelTrue;
    }

    /**
     * Set labelFalse
     *
     * @param string $labelFalse
     *
     * @return FormField
     */
    public function setLabelFalse($labelFalse)
    {
        $this->labelFalse = $labelFalse;

        return $this;
    }

    /**
     * Get labelFalse
     *
     * @return string
     */
    public function getLabelFalse()
    {
        return $this->labelFalse;
    }

    /**
     * Set editSection
     *
     * @param string $editSection
     *
     * @return FormField
     */
    public function setEditSection($editSection)
    {
        $this->editSection = $editSection;

        return $this;
    }

    /**
     * Get editSection
     *
     * @return string
     */
    public function getEditSection()
    {
        return $this->editSection;
    }

    /**
     * Set isHeading
     *
     * @param string $isHeading
     *
     * @return FormField
     */
    public function setIsHeading($isHeading)
    {
        $this->isHeading = $isHeading;

        return $this;
    }

    /**
     * Get isHeading
     *
     * @return string
     */
    public function getIsHeading()
    {
        return $this->isHeading;
    }

    /**
     * Set isTogglable
     *
     * @param string $isTogglable
     *
     * @return FormField
     */
    public function setIsTogglable($isTogglable)
    {
        $this->isTogglable = $isTogglable;

        return $this;
    }

    /**
     * Get isTogglable
     *
     * @return string
     */
    public function getIsTogglable()
    {
        return $this->isTogglable;
    }

    /**
     * Set toggleDependVar
     *
     * @param string $toggleDependVar
     *
     * @return FormField
     */
    public function setToggleDependVar($toggleDependVar)
    {
        $this->toggleDependVar = $toggleDependVar;

        return $this;
    }

    /**
     * Get toggleDependVar
     *
     * @return string
     */
    public function getToggleDependVar()
    {
        return $this->toggleDependVar;
    }

    /**
     * Set formFieldType
     *
     * @param \Herzen\Admission\Orm\Form\FormFieldType $formFieldType
     *
     * @return FormField
     */
    public function setFormFieldType(\Herzen\Admission\Orm\Form\FormFieldType $formFieldType = null)
    {
        $this->formFieldType = $formFieldType;

        return $this;
    }

    /**
     * Get formFieldType
     *
     * @return \Herzen\Admission\Orm\Form\FormFieldType
     */
    public function getFormFieldType()
    {
        return $this->formFieldType;
    }

    public function registerDynamics($tpl) {
        return $this->formFieldType->registerDynamics($tpl, $this);
    }
}
