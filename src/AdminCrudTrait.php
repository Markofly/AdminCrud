<?php

namespace Markofly\AdminCrud;

use Illuminate\Http\Request;

/**
 * Class AdminCrudTrait
 * @package Markofly\AdminCrud
 */
trait AdminCrudTrait
{

    /**
     * @var AdminCrud
     */
    protected $adminCrud;

    /**
     * @var string
     */
    protected $pageTitle;

    /**
     * AdminCrudTrait constructor.
     */
    public function __construct()
    {
        $this->initializeAdminCrud();
    }

    /**
     * @return void
     */
    public function initializeAdminCrud()
    {
        $this->adminCrud = new AdminCrud('users');
        $this->pageTitle = 'Users';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getList(), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getCreateForm(), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $rules = $this->adminCrud->getValidationRules();
        $this->validate($request, $rules);

        $item = $this->adminCrud->getModel();
        $item = $item->create($request->all());

        return redirect()->to($this->adminCrud->getForm()->getShowRoute($item->id))->with('success', 'Item is successfully created!');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getView($id), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getEditForm($id), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rules = $this->adminCrud->getValidationRules();
        $this->validate($request, $rules);

        $item = $this->adminCrud->getModel()->findOrFail($id);
        $item->update($request->all());

        return redirect()->back()->with('success', 'Item is successfully saved!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = $this->adminCrud->getModel()->findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item is successfully deleted!');
    }
}
