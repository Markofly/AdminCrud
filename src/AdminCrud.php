<?php
namespace Markofly\AdminCrud;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminCrud
 * @package Markofly\AdminCrud
 */
class AdminCrud
{
    /**
     * @var string
     */
    protected $name;

    /**
     * AdminCrud constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $form = $this->getForm();

        if (!$form) {
            return null;
        }

        $items = $form->getModel();

        if (!$items) {
            return null;
        }

        $items = $items->paginate($form->gerPerPage());

        $skipped = ($items->currentPage() * $items->perPage()) - $items->perPage();

        $html = view('AdminCrud::forms.list', ['form' => $form, 'items' => $items, 'skipped' => $skipped]);
        return $html;
    }

    /**
     * @param $id
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getView($id)
    {
        $form = $this->getForm();

        if (!$form) {
            return null;
        }

        $item = $form->getModel()->find($id);

        if (!$item) {
            return null;
        }

        $html = view('AdminCrud::forms.edit', ['form' => $form, 'item' => $item]);
        return $html;
    }

    /**
     * @param $id
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditForm($id)
    {
        $form = $this->getForm();

        if (!$form) {
            return null;
        }

        $item = $form->getModel()->find($id);

        if (!$item) {
            return null;
        }

        $html = view('AdminCrud::forms.edit', ['form' => $form, 'item' => $item]);
        return $html;
    }

    /**
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateForm()
    {
        $form = $this->getForm();

        if (!$form) {
            return null;
        }

        $html = view('AdminCrud::forms.create', ['form' => $form]);
        return $html;
    }

    /**
     * @return array
     */
    public function getValidationRules()
    {
        $rules = [];

        if (!$this->getForm()) {
            return $rules;
        }

        $formFields = $this->getForm()->formFields;

        foreach ($formFields as $field) {
            $rules[$field->getDatabaseField()] = $field->getValidationRules();
        }

        return $rules;
    }

    /**
     * @return null|Model
     */
    public function getModel()
    {
        if (!$this->getForm()) {
            return null;
        }

        return $this->getForm()->getModel();
    }

    /**
     * @return null|Form
     */
    public function getForm()
    {
        $objectFile = $this->getFormFile($this->name);
        if (!$objectFile) {
            return null;
        }

        return new Form($objectFile);
    }


    /**
     * @param string $name
     * @return array|null
     */
    public function getFormFile($name)
    {
        $objectPath = config('markofly.admincrud.path'). '/' . $name .'.php';

        if (!file_exists($objectPath)) {
            return null;
        }

        $objectSettings = include $objectPath;

        if (!is_array($objectSettings)) {
            return null;
        }

        return $objectSettings;
    }
}
