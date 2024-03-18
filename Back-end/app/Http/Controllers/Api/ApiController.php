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

        $teachers = Teacher::with('user')->get();

        // // Recupera i ruoli dell'utente dalla tabella ponte
        // $roles = $teachers->roles;

        // // Oppure, se vuoi accedere direttamente alla tabella ponte senza passare per il modello
        // $pivotData = $teachers->roles()->pivot->where('custom_field', 'value')->get();


        return response()->json([
            'status' => 'success',
            'teachers' => $teachers,
            
        ]);
    }

    public function getSubjects()
    {

        $teachers = Teacher::with('user')->get();

        return response()->json([
            'status' => 'success',
            'teachers' => $teachers,
            
        ]);
    }
}
