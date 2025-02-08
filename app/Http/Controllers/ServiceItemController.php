<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Workorder;

use Illuminate\Http\Request;

class ServiceItemController extends Controller
{
    public function index()
    {
        $data = Workorder::where('user_id', null)
                    ->get();
            echo json_encode($data);
    }
}
