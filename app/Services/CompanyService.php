<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Company;
use Log;
use Str;
use Storage;
use Carbon\Carbon;

class CompanyService
{
    private $company;

    public function __construct() {
        $this->company = new Company();
    }

    public function show($id) {
        $company = Company::find($id);

        return $company;
    }

    public function update(Request $request) {
        try {
            $data = $request->except('_token');
            $company = Company::find($data['id']);

            if(isset($data['name'])) {
                $company->name = $data['name'];
            }
            if(isset($data['phone'])) {
                $company->phone = $data['phone'];
            }
            if(isset($data['address'])) {
                $company->address = $data['address'];
            }
            if(isset($data['introduce'])) {
                $company->introduce = $data['introduce'] == 'null' ? NULL : $data['introduce'];
            }

            $company->save();
            return true;
        } catch (\Exception $e) {
            Log::error("Error update company", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $request->all(),       
            ]);
            return false;     
        }
        
    }

    public function updateImage(Request $request) {
        try {
            $data = $request->except('_token');
            if($request->hasFile('file')) {
                $this->handleUploadCompanyImages($request->file('file'), $data['id']);
            }
            return true;

        } catch (\Exception $e) {
            Log::error("Error upload company images", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $request->all(),       
            ]);
            return false;     
        }
       
    }

    private function handleUploadCompanyImages($data, $id) {
        try {
            $random = Str::random(40);
            $file = $data;
            $name = $file->getClientOriginalName();
            $name = current(explode('.',$name));
            $name_image = $name.$random.'.'.$file->getClientOriginalExtension();
            $path = Storage::disk('public') ->putFileAs('companies', $file, $name_image);

            $company = Company::find($id);
            if(!empty($company->path)) {
                Storage::disk($company->disk)->delete($company->path);
            }
            $company->path = $path;
            $company->save();

            return true;

        } catch (Exception $e) {
            Log::error("Error upload post images", [ 
                "method" => __METHOD__,                
                "line" => __LINE__,                    
                "message" => $e->getMessage(),
                "data" => $data,       
            ]);
            return false;                                  
        }
    }
}