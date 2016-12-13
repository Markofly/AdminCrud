<?php

namespace Markofly\AdminCrud;

use Illuminate\Http\Request;

trait AdminCrudTrait
{

    protected $adminCrud;

    protected $pageTitle;

    public function __construct()
    {
        $this->initializeAdminCrud();
    }

    public function initializeAdminCrud()
    {
        $this->adminCrud = new AdminCrud('users');
        $this->pageTitle = 'Users';
    }

    public function index()
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getList(), 'pageTitle' => $this->pageTitle]);
    }

    public function create()
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getCreateForm(), 'pageTitle' => $this->pageTitle]);
    }

    public function store(Request $request)
    {

        $rules = $this->adminCrud->getValidationRules();
        $this->validate($request, $rules);

        $item = $this->adminCrud->getModel();
        $item = $item->create($request->all());

        return redirect()->to($this->adminCrud->getObject()->getShowRoute($item->id))->with('success', 'Item is successfully created!');
    }

    public function show($id)
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getView($id), 'pageTitle' => $this->pageTitle]);
    }

    public function edit($id)
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getEditForm($id), 'pageTitle' => $this->pageTitle]);
    }

    public function update(Request $request, $id)
    {
        $rules = $this->adminCrud->getValidationRules();
        $this->validate($request, $rules);

        $item = $this->adminCrud->getModel()->findOrFail($id);
        $item->update($request->all());

        return redirect()->back()->with('success', 'Item is successfully saved!');
    }

    public function destroy($id)
    {
        $item = $this->adminCrud->getModel()->findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item is successfully deleted!');
    }
}
