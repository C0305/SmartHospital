<?php

namespace SmartHospital\Http\Controllers\EHR\Patient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SmartHospital\Http\Controllers\Controller;
use SmartHospital\Http\Repositories\EHR\PatientRepository;

class PatientController extends Controller
{
    private $request;
    private $repository;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->repository = new PatientRepository($request);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('electronicHealthRecord.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->form();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return $this->savePatient();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($typeOrId)
    {
        $return = null;
        switch($typeOrId){
            case 'index':
                $model = $this->repository->getPatientsIndexTable();
                $return = $model->paginate($this->request->get('pageSize', 25));
                break;
            case 'select':
                $data = $this->request->get('name');
                if(empty($data)){
                    $data = null;
                }
                $model = $this->repository->getPatientSelectData($data);
                $return = $model->take($this->request->get('size', 50))->get()->toArray();
                break;
            default:
                $return = (string) $this->repository->getPatient($typeOrId);
        }
        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->form($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $this->savePatient();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->repository->deletePatient($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    private function savePatient()
    {
        DB::beginTransaction();
        try {
            $model = $this->repository->savePatient();
            DB::commit();
            return $model->id;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

    }

    private function form($patientId = null)
    {
        return view('electronicHealthRecord.patient.form')->with([
            'patientId' => $patientId
        ]);
    }

}
