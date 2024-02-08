<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArgRequest;
use App\Models\Admin;
use App\Models\Ban;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function get()
    {
        $admins = Admin::all();

        return json_encode($admins);
    }

}
