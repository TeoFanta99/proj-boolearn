<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Message;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Subject;
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
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('pages.create', compact('teachers', 'subjects'));
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
        $teacher->motto = $data['motto'];
        $img = $data['image_url'];
        $img_path = Storage::disk('public')->put('images', $img);
        if ($request->hasFile('cv_url')) {
            $cv_path = $request->file('cv_url')->store('cvs', 'public');
            $teacher->cv_url = $cv_path;
        }

        $teacher->image_url = $img_path;
        $teacher->cv_url = $cv_path;


        $user = Auth::user();
        $teacher->user()->associate($user);
        $teacher->save();

        $materie = $request->input('subjects', []);

        // Associare le tipologie selezionate al ristorante
        // $restaurant = Auth::user()->restaurant;
        $teacher->subjects()->sync($materie);

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
      
        $teacher = Teacher::find($id);
        $ratings = Rating::all();

        return view('pages.show', compact('teacher', 'ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        $teacher = $user->teacher()->first();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('pages.edit', compact('teacher', 'subjects', 'teachers'));
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
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
       
        $teacher = $user->teacher()->first();
        $teacher->tax_id = $data['tax_id'];
        $teacher->biography = $data['biography'];
        $teacher->phone_number = $data['phone_number'];
        $teacher->motto = $data['motto'];
        if ($request->hasFile('image_url')) {
            // Carica l'immagine e salva il percorso
            $img_path = $request->file('image_url')->store('images', 'public');

            // Aggiorna il percorso dell'immagine nel modello dell'insegnante
            $teacher->image_url = $img_path;
        }
        if ($request->hasFile('cv_url')) {
            $cv_path = $request->file('cv_url')->store('cvs', 'public');
            $teacher->cv_url = $cv_path;
        }

        // Aggiorna la città direttamente sul modello dell'utente
        $user->city = $data['city'];
        $user->save();


        $teacher->user()->associate($user);
        $teacher->save();
        $materie = $request->input('subjects', []);

        // Associare le tipologie selezionate al ristorante
        // $restaurant = Auth::user()->restaurant;
        $teacher->subjects()->sync($materie);
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
        $messages = $teacher->messages;
        $reviews = $teacher->reviews;
        $subjects = $teacher->subjects;
        $ratings = $teacher->ratings;
        $sponsorships = $teacher->sponsorships;
        // Delete all associated messages
        foreach ($messages as $message) {
            $message->delete();
        }
        foreach ($reviews as $review) {
            $review->delete();
        }
        foreach ($subjects as $subject) {
            $subject->teacher()->detach();
        }
        foreach ($ratings as $rating) {
            $rating->teacher()->detach();
        }

        foreach ($sponsorships as $sponsorship) {
            $sponsorship->teachers()->detach();
        }

        $teacher->delete();
        return redirect()->route('welcome');
    }

    // Gestione messaggi,recensioni,sponsorizzazioni

    public function messages($id)
    {
        
        $teacher = Teacher::find($id);

        $messages = $teacher -> messages;

        return view('pages.messages', compact('teacher', 'messages'));
    }

    public function reviews($id)
    {
        
        $teacher = Teacher::find($id);

        $reviews = $teacher->reviews;

        return view('pages.reviews', compact('teacher', 'reviews'));
    }



}
