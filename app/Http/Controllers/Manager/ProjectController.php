<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
         $projects = Project::with('client')->latest()->get();
         $clients = Client::where('status', 'approved')->get();

        return view('Manager.project.index', compact('projects', 'clients'));
    }

       public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'project_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        Project::create([
            'client_id' => $request->client_id,
            'project_name' => $request->project_name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'new'
        ]);

        return redirect()->back()->with('success','Project Created Successfully');}
}
