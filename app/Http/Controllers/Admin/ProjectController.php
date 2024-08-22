<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('technologies')->get();
        $data = [
            'projects' => $projects
        ];

        return view('admin.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        $data = [
            'types' => $types,
            'technologies' => $technologies
        ];

        return view('admin.projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'site_url' => 'required',
            'thumb_path' => 'image',
            'type_id' => 'required',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $data['slug'] = Str::slug($request->name, '-');

        if ($request->has('thumb_path')) {
            $thumb_path = Storage::put('uploads', $request->thumb_path);
            $data['thumb_path'] = $thumb_path;
        }

        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();

        if (isset($data['technologies'])) {
            $newProject->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $data = [
            'project' => $project
        ];

        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        $projTech = $project->technologies->pluck('id')->toArray();
        $data = [
            'project' => $project,
            'types' => $types,
            'technologies' => $technologies,
            'projectTechnology' => $projTech
        ];

        return view('admin.projects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'site_url' => 'required',
            'thumb_path' => 'image',
            'type_id' => 'required',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $data['slug'] = Str::slug($request->name, '-');

        if ($request->has('thumb_path')) {
            $thumb_path = Storage::put('uploads', $request->thumb_path);
            $data['thumb_path'] = $thumb_path;

            if ($project->thumb_path && !Str::startsWith($project->thumb_path, 'http')) {
                Storage::delete($project->thumb_path);
            }
        }

        $project->update($data);

        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->thumb_path && !Str::startsWith($project->thumb_path, 'http')) {
            Storage::delete($project->thumb_path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
