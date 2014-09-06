<?php

use Company\Project;
use Company\ProjectComment;

class ProjectCommentController extends APIController
{

    /**
     * @param ProjectComment $projectComments
     * @param ProjectCommentValidator $projectCommentValidator
     */
    public function __construct(ProjectComment $projectComments, ProjectCommentValidator $projectCommentValidator)
    {
        $this->projectCommentValidator = $projectCommentValidator;
        $this->projectComments = $projectComments;
    }

    /**
     * Get all comments in this project
     *
     * @param Project $project
     * @return mixed
     */
    public function getByProject(Project $project)
    {
        $this->mustBeWorkingOn($project);

        return $project->comments;
    }

    /**
     * Create new comment in this project
     *
     * @param Project $project
     * @return mixed
     */
    public function create(Project $project)
    {
        $this->mustBeWorkingOn($project);

//        $validator = $this->projectCommentValidator->make(Input::all());

//        if ($validator->fails()) {
//
//            return Response::make($validator->messages(), 400);
//        }

        $comment = $this->projectComments->newInstance(Input::all());

        $comment->user()->associate($this->me());
        $comment->project()->associate($project);

        $comment->save();

        return $comment;
    }

    /**
     * Update comment.
     *
     * @todo Implement this
     * @param ProjectComment $projectComment
     */
    public function update(ProjectComment $projectComment)
    {
    }

    /**
     * Delete comment.
     *
     * @param ProjectComment $projectComment
     */
    public function destroy(ProjectComment $projectComment)
    {
        $projectComment->delete();

        return Response::make(['message' => 'Comment deleted successfully.']);
    }


    /**
     * Check if user has access to this project or abort
     *
     * @param $project
     */
    protected function mustBeWorkingOn(Project $project)
    {
        // If project doesn't have user
        if (!$project->checkUserAccess($this->me())) {

            App::abort(403, 'You don\'t have access to this project.');
        }
    }
}