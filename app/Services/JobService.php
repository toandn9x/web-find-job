<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Job;
use Auth;
use Log;
use Carbon\Carbon;

class JobService
{
    private $job;

    public function __construct() {
        $this->job = new Job();
    }

    public function index(Request $request) {
        $jobs = Job::query()->title($request)
                    ->city($request)
                    ->rank($request)
                    ->methodwork($request)
                    ->exp($request)
                    ->with(['company' => function($query){
                        $query->select('id','name','phone','address','path');
                    }])
                    ->orderBy('created_at', 'DESC')->get();

        return $jobs;
    }

    public function store(Request $request) {
        try {
            $data = $request->except('_token');
            $job = $this->job;
            $job->user_id = Auth::user()->id;
            $job->company_id = Auth::user()->company->id;
            $job->title = $data['lg_title'];
            $job->category = $data['lg_cate'];
            $job->qty = $data['lg_qty'];
            $job->rank = $data['lg_rank'];
            $job->form_time_work = $data['lg_time_work'];
            $job->city = $data['lg_city'];
            $job->address = $data['lg_addr'];
            $job->currency = $data['lg_money'];
            $job->money_type = $data['new_money_type'];
            $job->money_min = $data['new_money_min'] ? str_replace('.','',$data['new_money_min']) : null;
            $job->money_max = $data['new_money_max'] ? str_replace('.','',$data['new_money_max']) : null;
            $job->money_kg = isset($data['new_money_kg']) ? $data['new_money_kg'] : NULL;
            $job->description = $data['lg_descirption'];
            $job->experience = $data['lg_experience'];
            $job->degree = $data['lg_degree'];
            $job->gender = $data['lg_gender'];
            $job->request_other = $data['lg_request_other'];
            $job->benefits_enjoyed = $data['lg_benefits_enjoyed'];
            $job->job_application = $data['lg_job_application'];
            $job->created_at = Carbon::now();
            $job->save();

        } catch (\Exception $e) {
            Log::error("Error store job", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $request->all(),       
            ]);
        }
    }

    public function show($id) {
        $job = Job::where('id', $id)
                ->with(['company' => function($query){
                    $query->select('id','name','phone','address','path');
                }])->first();
        $job->increment('views', 1);
        return $job;
    }

    public function list() {
        $jobs = Job::select('id', 'title', 'category', 'qty','money_type','money_min','money_max' ,'views', 'updated_at')
                    ->where('user_id', Auth::user()->id)
                    ->get();
        return $jobs;
    }

    public function edit($id) {
        $job = Job::find($id);

        return $job;
    }

    public function update(Request $request) {
        try {
            $data = $request->except('_token');
            $job = Job::find($data['id']);
            $job->title = $data['lg_title'];
            $job->category = $data['lg_cate'];
            $job->qty = $data['lg_qty'];
            $job->rank = $data['lg_rank'];
            $job->form_time_work = $data['lg_time_work'];
            $job->city = $data['lg_city'];
            $job->address = $data['lg_addr'];
            $job->currency = $data['lg_money'];
            $job->money_type = $data['new_money_type'];
            $job->money_min = $data['new_money_min'] ? str_replace('.','',$data['new_money_min']) : null;
            $job->money_max = $data['new_money_max'] ? str_replace('.','',$data['new_money_max']) : null;
            $job->money_kg = isset($data['new_money_kg']) ? $data['new_money_kg'] : NULL;
            $job->description = $data['lg_descirption'];
            $job->experience = $data['lg_experience'];
            $job->degree = $data['lg_degree'];
            $job->gender = $data['lg_gender'];
            $job->request_other = $data['lg_request_other'];
            $job->benefits_enjoyed = $data['lg_benefits_enjoyed'];
            $job->job_application = $data['lg_job_application'];
            $job->updated_at = Carbon::now();
            $job->save();
        } catch (\Exception $e) {
            Log::error('Error update job', [
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $request->all(),    
            ]);
        }
    }

    public function destroy($id) {
        try {
            Job::withTrashed()->where('id', $id)->forceDelete();
        } catch (\Exception $e) {
            Log::error('Error destroy job', [
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $request->all(),    
            ]);
        }
    }

    public function like(Request $request) {
        try {
            $data = $request->except('_token');
            $user_id = Auth::user()->id;
            $job = Job::find($data['_id']);
            if($job->checkLike()) {
                $job->likes()->detach($user_id);
            }else{
                $job->likes()->attach($user_id);
            }
            
            return $job;
        } catch (\Exception $e) {
            Log::error('Error like job', [
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $request->all(),    
            ]);
            return false;
        }
    }
}