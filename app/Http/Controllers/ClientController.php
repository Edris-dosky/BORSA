<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $clients =  Client::with(['user'])->get();
        return view('client.index' ,compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'type' => 'required|string|in:Person,Company',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // Optional image validation
        ]);
    
        // Handle file upload using Request::file()
        $path = null;
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            // Using Request::file() to get the uploaded file
            $file = $request->file('picture');
            
            // Generate a unique filename for the image
            $filename = time() . '.' . $file->getClientOriginalExtension();
            
            // Store the image in 'public/images' directory and get the path
            $path = $file->storeAs('images', $filename, 'public'); // Store in 'public/images' directory
            
            // Debugging: Check the path
            \Log::info('File stored at: ' . $path);
        } else {
            // Debugging: Log if no file is uploaded or file is invalid
            \Log::info('No file uploaded or file is invalid.');
        }
    
        // Insert the client associated with the authenticated user
        Client::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'type' => $request->input('type'),
            'picture' => $path ? 'storage/' . $path : null, // Store the relative path
            'user_id' => Auth::id(), // Directly associate the user ID with the client
        ]);
        
        // Redirect back or to the client index page with a success message
        return redirect()->route('client.index')->with('success', 'Client added successfully!');
    }
                
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        //
    }
}
