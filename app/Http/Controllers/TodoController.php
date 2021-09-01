<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

/**
 * class TodoController extends Controller
 * @author Atoyebi, Ajibola (atoyebieniola93@gmail.com|Ajibola03)
 */
class TodoController extends Controller
{

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Create todo and save to the database.
     * @author Atoyebi, Ajibola (atoyebieniola93@gmail.com|Ajibola03)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'end_date' => 'required|max:255',
            'workspace_id' => 'required|max:255',
            'category_id' => 'required|max:255',
        ]);
        $data = $request->except('_method', '_token');
        $data['status_id'] = $request->input('status_id', 1);
        $data['parent_id'] = $request->input('parent_id');
        $data['start_date'] = $request->input('start_date', date('Y-m-d'));
        $data['recurring'] = $request->input('recurring', false);
        $data['reminder'] = $request->input('reminder');
        $response = response()->json($this->taskService->create($data));
        return redirect()->back()->with('sent', boolval($response));
    }

    //TODO: Test frontend link to be modified;
    public function showPage()
    {
        return view('test');
    }
}
