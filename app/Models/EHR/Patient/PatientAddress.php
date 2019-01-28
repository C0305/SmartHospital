<?php

namespace SmartHospital\Models\EHR\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PatientAddress extends Model
{

    use SoftDeletes;
    protected $table = 'electronic_health_record_patients_addresses';

    protected $fillable = [
        'name',
        'street',
        'number',
        'apartment_number',
        'neighbourhood',
        'city',
        'state',
        'crated_user',
        'updated_user',
        'deleted_user',
    ];

    protected $dates = ['created_at','updated_at','deleted_at'];


        public static function boot() {
        parent::boot();

        // create a event to happen on updating
        static::updating(function($table)  {
            $table->updated_user = Auth::user()->id;
        });

        // create a event to happen on deleting
        static::deleting(function($table)  {
            $table->deleted_user = Auth::user()->id;
        });

        // create a event to happen on saving
        static::saving(function($table)  {
            $table->created_user = Auth::user()->id;
        });
    }
}
