<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'started_at',
        'ended_at',
        'clinic_id',
        'price',
        'patient_id'
    ];

    static function createApp(StoreAppointmentRequest $request) {
        $input = $request->all();
        $input['patient_id'] =  Auth::id();
        return Appointment::create($input);
    }

    static function updateApp(UpdateAppointmentRequest $request, Appointment $appointment){
        $input = $request->all();
        $appointment = Appointment::where('id',$input['id'])->update($input);
        return Appointment::find($input['id']);
    }

    static function confirmOrCancle(UpdateAppointmentRequest $request, Appointment $appointment){
        $input = $request->all();
        $appointment = Appointment::where('id',$input['id'])->update($input);
        return Appointment::find($input['id']);
    }
}
