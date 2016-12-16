<?php

namespace Markofly\AdminCrud;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FormField
 * @package Markofly\AdminCrud
 */
class FormField
{

    /**
     * @var array
     */
    protected $fieldArray;

    /**
     * FormField constructor.
     * @param $field
     */
    public function __construct($field)
    {
        $this->fieldArray = $field;
    }

    /**
     * @param null|Model $item
     * @param bool $showDatabaseValue
     * @return string
     */
    public function getFormInput($item = null, $showDatabaseValue = false)
    {
        $args = [
            'item' => $item,
            'field' => $this,
            'showDatabaseValue' => $showDatabaseValue,
        ];

        if ($this->getFieldType() == 'textarea') {
            return view('AdminCrud::fields.textarea', $args)->render();
        }

        if ($this->getFieldType() == 'password') {
            return view('AdminCrud::fields.password', $args)->render();
        }

        return view('AdminCrud::fields.text', $args)->render();
    }

    /**
     * @param Model $item
     * @param bool $showDatabaseValue
     * @return mixed|string
     */
    public function getInputValue($item, $showDatabaseValue = false)
    {
        if (old($this->getFieldName())) {
            return old($this->getFieldName());
        }

        if (!$item) {
            return '';
        }

        if (!$showDatabaseValue) {
            return '';
        }

        if (!isset($item[$this->getDatabaseField()])) {
            return '';
        }

        return $item[$this->getDatabaseField()];
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        if (!isset($this->fieldArray['label'])) {
            return $this->getFieldName();
        }

        return $this->fieldArray['label'];
    }

    /**
     * @return string|bool
     */
    public function getDatabaseField()
    {
        if (!isset($this->fieldArray['database_field'])) {
            return false;
        }

        return $this->fieldArray['database_field'];
    }

    /**
     * @return bool
     */
    public function isDatabaseField()
    {
        if ($this->getDatabaseField() === false) {
            return false;
        }

        return true;
    }

    /**
     * @return string|bool
     */
    public function getFieldName()
    {
        if ($this->isDatabaseField() === true) {
            return $this->getDatabaseField();
        }

        if (!isset($this->fieldArray['name'])) {
            return false;
        }

        return $this->fieldArray['name'];
    }

    /**
     * @return string
     */
    public function getValidationRules()
    {
        if (!isset($this->fieldArray['validation_rules'])) {
            return '';
        }

        return $this->fieldArray['validation_rules'];
    }

    /**
     * @return mixed|string
     */
    public function getFieldType()
    {
        if (!isset($this->fieldArray['type'])) {
            return '';
        }

        return $this->fieldArray['type'];
    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        if (!isset($this->fieldArray['editable'])) {
            return true;
        }

        return (bool) $this->fieldArray['editable'];
    }

    /**
     * @param $value
     * @return mixed
     */
    public function useStoringMethod($value)
    {
        if (!isset($this->fieldArray['storing_method'])) {
            return $value;
        }

        if (!is_callable($this->fieldArray['storing_method'])) {
            return $value;
        }

        return call_user_func($this->fieldArray['storing_method'], $value);
    }
}
