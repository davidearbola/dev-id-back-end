<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        $data = [
            'technologies' => $technologies
        ];
        return view('admin.technologies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'icon' => 'required'
        ]);

        $newLanguage = new Technology();
        $newLanguage->fill($data);
        $newLanguage->save();

        return redirect()->route('admin.technologies.show', $newLanguage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        $data = [
            'technology' => $technology
        ];
        return view('admin.technologies.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $data = [
            'technology' => $technology
        ];

        return view('admin.technologies.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'icon' => 'required'
        ]);
        $technology->update($data);
        return redirect()->route('admin.technologies.show', $technology);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index');
    }
}
