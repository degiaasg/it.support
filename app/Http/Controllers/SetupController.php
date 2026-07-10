<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function general()
    {
        return view('setup.general');
    }

    public function email()
    {
        return view('setup.email');
    }

    public function backup()
    {
        return view('setup.backup');
    }

    public function auditLog()
    {
        return view('setup.audit-log');
    }
}
