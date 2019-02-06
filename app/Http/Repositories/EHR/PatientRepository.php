<?php
/**
 * Created by PhpStorm.
 * User: owl
 * Date: 2019-01-19
 * Time: 18:08
 */

namespace SmartHospital\Http\Repositories\EHR;


use Carbon\Carbon;
use SmartHospital\Models\EHR\Patient\Patient;
use SmartHospital\Models\EHR\Patient\PatientAddress;

class PatientRepository
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getPatientsIndexTable(){
        $model = Patient::select('*')->with('address');
        $notArray = array('pageSize', 'page', 'udefined');
        foreach ($this->request->all() as $key => $value) {
            if(!in_array($key,$notArray) && !empty($value)){
                if($key === 'fullname'){
                    $model->search($value);
                } else if($key === 'getAge') {
                    $carbon = Carbon::now()->startOfYear();
                    $from = $carbon->copy()->subYears(intval($value));
                    $to = $from->copy()->endOfYear();

                    $model->whereBetween('birthday', [$from->toDateTimeString(), $to->toDateTimeString()]);
                }
                else {
                    $model->where($key, 'LIKE', '%'.$value.'%');
                }
            }
        }
        return $model;
    }
    public function savePatient()
    {
        $patient = $this->request->all();
        $address = $patient['address'];
        $birthday = new Carbon($patient['birthday']);
        $patient['birthday'] = $birthday->format('Y-m-d');
        unset($patient['address']);
        $patientAddressModel = PatientAddress::updateOrCreate(['id' => $address['id']],$address);
        $patient['address_id'] = $patientAddressModel->id;
        $patientModel = Patient::updateOrCreate(['id' => $patient['id']],$patient);
        $patientModel->birthday = $birthday->format('Y-m-d');
        $patientModel->save();
        return $patientModel;
    }
}