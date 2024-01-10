<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CompanyService;

class EmployerController extends Controller
{
    private $company;
    public function __construct(CompanyService $companyService) {
        $this->company = $companyService;
    }

    public function index() {
        $companies = $this->company->index();

        return view('admin.employer.index', [
            'companies' => $companies,
        ]);
    }

    public function updateStatus($id) {
        $this->company->updateStatus($id);

        return back();
    }
}
