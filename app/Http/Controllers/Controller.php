<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /** @var array */
    public $response;
    
    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->response = ['code' => 200];
    }
}
