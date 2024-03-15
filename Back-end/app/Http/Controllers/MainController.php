<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();

        return view('welcome', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
        $teacher = new Teacher;
        $teacher->tax_id = $data['tax_id'];
        $teacher->biography = $data['biography'];
        $teacher->phone_number = $data['phone_number'];
        $teacher->city = $data['city'];
        $teacher->motto = $data['motto'];
        $img = $data['image_url'];
        $img_path = Storage::disk('public')->put('images', $img);
        $cv = $data['cv_url'];
        $cv_path = Storage::disk('public')->put('cvs', $cv);

        $teacher->image_url = $img_path;
        $teacher->cv_url = $cv_path;


        $user = Auth::user();
        $teacher->user()->associate($user);
        $teacher->save();

        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $teacher = $user->teacher()->first();
        return view('pages.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $teacher = $user->teacher()->first();
        return view('pages.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $teacher = $user->teacher()->first();
        $teacher->tax_id = $data['tax_id'];
        $teacher->biography = $data['biography'];
        $teacher->phone_number = $data['phone_number'];
        $teacher->city = $data['city'];
        $teacher->motto = $data['motto'];
        if ($request->hasFile('image_url')) {
            // Carica l'immagine e salva il percorso
            $img_path = $request->file('image_url')->store('images', 'public');

            // Aggiorna il percorso dell'immagine nel modello dell'insegnante
            $teacher->image_url = $img_path;
        }


        $teacher->user()->associate($user);
        $teacher->save();

        return redirect()->route('welcome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $teacher = $user->teacher()->first();
        $teacher->delete();
        return redirect()->route('welcome');
    }
}
