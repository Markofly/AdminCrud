<?php
namespace Markofly\AdminCrud\Controllers;

use Illuminate\Http\Request;
use Markofly\AdminCrud\AdminCrud;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class baseCrudController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $adminCrud;

    protected $pageTitle;

    public function __construct()
    {
        $this->adminCrud = new AdminCrud('users');
        $this->pageTitle = 'Users';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getList(), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getCreateForm(), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = $this->adminCrud->getValidationRules();
        $this->validate($request, $rules);

        $item = $this->adminCrud->getModel();
        $item = $item->create($request->all());

        return redirect()->to($this->adminCrud->getObject()->getShowRoute($item->id))->with('success', 'Item is successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getView($id), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('AdminCrud::default', ['form' => $this->adminCrud->getEditForm($id), 'pageTitle' => $this->pageTitle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->adminCrud->getModel()->findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item is successfully deleted!');
    }
}

