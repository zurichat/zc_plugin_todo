<?php

namespace App;

use App\Http\Controllers\TodoController;
use Cron\MonthField;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Http\Request;

class collectionTasksMonthSort {

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }


    public function sort(Request $request){
        $data = $request->all();
        // $data = $request->except('_method', '_token');
        // $data['start_date'] = $request->input('start_date', date('Y-m-d'));
        // $data['created_at'] = date('Y-m-d');
  
    // $data = $this;
    
    // $data   = json_decode($data);
    $sorted = [];
   
    foreach($data as $k=>$item){
            
        $M  = current(explode("_", $item->date));
        if(!array_key_exists($M, $sorted)){
            $sorted[$M]              = $item;
        }else{
            // $details  = $sorted[$M]->details;         
            $title  = $sorted[$M]->title;
            // $sorted[$M]->details   = $details + $item->details;           
            $sorted[$M]->title  = ($title != $item->title) ?
            ($title . ", {$item->title}") : $title;
        }
    }


    return json_encode($sorted);
    // return $sorted;



    }
}

  // {
    //     $sort = sort::make($request->all(), [
    //         'title' => 'required|max:255',
    //         'description' => 'required|max:255',
    //         'color_code' => 'required|max:255',
    //         'end_date' => 'required|max:255',
    //         'workspace_id' => 'required|max:255',
    //         'category_id' => 'required|max:255',
    //     ]);

    
    // $apiResponse = $this ;
   


    // $data   = json_decode($apiResponse);
