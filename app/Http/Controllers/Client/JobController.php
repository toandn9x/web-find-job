<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JobService;
use Log;
use Auth;
use App\Models\Company;

class JobController extends Controller
{
    private $job;
    
    public function __construct(JobService $jobService) {
        $this->job = $jobService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = $this->job->index();
        return view('workwise.jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function list() {
        $jobs = $this->job->list();

        return view('workwise.jobs.list', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workwise.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->job->store($request);

        return redirect()->route('job.list')->with('success', 'Tạo mới tin thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = $this->job->show($id);
        return view('workwise.jobs.detail', [
            'job' => $job,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = $this->job->edit($id);

        return view('workwise.jobs.update', [
            'job' => $job,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $job = $this->job->update($request);

        return redirect()->route('job.list')->with('success', 'Chỉnh sửa tin thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->job->destroy($id);

        return back()->with('success', 'Xóa tin thành công.');
    }
}
