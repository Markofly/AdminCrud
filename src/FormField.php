<?php
namespace Markofly\AdminCrud;

class FormField
{

    protected $databaseField;

    protected $label;

    protected $validationRules;

    protected $fieldType;

    public function __construct($field)
    {
        $this->label = $field['label'];
        $this->databaseField = $field['db_field'];
        $this->validationRules = (isset($field['validation_rules'])) ? $field['validation_rules'] : null;
        $this->fieldType = (isset($field['field_type'])) ? $field['field_type'] : null;
    }

    public function getFormInput($item = null, $showDatabaseValue = false)
    {
        $args = [
            'item' => $item,
            'field' => $this,
            'showDatabaseValue' => $showDatabaseValue,
        ];

        if ($this->fieldType == 'textarea') {
            return view('AdminCrud::fields.textarea', $args)->render();
        }

        return view('AdminCrud::fields.text', $args)->render();
    }

    public function getInputValue($item, $showDatabaseValue = false)
    {
        if (old($this->getDatabaseField())) {
            return old($this->getDatabaseField());
        }

        if (!$item) {
            return '';
        }

        if (!$showDatabaseValue) {
            return '';
        }

        return $item[$this->getDatabaseField()];
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getDatabaseField()
    {
        return $this->databaseField;
    }

    public function getValidationRules()
    {
        return $this->validationRules;
    }
}