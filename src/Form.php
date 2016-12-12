<?php
namespace Markofly\AdminCrud;

class Form
{

    public $fields;

    public $formFields;

    protected $model;

    protected $routeName;

    protected $perPage;

    public function __construct($file)
    {
        $this->model = new $file['model'];
        $this->routeName = $file['route_name'];
        $this->perPage = $file['per_page'];

        $this->createFieldObjects($file['fields']);
        $this->createFormFieldObjects($file['form']);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function gerPerPage()
    {
        return $this->perPage;
    }

    public function getIndexRoute()
    {
        return route($this->getRoutePrefix() . 'index');
    }

    public function getCreateRoute()
    {
        return route($this->getRoutePrefix() . 'create');
    }

    public function getStoreRoute()
    {
        return route($this->getRoutePrefix() . 'store');
    }

    public function getShowRoute($id)
    {
        return route($this->getRoutePrefix() . 'show', [$id]);
    }

    public function getEditRoute($id)
    {
        return route($this->getRoutePrefix() . 'edit', [$id]);
    }

    public function getUpdateRoute($id)
    {
        return route($this->getRoutePrefix() . 'update', [$id]);
    }

    public function getDestroyRoute($id)
    {
        return route($this->getRoutePrefix() . 'destroy', [$id]);
    }

    protected function createFieldObjects($fields)
    {
        $fieldObjects = [];

        foreach ($fields as $field) {
            $object = new FormField($field);
            $fieldObjects[] = $object;
        }

        $this->fields = $fieldObjects;
    }

    protected function getRoutePrefix()
    {

        return 'admin.' . $this->routeName . '.';
    }

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