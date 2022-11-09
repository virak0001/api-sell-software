<?php

namespace App\Http\Controllers\API;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use Auth;
use Validator;
class AppointmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(Appointment::all(), 'Get all appointment all!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        return $this->sendResponse(Appointment::createApp($request), 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return $this->sendResponse($appointment, 'Appointment detail!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        return $this->sendResponse(Appointment::updateApp($request, $appointment), 'Appointment updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */

    public function cancel(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        return $this->sendResponse(Appointment::updateApp($request, $appointment), $input['status'] . 'success!');
    }

    public function confirmOrCancel(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        return $this->sendResponse(Appointment::updateApp($request, $appointment), 'Your confirm was successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
