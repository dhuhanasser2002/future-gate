<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\StudentRequest;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->Authorize('viewAny', Project::class);
        $studentrequest = StudentRequest::where('approved', False);
        $projects = Project::all();
        return view('projects.index', compact('projects','studentrequest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->Authorize('create', Project::class);
        $studentrequest = StudentRequest::where('approved', False);
        return view('projects.create',compact('studentrequest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'technique'=>'required',
            'description'=>'required',
            'github'=>'required',
            'mainimage'=>'image|mimes:jpeg,png,jpg,gif',
        ]);
        $project = new Project();
        $project->title = $request->input('title');
        $project->technique = $request->input('technique');
        $project->description = $request->input('description');
        $project->github = $request->input('github');
        $project->user_id = auth()->user()->id;
        if($request->hasFile('mainimage')){
            $mainimage = $request->file('mainimage');
            $mainimagename = time().".".$mainimage->getClientOriginalExtension();
            $mainimage->move(public_path('images'), $mainimagename);
            $project->mainimage = $mainimagename;
        }
        $project->save();
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $image_name);

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $image_name,
                ]);
            }
            
        }
        return redirect()->route('projects.index')->with('project created successfuly');
        }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        $studentrequest = StudentRequest::where('approved', False);
        return view('projects.show', compact('project','studentrequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        $studentrequest = StudentRequest::where('approved', False);
        return view('edit.project', compact('project','studentrequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'=>'required',
            'technique'=>'required',
            'description'=>'required',
            'github'=>'required',
            'mainimage'=>'image|mimes:jpeg,png,jpg,gif',
        ]);
        $project->title = $request->input('title');
        $project->technique = $request->input('teqhnique');
        $project->description = $request->input('description');
        $project->github = $request->input('github');
        $project->user_id = auth()->user()->id;
        if($request->hasFile('mainimage')){
            $mainimage = $request->file('mainimage');
            $mainimagename = time().".".$mainimage->getClientOriginalExtension();
            $mainimage->move(public_path('images'), $mainimagename);
            $project->mainimage = $mainimagename;
        }
        $project->save();
        return redirect()->route('projects.index')-with('project created successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('projects.index')->with('project deleted successfuly');
    }
}
