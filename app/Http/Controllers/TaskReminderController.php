<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskReminder\AddReminderRequest;
use App\Services\TaskReminderService;
use Illuminate\Http\Request;

class TaskReminderController extends Controller
{
    public function addReminderToTask(Request $request, ?TaskReminderService $service)
    {
        $attributes = [
            'time_string' => $request->time_string,
            'time' => $request->time,
            'date' => $request->date,
            'note' => $request->note,
            'todo_id' => $request->todo_id,
            'task_id' => $request->task_id
        ];

        return response()->json($service->createReminder($attributes));
    }

    public function removeReminderFromTask(Request $request, ?TaskReminderService $service)
    {
        $attributes = [
            'reminder_id' => $request->reminder_id,
            'todo_id' => $request->todo_id,
            'task_id' => $request->task_id
        ];

        return response()->json($service->removeReminder($attributes));
    }

    public function commandHandler(?TaskReminderService $service)
    {
        return response()->json($service->commandHandler());
    }
}
