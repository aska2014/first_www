<?php

use Company\Project;
use Company\ProjectStage;

class ProjectStageController extends APIController {

    /**
     * @param ProjectStage $projectStages
     * @param ProjectStageValidator $projectStageValidator
     */
    public function __construct(ProjectStage $projectStages, ProjectStageValidator $projectStageValidator)
    {
        $this->projectStages = $projectStages;
        $this->projectStageValidator = $projectStageValidator;
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function getByProject(Project $project)
    {
        $this->mustBeWorkingOn($project);

        return $project->stages;
    }

    /**
     * @param Project $project
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Project $project)
    {
        $this->mustBeWorkingOn($project);

        $validator = $this->projectStageValidator->make(Input::all());

        if($validator->fails()) {

            return Response::make($validator->messages(), 400);
        }

        return $project->stages()->create(Input::all());
    }

    /**
     * @todo implement
     * @param ProjectStage $stage
     */
    public function update(ProjectStage $stage)
    {
        $validator = $this->projectStageValidator->make(Input::all());

        if($validator->fails()) {

            return Response::make($validator->messages(), 400);
        }

        $stage->update(Input::all());

        return Response::make(['message' => 'Project stage updated successfully.']);
    }

    /**
     * @param Project $project
     */
    public function setProjectStages(Project $project)
    {
        $project->setStagesAttribute(Input::all());

        return $project;
    }

    /**
     * @param ProjectStage $stage
     */
    public function destroy(ProjectStage $stage)
    {
        $this->mustBeWorkingOn($stage->project);

        $stage->delete();
    }


    /**
     * Check if user has access to this project or abort
     *
     * @param $project
     */
    protected function mustBeWorkingOn(Project $project)
    {
        // If project doesn't have user
        if(! $project->checkUserAccess($this->me())) {

            App::abort(403, 'You don\'t have access to this project.');
        }
    }
}