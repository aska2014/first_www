<?php namespace SiteApi;


use Aska\Site\Models\ContactEmail;
use Aska\Site\Permissions\ContactEmailPermission;
use BaseController;
use Response, Input;

class ContactEmailController extends BaseController {

    /**
     * @param ContactEmail $contactEmails
     * @param ContactEmailPermission $contactEmailPermission
     */
    public function __construct(ContactEmail $contactEmails, ContactEmailPermission $contactEmailPermission)
    {
        $this->contactEmails = $contactEmails;
        $this->contactEmailPermission = $contactEmailPermission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->contactEmails->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(! $this->contactEmailPermission->canCreate()) {

            $this->forbidden("You can't create contactEmail");
        }

        $this->validateOrFail($data = Input::all(), $this->contactEmails->rules());

        return $this->contactEmails->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param ContactEmail $contactEmail
     * @return Response
     */
    public function show(ContactEmail $contactEmail)
    {
        return $contactEmail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactEmail $contactEmail
     * @return Response
     */
    public function update(ContactEmail $contactEmail)
    {
        if(! $this->contactEmailPermission->canUpdate($contactEmail)) {

            $this->forbidden("You can't update this contactEmail");
        }

        $this->validateOrFail($data = Input::all(), $contactEmail->rules());

        $contactEmail->update(Input::all());

        return $contactEmail;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param ContactEmail $contactEmail
     * @return Response
     */
    public function destroy(ContactEmail $contactEmail)
    {
        if(! $this->contactEmailPermission->canDelete($contactEmail)) {

            $this->forbidden("You can't delete this contactEmail");
        }

        $contactEmail->delete();

        return Response::make(['message' => 'ContactEmail deleted successfully']);
    }
}
