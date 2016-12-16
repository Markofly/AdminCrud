<?php

namespace Markofly\AdminCrud;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Form
 * @package Markofly\AdminCrud
 */
class Form
{

    /**
     * @var array
     */
    public $fields;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $routeName;

    /**
     * @var integer
     */
    protected $perPage;

    /**
     * Form constructor.
     * @param array $file
     * @param string $type
     * @throws \Exception
     */
    public function __construct($file, $type = 'list')
    {
        if ($type === 'edit') {
            $formFieldsName = 'edit_form';
        } else if ($type === 'create') {
            $formFieldsName = 'create_form';
        } else {
            $formFieldsName = 'list';
        }

        if (!isset($file['model'])) {
            throw new \Exception('Model is required in form file');
        }

        if (!isset($file['route_name'])) {
            throw new \Exception('Route name prefix is required in form file');
        }

        $this->model = new $file['model'];
        $this->routeName = $file['route_name'];

        $this->setPerPage($file['per_page']);

        if (isset($file[$formFieldsName])) {
            $this->setFields($file[$formFieldsName]);
        } else {
            $this->fields = [];
        }

    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return integer
     */
    public function gerPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return string
     */
    public function getIndexRoute()
    {
        return route($this->getRoutePrefix() . 'index');
    }

    /**
     * @return string
     */
    public function getCreateRoute()
    {
        return route($this->getRoutePrefix() . 'create');
    }

    /**
     * @return string
     */
    public function getStoreRoute()
    {
        return route($this->getRoutePrefix() . 'store');
    }

    /**
     * @param integer $id
     * @return string
     */
    public function getShowRoute($id)
    {
        return route($this->getRoutePrefix() . 'show', [$id]);
    }

    /**
     * @param integer $id
     * @return string
     */
    public function getEditRoute($id)
    {
        return route($this->getRoutePrefix() . 'edit', [$id]);
    }

    /**
     * @param integer $id
     * @return string
     */
    public function getUpdateRoute($id)
    {
        return route($this->getRoutePrefix() . 'update', [$id]);
    }

    /**
     * @param integer $id
     * @return string
     */
    public function getDestroyRoute($id)
    {
        return route($this->getRoutePrefix() . 'destroy', [$id]);
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return $this->routeName . (substr($this->routeName, -1) != '.' ? '.' : '');
    }

    /**
     * @return array
     */
    public function getFields()
    {
        if (!is_array($this->fields)) {
            return [];
        }

        return $this->fields;
    }

    /**
     * @param array $fields
     * @return void
     */
    public function setFields($fields)
    {
        if (!is_array($fields)) {
            $this->fields = [];
        }

        $formFields = [];

        foreach ($fields as $field) {
            $formFields[] = new FormField($field);
        }

        $this->fields = $formFields;
    }

    /**
     * @param $perPage
     * @return void
     */
    protected function setPerPage($perPage)
    {
        if (!isset($perPage)) {
            $this->perPage = 20;
            return;
        }

        $this->perPage = (int) $perPage;
    }

    /**
     * @return array
     */
    public function getValidationRules()
    {
        $rules = [];
        foreach ($this->getUpdateableFields() as $field) {
            $rules[$field->getFieldName()] = $field->getValidationRules();
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function getUpdateableFields()
    {
        $fields = [];
        foreach ($this->getFields() as $field) {
            if ($field->isEditable() === false || $field->isDatabaseField() === false) {
                continue;
            }

            $fields[] = $field;
        }

        return $fields;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getValuesFromCustomStoringMethod(Request $request)
    {
        $fields = [];

        foreach ($this->getUpdateableFields() as $field) {
            if (!$request->has($field->getFieldName())) {
                continue;
            }
            $fields[$field->getDatabaseField()] = $field->useStoringMethod($request->get($field->getFieldName()));
        }

        return $fields;
    }
}
