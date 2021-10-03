<?php

namespace App\Services;
use App\Services\TodoService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TaskReminderService
{    
    /**
     * todoService
     *
     * @var TodoService
     */
    protected $todoService;
        
    /**
     * __construct
     *
     * @param  TodoService $todoService
     * @return void
     */
    function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }
        
    /**
     * createReminder
     *
     * @param  mixed $data
     * @return void
     */
    public function createReminder(array $data)
    {
        $todo = collect($this->todoService->find($data['todo_id']));
        $task_key = $this->getTaskKeyByTaskIDFromTodo($todo, $data['task_id']);
        $reminder = $this->getFormattedReminderAttr($data);

        // rebuild task array with updated reminder
        $tasks = (array)$todo['tasks'];
        $todo_attr = $this->rebuildUpdateTodoAttributes($tasks, $reminder, $task_key, $todo);
        return response()->json($this->todoService->updateTodo($todo_attr, $data['todo_id'], config('user_id')));
    }
    
    /**
     * getTaskByIDFromTodo
     *
     * @param  Collection $todo
     * @param  string $task_id
     * @return array
     */
    private function getTaskKeyByTaskIDFromTodo(Collection $todo, $task_id) : int
    {
        foreach ($todo->get('tasks') as $key  => $task) {
            if($task['task_id'] == $task_id){
                return $key;
            }
        }
    }
    
    /**
     * getFormattedReminderAttr
     *
     * @param  array $data
     * @return array
     */
    private function getFormattedReminderAttr($data): array
    {
        $reminder = [];
        if(isset($data['time_string']) && $data['time_string']){
            $reminder[] = $this->formatReminder($data, true);
        }else{
            $reminder[] = $this->formatReminder($data, false);
        }
        return $reminder;
    }
    
    /**
     * formatReminder
     *
     * @param  mixed $data
     * @param bool $use_time_string
     * @return array
     */
    private function formatReminder($data, $use_time_string):array
    {
        $date = null;
        $time = null;

        if($use_time_string){
            $date_string = date('Y-m-d H:i:s', strtotime($data['time_string']));
            $time = $this->getTimeFromDateString($date_string);
            $date = $this->getDateFromDateString($date_string);
        }else{
            $time = $data['time'];
            $date = $data['date'];
        }

        return [
            'id'   => Str::uuid(),
            'time' => $time,
            'date' => $date,
            'note' => $data['note']
        ];
        
    }
    
    /**
     * getTimeFromDateString
     *
     * @param  string $date_string
     * @return string
     */
    private function getTimeFromDateString($date_string):string
    {
        return explode(' ', $date_string)[1];
    }
        
    /**
     * getDateFromDateString
     *
     * @param  string $date_string
     * @return void
     */
    private function getDateFromDateString($date_string): string
    {
        return explode(' ', $date_string)[0];
    }
    
    /**
     * rebuildUpdateTodoAttributes
     *
     * @param  array $tasks
     * @param  array $reminder
     * @param  string $task_key
     * @param  Collection $todo
     * @return Collection
     */
    private function rebuildUpdateTodoAttributes($tasks, $reminder, $task_key, $todo)
    {   
        $tasks = $this->rebuildTasks($task_key, $reminder, $tasks);
        $todo = $todo->replace(['tasks' => $tasks])->toArray();
        unset($todo["_id"]); // remove _id from array values
        return $todo;
    }
    
    /**
     * rebuildTasks
     *
     * @param  string $task_key
     * @param  array $reminder
     * @param  array $tasks
     * @return array
     */
    private function rebuildTasks($task_key, $reminder, $tasks):array
    {
        if(isset($tasks[$task_key]['reminder']) && is_array($tasks[$task_key]['reminder']) && count($tasks[$task_key]['reminder']) >= 1){
            $tasks[$task_key]['reminder'][] = $reminder[0];
        }else{
            $tasks[$task_key]['reminder'] = $reminder;
        }
        // reset array indexes
        $tasks[$task_key]['reminder'] = array_values($tasks[$task_key]['reminder']);

        return $tasks;
    }
    
    /**
     * removeReminder
     *
     * @param  array $data
     * @return void
     */
    public function removeReminder(array $data)
    {
        $todo = collect($this->todoService->find($data['todo_id']));
        $task_key = $this->getTaskKeyByTaskIDFromTodo($todo, $data['task_id']);

        $remainingReminders = $this->removeReminderFromList($task_key, $data, $todo);

        // rebuild task array with updated reminder
        $tasks = (array)$todo['tasks'];
        // update reminder
        $tasks[$task_key]['reminder'] = $remainingReminders;
        // reset array values
        $tasks[$task_key]['reminder'] = array_values($tasks[$task_key]['reminder']);

        $todo = $todo->replace(['tasks' => $tasks])->toArray();
        unset($todo["_id"]); // remove _id from array values

        return response()->json($this->todoService->updateTodo($todo, $data['todo_id'], config('user_id')));
    }
    
    /**
     * This returns a collection of reminders, without the deleted reminder
     *
     * @param  int $task_key
     * @param  mixed $data
     * @return void
     */
    private function removeReminderFromList($task_key, $data, $todo)
    {
        if(isset($todo['tasks'][$task_key]['reminder']) && is_array($todo['tasks'][$task_key]['reminder']) && count($todo['tasks'][$task_key]['reminder']) > 0) {
            $filtered = collect($todo['tasks'][$task_key]['reminder'])->filter(function ($value, $key) use ($data) {
                return $data['reminder_id'] !== $value['id'];
            });
    
            return $filtered->all();
        }
        abort(500,"Something went wrong");
    }

    public function commandHandler()
    {
        // get all todo
        // foreach todo check for reminders
        // if reminders 
        //    convert date time to timestamp
        //    if datetime timestamp < now
        //    notification should be triggered
        $todos = collect($this->todoService->all());

        $filtered = $todos->filter(function ($value, $key) {
            // get all todo with task
            return isset($value['tasks']) && is_array($value['tasks']) && count($value['tasks']) > 0;// && array_key_exists('reminder', $value['tasks']);
        });
        
        $filtered_todos = collect(array_values($filtered->all()));

        $filtered = $filtered_todos->filter(function ($value, $key) {
            // get all todo with task
            return isset($value['tasks']) && is_array($value['tasks']) && count($value['tasks']) > 0;// && array_key_exists('reminder', $value['tasks']);
            // return isset($value['tasks']) && is_array($value['tasks']) && count($value['tasks']) > 0 && in_array('reminder', $value['tasks']);
        });

        dd($filtered);
        
    }
}
