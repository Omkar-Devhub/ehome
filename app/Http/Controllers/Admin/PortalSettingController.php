<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortalSettingController extends Controller
{
    public function index()
    {
        return view('backend.admin.portal_setting.index');
    }
}
