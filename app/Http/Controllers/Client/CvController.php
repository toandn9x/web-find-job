<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyCv;
use App\Models\User;
use App\Models\Job;
use App\Models\FindJob;
use App\Models\SaveCv;
use App\Traits\ResponseTrait;
use App\Events\SendNotification;
use App\Http\Controllers\Client\NotificationController;
use Storage;
use Auth;
use Str;
use Log;
use Carbon\Carbon;

class CvController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $cvs = MyCv::with(['user'])
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('status', 'desc')
                    ->get();
        $pdf_url = [];

        foreach($cvs as $cv) {
            $pdf_url[] = [
                'id' => $cv->id,
                'cv' => Storage::url($cv->path),
                'status' => $cv->status,
                'user'=> [
                    'id' => $cv->user->id,
                    'name' => $cv->user->name,
                ],
                'created_at' => $cv->created_at,
            ];
        }

        return view('workwise.cv.candidate.index', [
            'pdf_url' => $pdf_url,
        ]);
    }

    public function uiCvApply() {

        $user = User::with(['jobs' => function($query) {
                                $query->orderByDesc('job_user.created_at', "DESC");
                            }])
                            ->where('id', Auth::user()->id)->first();
        return view('workwise.cv.candidate.list-apply', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $cv = new MyCv();
        $cv->user_id = Auth::user()->id;

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $name = current(explode('.',$name));
            $name_image = $name.Str::random(40).'.'.$file->getClientOriginalExtension();
            $path = Storage::disk('public') ->putFileAs('cv', $file, $name_image);

            $cv->path = $path;
        }

        if($this->checkNumberCv()) {
            $cv->status = 1;
        }

        $cv->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $cv->save();

        return $cv ? $this->responseSuccess() : $this->responseError();
    }

    public function updateMainCv(Request $request)
    {
        $data = $request->except('_token');
        
        MyCv::where(['user_id' => Auth::user()->id, 'status' => 1])->update(['status' => 0]);

        $save = MyCv::where('id', $data['id'])->update(['status' => 1]);

        return $save ? $this->responseSuccess() : $this->responseError();
    }

    public function destroy($id)
    {
        
    }

    public function uiManageCv() {
        $jobs = Job::with(['users'])
                    ->where('user_id', Auth::user()->id)
                    ->get();
        
        return view('workwise.cv.employer.index', [
            'jobs' => $jobs,
        ]);
    }

    public function apply(Request $request) {
        $data = $request->except('_token');

        if(!$this->checkNumberCv()) {
            $user = User::find(Auth::user()->id);
            $job = Job::find($data['idJob']);

            // if(count($user->jobs) > 0) {
            // $check = $user->jobs()->where([
            //     'job_id' => $data['idJob'],
            // ])->latest('created_at')->first();
            // }
            // return $check->status;
            // die();
            
            // if($check && $check->pivot->status != 0) {
                $user->jobs()->attach($data['idJob'], [
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
                ]);
               
                $dataEvent['name_sender'] = $user->name;
                $dataEvent['recipient_id'] = $job->user_id;
                $dataEvent['sender_id'] = $user->id;
                $dataEvent['image_sender'] = $user->userInfo->CheckEmptyImage();
                $dataEvent['content'] = "Ứng viên " . $dataEvent['name_sender'] . " đã ứng tuyển vào công việc " . $job->title;
                $dataEvent['path_route'] = "/cv/manage-cv";

                event(new SendNotification($dataEvent));
                NotificationController::store($dataEvent);
            // }

            // return $check ? $this->responseSuccess([], 'Bạn đã ứng tuyển công việc này trước đó rồi.', 1) : $this->responseSuccess();
            return $this->responseSuccess();
        }

        return $this->responseSuccess([], 'Bạn chưa có CV trong phần quản lý. Xin hãy tải CV lên để ứng tuyển.', 2);
    }

    public function findJob(Request $request) {

        try {
            $data = $request->except('_token');
            $user = Auth::user();
            $findJob = $user->findJob;
            
            if($this->checkNumberCv()) {
                return $this->responseSuccess([], 'Vui lòng cập nhật CV của bạn lên để nhà tuyển dụng có thể liên hệ.', 1);
            }
            if($findJob) {
                $findJob->jobs = $data['jobs'];
                $findJob->address = $data['address'];
                $save = $findJob->save();
            }else {
                $find = new FindJob();
                $find->user_id = $user->id;
                $find->jobs = $data['jobs'];
                $find->address = $data['address'];
                $save = $find->save();
            }

            if($user->status_cv == 0) {
                User::where('id', $user->id)->update(['status_cv' => 1]);
            }

            return $save ? $this->responseSuccess() : $this->responseError();

        } catch (\Exception $e) {
            Log::error('Error find job', [
                'method' => __METHOD__,
                'line' => __LINE__,
                'message' => $e->message(),
                'data' => $request->all(),
            ]);
        }
    }

    //Xem các Cv ứng tuyển
    public function viewCandidate(Request $request) {
        $data = $request->except('_token');

        $job = Job::select('id', 'title')->where('id', $data['id'])->first();

        foreach($job->users as $user) {
            $user['cv'] = $user->cvs()->where('status', 1)->first()->path_url;
            $user['date_format'] = date('H:m', strtotime($user->pivot->created_at)) .' ngày '. date('d/m/Y', strtotime($user->pivot->created_at));
            $user['status_apply'] = $user->pivot->status == 0 ? "Đang chờ xét duyệt" : ($user->pivot->status == 1 ? "Hẹn phỏng vấn" : ($user->pivot->status ==  2 ? "Hồ sơ không phù hợp" : "Ứng tuyển thành công"));
            $user['status_value'] = $user->pivot->status;
            $user['time_interview'] = $user->pivot->time_interview;
        }

        return $job ? $this->responseSuccess($job) : $this->responseError();
    }


    //Tìm kiếm ứng viên
    public function findCandidate() {
        $candidates = User::where([
                                                'role' => User::ROLE['CANDIDATE'],
                                                'status_cv' => 1
                                            ])->get();
        return view('workwise.cv.employer.find-candidate', [
            'candidates' => $candidates,
        ]);
    }

    public function uiSaveCv() {
        $profiles = SaveCv::where('company_id', Auth::user()->company->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('workwise.cv.employer.save-cv', [
            'profiles' => $profiles,
        ]);
    }

    // Lưu hồ sơ ứng viên
    public function saveCv($id) {
        $cv = MyCv::where([
                'user_id' => $id,
                'status' => 1
        ])->first();

        if($cv) {
            $newSave = new SaveCv();
            $newSave->user_id = $id;
            $newSave->company_id = Auth::user()->company->id;
            $newSave->path = $cv->path_url;
            $newSave->save();
        }else {
            return $this->responseSuccess([], 'Ứng viên này chưa cập nhật CV', 1);
        }

        return $this->responseSuccess();
    }

    //Cập nhật trạng thái hồ sơ của ứng viên
    public function updateCvCandidate(Request $request) {
        $data = $request->except('_token');

        $user = User::find($data['userId']);
        $user->jobs()->updateExistingPivot(
                $data['jobId'], 
                ['status' => $data['valueStatus']]
        );
        if($data['time'] != '') {
            $user->jobs()->updateExistingPivot(
                $data['jobId'], 
                ['time_interview' => $data['time']]
            );
        }
        
        $job = Job::find($data['jobId']);

        $dataEvent['recipient_id'] = $user->id;
        $dataEvent['sender_id'] = $job->user_id;
        $dataEvent['name_sender'] = $job->company->name;
        $dataEvent['image_sender'] = $job->company->image_url;
        $dataEvent['path_route'] = "/cv/cv-apply";

        if($data['valueStatus'] == 1) {
            $dataEvent['content'] = "Nhà tuyển dụng " . $dataEvent['name_sender'] . " đã cập nhật CV của bạn ở trạng thái hẹn phỏng vấn.";
        }else if($data['valueStatus'] == 2) {
            $dataEvent['content'] = "Nhà tuyển dụng " . $dataEvent['name_sender'] . " đã cập nhật CV của bạn ở trạng thái hồ sơ không phù hợp.";
        }else {
            $dataEvent['content'] = "Nhà tuyển dụng " . $dataEvent['name_sender'] . " đã cập nhật CV của bạn ở trạng thái ứng tuyển thành công.";
        }

        NotificationController::store($dataEvent);
        event(new SendNotification($dataEvent));

        return $this->responseSuccess();
    }

    private function checkNumberCv() {
        $checkNumberCv = count(Auth::user()->cvs) <= 0 ? true : false;

        return $checkNumberCv;
    }
}
