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

class PatientRepository
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getPatientsIndexTable(){
        $model = Patient::select('*');
        $notArray = array('pageSize', 'page');
        foreach ($this->request->all() as $key => $value) {
            if(!in_array($key,$notArray) && !empty($value)){
                if($key === 'name'){
                    $model->search($value);
                } else if($key === 'age') {
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
}