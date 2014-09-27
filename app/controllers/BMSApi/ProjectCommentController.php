<?php namespace BMSApi;


use Aska\BMS\Models\Project;
use Aska\BMS\Models\ProjectComment;
use Aska\BMS\Permissions\ProjectCommentPermission;
use Aska\BMS\Validators\ProjectCommentValidator;
use BaseController;
use Response, Input;

class ProjectCommentController extends BaseController {

    /**
     * @param Project $projects
     * @param ProjectComment $comments
     * @param ProjectCommentValidator $commentValidator
     * @param ProjectCommentPermission $projectCommentPermission
     */
    public function __construct(Project $projects, ProjectComment $comments,
                                ProjectCommentValidator $commentValidator, ProjectCommentPermission $projectCommentPermission)
    {
        $this->projects = $projects;
        $this->comments = $comments;
        $this->commentValidator = $commentValidator;
        $this->projectCommentPermission = $projectCommentPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Project $project
     * @return Response
     */
	public function index(Project $project)
	{
        if(! $this->projectCommentPermission->canSeeAll($project)) {

            $this->forbidden("You don't have access to see this project");
        }

        return $project->comments()->with('user', 'files')->get();
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Project $project
     * @return Response
     */
	public function store(Project $project)
	{
        if(! $this->projectCommentPermission->canCreate($project)) {

            $this->forbidden("You can't add comments to this project");
        }

        $this->commentValidator->validateOrFail($data = Input::all());

        $comment = $project->comments()->create($data);

        if(Input::has('files')) {

            $comment->setFiles(Input::get('files'));
        }

        return $comment->load('user', 'files');
	}


    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @param ProjectComment $comment
     * @return Response
     */
	public function show(Project $project, ProjectComment $comment)
	{
        if(! $this->projectCommentPermission->canSee($project, $comment)) {

            $this->forbidden("You don't have access to this project");
        }

        return $comment->load('user', 'files');
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Project $project
     * @param ProjectComment $comment
     * @return Response
     */
	public function update(Project $project, ProjectComment $comment)
	{
        if(! $this->projectCommentPermission->canUpdate($project, $comment)) {

            $this->forbidden("You don't have access to update this comment.");
        }

        $this->commentValidator->validateOrFail($data = Input::all());

        $comment->update($data);

        return $comment;
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param ProjectComment $comment
     * @return Response
     */
	public function destroy(Project $project, ProjectComment $comment)
	{
        if(! $this->projectCommentPermission->canDelete($project, $comment)) {

            $this->forbidden("You don't have access to delete this comment.");
        }

        $comment->delete();

        return Response::make(['message' => 'Comment deleted successfully.']);
	}


}
