<?php
namespace Markofly\AdminCrud;

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
     * @var array
     */
    public $formFields;

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
     * @param $file
     */
    public function __construct($file)
    {
        $this->model = new $file['model'];
        $this->routeName = $file['route_name'];
        $this->perPage = $file['per_page'];

        $this->createFieldObjects($file['fields']);
        $this->createFormFieldObjects($file['form']);
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
     * @param array $fields
     */
    protected function createFieldObjects($fields)
    {
        $fieldObjects = [];

        foreach ($fields as $field) {
            $object = new FormField($field);
            $fieldObjects[] = $object;
        }

        $this->fields = $fieldObjects;
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return $this->routeName . (substr($this->routeName, -1) != '.' ? '.' : '');
    }

    /**
     * @param array $fields
     */
    protected function createFormFieldObjects($fields)
    {
        $fieldObjects = [];

        foreach ($fields as $field) {
            $object = new FormField($field);
            $fieldObjects[] = $object;
        }

        $this->formFields = $fieldObjects;
    }


}
