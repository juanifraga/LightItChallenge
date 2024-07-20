<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PatientRegistered;
use App\Notifications\PatientRegisteredNotification;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all(); 
        return response()->json($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName(); 
            $path = $file->storeAs('public/documents', $filename); 
            $url = Storage::url($path);
        } else {
            return response()->json(['error' => 'Document photo is required.'], 422);
        }
    
        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'document_photo_path' => $url, 
        ]);

        $patient->notify(new PatientRegisteredNotification($patient));    
        return response()->json($patient, 201);    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id); 
        $patient->delete();
        return response()->json(['message' => 'Patient successfully deleted.']);
    }
}
