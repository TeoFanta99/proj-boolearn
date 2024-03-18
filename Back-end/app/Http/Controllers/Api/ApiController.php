<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getEvent()
    {

        return response()->json([

            'status' => 'success',
            'message' => 'Testo di prova',
        ]);
    }
    public function getTeachers()
    {

        
        $teachers = Teacher::all();

        return response()->json([
            'status' => 'success',
            'teachers' => $teachers,
            
        ]);
    }
}
