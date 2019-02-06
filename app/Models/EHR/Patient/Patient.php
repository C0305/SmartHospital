<?php

namespace SmartHospital\Models\EHR\Patient;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SmartHospital\Traits\Models\FullTextSearch;

class Patient extends Model
{
    use SoftDeletes;
    use FullTextSearch;

    protected $table = 'electronic_health_record_patients';
    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'last_name',
        'mother_last_name',
        'blood_group',
        'marital_status',
        'mobile',
        'state',
        'email',
        'address_id',
        'allergies',
        'middle_name',
        'hospitals_id',
        'created_user',
        'updated_user',
    ];

    protected $searchable = [
        'name',
        'last_name',
        'mother_last_name'
    ];

    protected $dates = ['created_at','updated_at','deleted_at'];

//    public static function boot() {
//        parent::boot();
//
//        // create a event to happen on updating
//        static::updating(function($table)  {
//            $table->updated_user = Auth::user()->id;
//        });
//
//        // create a event to happen on deleting
//        static::deleting(function($table)  {
//            $table->deleted_user = Auth::user()->id;
//        });
//
//        // create a event to happen on saving
//        static::saving(function($table)  {
//            $table->created_user = Auth::user()->id;
//        });
//    }

    /**
     * Accessor for Age.
     */
    public function getAge()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }
    public function address() {
        return $this->hasOne('SmartHospital\Models\EHR\Patient\PatientAddress', 'id', 'address_id');
    }
}
