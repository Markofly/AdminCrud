<?php

namespace Markofly\AdminCrud;

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
     * @throws \Exception
     */
    public function __construct($name)
    {
        if (!$this->isFormFileExists($name)) {
            throw new \Exception('Form file not found.');
        }

        $this->name = $name;
    }

    /**
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListView()
    {
        $form = $this->getForm('list');

        if (!$form) {
            return null;
        }

        $items = $form->getModel();

        if (!$items) {
            return null;
        }

        $items = $items->paginate($form->gerPerPage());

        $skipped = ($items->currentPage() * $items->perPage()) - $items->perPage();

        $html = view('AdminCrud::forms.list', ['form' => $form, 'items' => $items, 'skipped' => $skipped])->render();
        return $html;
    }

    /**
     * @param $id
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowView($id)
    {
        $form = $this->getForm('edit');

        if (!$form) {
            return null;
        }

        if (!$form->getModel()) {
            return null;
        }

        $item = $form->getModel()->find($id);

        if (!$item) {
            return null;
        }

        $html = view('AdminCrud::forms.edit', ['form' => $form, 'item' => $item])->render();
        return $html;
    }

    /**
     * @param $id
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditFormView($id)
    {
        $form = $this->getForm('edit');

        if (!$form) {
            return null;
        }

        if (!$form->getModel()) {
            return null;
        }

        $item = $form->getModel()->find($id);

        if (!$item) {
            return null;
        }

        $html = view('AdminCrud::forms.edit', ['form' => $form, 'item' => $item])->render();
        return $html;
    }

    /**
     * @return null|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateFormView()
    {
        $form = $this->getForm('create');

        if (!$form) {
            return null;
        }

        $html = view('AdminCrud::forms.create', ['form' => $form]);
        return $html;
    }

    /**
     * @param string $type
     * @return Form|null
     */
    public function getForm($type = 'list')
    {
        $formFile = $this->getFormFile($this->name);
        if (!$formFile) {
            return null;
        }

        return new Form($formFile, $type);
    }


    /**
     * @param string $name
     * @return array|null
     */
    protected function getFormFile($name)
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

    /**
     * @param string $name
     * @return bool
     */
    protected function isFormFileExists($name)
    {
        $formFile = $this->getFormFile($name);

        if (!$formFile) {
            return false;
        }

        return true;
    }
}
