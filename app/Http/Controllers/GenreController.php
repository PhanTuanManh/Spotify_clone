<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre', compact('genres'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'required|string',
            // Add validation rules for other genre-related fields here
        ]);

        // Create a new genre instance
        $genre = new Genre();
        $genre->Name = $validatedData['name'];
        $genre->Description = $validatedData['descriptions'];
        // Set values for other genre-related fields here

        // Save the genre
        $genre->save();

        // Redirect back to the index page with a success message
        return redirect()->route('genre.index')->with('success', 'Genre added successfully');
    }


    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre-edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $genre = Genre::find($id);

        // Cập nhật thông tin nghệ sĩ
        $genre->Name = $request->input('name');
        $genre->Description = $request->input('descriptions');

        // Save the updated genre
        $genre->save();

        // Redirect back to the index page with a success message
        return redirect()->route('genre.index')->with('success', 'Genre updated successfully');
    }


    public function delete($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect('/genre')->with('status', 'Your data has been deleted');
    }
}
