<?php

use Company\Project;
use Membership\User;

class ProjectController extends APIController {

    /**
     * @param Project $projects
     * @param ProjectValidator $projectValidator
     */
    public function __construct(Project $projects, ProjectValidator $projectValidator)
    {
        $this->projects = $projects;
        $this->projectValidator = $projectValidator;
    }

    /**
     * Get all projects
     */
    public function getAll()
    {
        return $this->projects->all();
    }

    /**
     * @return mixed
     */
    public function getMe()
    {
        return $this->projects->byUser($this->me())->get();
    }

    /**
     * @param Project $project
     * @return Project
     */
    public function show(Project $project)
    {
        $this->mustByWorkingOn($project);

        return $project;
    }

    /**
     * Create new project
     */
    public function create()
    {
        $validator = $this->projectValidator->make(Input::all());

        if($validator->fails())
        {
            return Response::make($validator->messages(), 400);
        }

        return $this->me()->createdProjects()->create(Input::all());
    }

    /**
     * Update project
     *
     * @param Project $project
     * @return \Company\Project
     */
    public function update(Project $project)
    {
        $validator = $this->projectValidator->make(Input::all());

        if($validator->fails())
        {
            return Response::make($validator->messages(), 400);
        }

        $project->update(Input::all());

        return $project;
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function accept(Project $project)
    {
        $project->accept();

        return Response::make(['message' => 'Project accepted.']);
    }

    /**
     * @param Project $project
     * @param User $user
     */
    public function addUser(Project $project, User $user)
    {
        $project->users()->attach($user);

        return Response::make(['message' => 'User added successfully.']);
    }

    /**
     * @param Project $project
     * @param User $user
     */
    public function removeUser(Project $project, User $user)
    {
        $project->users()->detach($user);

        return Response::make(['message' => 'User removed successfully.']);
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function setUsers(Project $project)
    {
        $project->users()->sync(Input::get('user_ids'));

        return Response::make(['message' => 'Project users set successfully.']);
    }

    /**
     * @param Project $project
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return Response::make(['message' => 'Project deleted.']);
    }


    /**
     * Check if user has access to this project or abort
     *
     * @param $project
     */
    protected function mustByWorkingOn(Project $project)
    {
        // If project doesn't have user
        if(! $project->checkUserAccess($this->me())) {

            App::abort(403, 'You don\'t have access to this project.');
        }
    }
}