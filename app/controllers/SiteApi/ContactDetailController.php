<?php namespace SiteApi;

use Aska\Site\Models\ContactDetail;
use Input, Response;

class ContactDetailController extends \BaseController {

    /**
     * @param ContactDetail $contactDetails
     */
    public function __construct(ContactDetail $contactDetails)
    {
        $this->contactDetails = $contactDetails;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->contactDetails->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->validateOrFail($data = Input::all(), $this->contactDetails->rules());

        return $this->contactDetails->create($data);
    }


    /**
     * Display the specified resource.
     *
     * @param ContactDetail $contactDetail
     * @return Response
     */
    public function show(ContactDetail $contactDetail)
    {
        return $contactDetail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactDetail $contactDetail
     * @return Response
     */
    public function update(ContactDetail $contactDetail)
    {
        $this->validateOrFail($data = Input::all(), $contactDetail->rules());

        $contactDetail->update(Input::all());

        return $contactDetail;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param ContactDetail $contactDetail
     * @return Response
     */
    public function destroy(ContactDetail $contactDetail)
    {
        $contactDetail->delete();

        return Response::make(['message' => 'Info slider deleted successfully']);
    }

} 