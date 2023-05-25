<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function test()
    {
        exec('py ' . public_path('scripts/main.py') . ' ' . '50', $output);
        dd($output);
    }
}
