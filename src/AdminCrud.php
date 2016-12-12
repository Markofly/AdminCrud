<?php
namespace Markofly\AdminCrud;

class AdminCrud
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getList()
    {
        $form = $this->getForm();

        $items = $form->getModel();
        $items = $items->paginate($form->gerPerPage());

        $skipped = ($items->currentPage() * $items->perPage()) - $items->perPage();

        $html = view('AdminCrud::forms.list', ['form' => $form, 'items' => $items, 'skipped' => $skipped]);
        return $html;
    }

    public function getView($id)
    {
        $form = $this->getForm();
        $item = $form->getModel()->find($id);

        if (!$item) {
            return false;
        }

        $html = view('AdminCrud::forms.edit', ['form' => $form, 'item' => $item]);
        return $html;
    }

    public function getEditForm($id)
    {
        $form = $this->getForm();
        $item = $form->getModel()->find($id);

        if (!$item) {
            return false;
        }

        $html = view('AdminCrud::forms.edit', ['form' => $form, 'item' => $item]);
        return $html;
    }

    public function getCreateForm()
    {
        $form = $this->getForm();

        $html = view('AdminCrud::forms.create', ['form' => $form]);
        return $html;
    }

    public function getValidationRules()
    {
        $rules = [];

        $formFields = $this->getForm()->formFields;

        foreach ($formFields as $field) {
            $rules[$field->getDatabaseField()] = $field->getValidationRules();
        }

        return $rules;
    }

    public function getModel()
    {
        return $this->getForm()->getModel();
    }

    public function getForm()
    {
        $objectFile = $this->getFormFile($this->name);
        if (!$objectFile) {
            return false;
        }

        return new Form($objectFile);
    }

    public function getFormFile($name)
    {
        $objectPath = config('markofly.admincrud.path'). '/' . $name .'.php';

        if (!file_exists($objectPath)) {
            return false;
        }

        return include $objectPath;
    }
}