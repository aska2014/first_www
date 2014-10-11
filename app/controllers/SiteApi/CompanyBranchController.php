<?php namespace SiteApi;


use Aska\Site\Models\CompanyBranch;
use Aska\Site\Permissions\CompanyBranchPermission;
use BaseController;
use Response, Input;

class CompanyBranchController extends BaseController {

    /**
     * @param CompanyBranch $branches
     * @param CompanyBranchPermission $branchPermission
     */
    public function __construct(CompanyBranch $branches, CompanyBranchPermission $branchPermission)
    {
        $this->branches = $branches;
        $this->branchPermission = $branchPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->branches->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->branchPermission->canCreate()) {

            $this->forbidden("You can't create branch");
        }

        $this->validateOrFail($data = Input::all(), $this->branches->rules());

        return $this->branches->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param CompanyBranch $branch
     * @return Response
     */
    public function show(CompanyBranch $branch)
    {
        return $branch;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyBranch $branch
     * @return Response
     */
    public function update(CompanyBranch $branch)
    {
        if(! $this->branchPermission->canUpdate($branch)) {

            $this->forbidden("You can't update this branch");
        }

        $this->validateOrFail($data = Input::all(), $branch->rules());

        $branch->update(Input::all());

        return $branch;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param CompanyBranch $branch
     * @return Response
     */
    public function destroy(CompanyBranch $branch)
    {
        if(! $this->branchPermission->canDelete($branch)) {

            $this->forbidden("You can't delete this branch");
        }

        $branch->delete();

        return Response::make(['message' => 'CompanyBranch deleted successfully']);
    }
}
