<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projectId = $request->input('projectId');
        $selectedProject = null;
        if ($projectId) {
            $selectedProject = Project::where("id", $projectId)->first();
        }

        if (!$selectedProject) {
            $selectedProject = Project::first();
        }

        $projects = Project::all();
        $tasks = [];
        if ($selectedProject) {
            $tasks = Task::where("project_id", $selectedProject->id)
                ->orderBy("priority", "asc")
                ->paginate(10);
        }
        
        return view('tasks.index', compact('tasks', 'projects', "selectedProject"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'project_id' => "required|exists:projects,id"
        ]);
    
        $leastPriorityTask = Task::where("project_id", $data['project_id'])
            ->orderBy("priority", "desc")->first();

        $data["priority"] = $leastPriorityTask ? $leastPriorityTask->priority + 1 : 0;
        Task::create($data);
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100'
        ]);
        
        $task->update($data);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    /**
     * Update the bulk specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiBulkUpdate(Request $request)
    {
        $data = $request->all();
        
        if (count($data)) {
            foreach ($data as $object) {
                $task = Task::where("id", $object["taskId"])->first();

                if ($task) {
                    $task->update([
                        "priority" => $object["priority"]
                    ]);
                }
            }
            $responseCode = SymfonyResponse::HTTP_OK;
        }
    
        $responseCode = SymfonyResponse::HTTP_OK;
        $response = [
            'httpCode' => $responseCode
        ];

        return response()->json(
            $response,
            $responseCode
        );
    }
}
