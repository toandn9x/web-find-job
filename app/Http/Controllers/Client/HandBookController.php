<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HandBookService;
use App\Traits\ResponseTrait;
use App\Models\HandBook;

class HandBookController extends Controller
{
    use ResponseTrait;

    private $handbook;
    public function __construct(HandBookService $handbookService) {
        $this->handbook = $handbookService;
    }
    public function index() {
        $handbooksHot = $this->handbook->getIsHotHandBook();
        return view('workwise.handbook.index', [
            'handbooksHot' => $handbooksHot,
        ]);
    }

    public function detail($slug) {
        $data = $this->handbook->detail($slug);
       
        return view('workwise.handbook.detail', [
            'data' => $data,
        ]);
    }

    public function getHandBookPaginate() {
        $handbooks = $this->handbook->getHandBookPaginate();

        return $this->responseSuccess($handbooks);
    }
}
