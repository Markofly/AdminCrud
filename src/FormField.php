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
     * @var string
     */
    protected $databaseField;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var null|array
     */
    protected $validationRules;

    /**
     * @var null|string
     */
    protected $fieldType;

    /**
     * FormField constructor.
     * @param $field
     */
    public function __construct($field)
    {
        $this->label = $field['label'];
        $this->databaseField = $field['db_field'];
        $this->validationRules = (isset($field['validation_rules'])) ? $field['validation_rules'] : null;
        $this->fieldType = (isset($field['field_type'])) ? $field['field_type'] : null;
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

        if ($this->fieldType == 'textarea') {
            return view('AdminCrud::fields.textarea', $args)->render();
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

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getDatabaseField()
    {
        return $this->databaseField;
    }

    /**
     * @return array|null
     */
    public function getValidationRules()
    {
        return $this->validationRules;
    }
}
