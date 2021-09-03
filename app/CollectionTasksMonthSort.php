<?php

namespace App;

use App\Http\Controllers\TodoController;
use Cron\MonthField;
// extends TodoController
class collectionTasksMonthSort {
    public function taskmonth()
    {
// SIMULATE A JSON STRING (BASED ON YOUR DATA) TO BE CONVERTED TO PHP OBJECT
    // JUST FOR TESTING PURPOSES...
    
    $apiResponse = 
    '[
        {
            "date": {
                "date": "2016-08-03 08:17:18.000000",
                "timezone_type": 3,
                "timezone": "CET"
            },
            "taskTitle": "Page 1",            
            "details": 27
        },
        {
            "date": {
                "date": "2016-08-03 08:17:18.000000",
                "timezone_type": 3,
                "timezone": "CET"
            },
            "taskTitle": "Page 3",            
            "details": 27
        },
        {
            "date": {
                "date": "2016-09-03 08:17:18.000000",
                "timezone_type": 3,
                "timezone": "CET"
            },
            "taskTitle": "Page 4",            
            "details": 27
        },
        {
            "date": {
                "date": "2016-09-03 08:17:18.000000",
                "timezone_type": 3,
                "timezone": "CET"
            },
            "taskTitle": "Page 2",           
            "details": 13
        }
    ]';


    $data   = json_decode($apiResponse); //<== WHERE $apiResponse IS YOUR RESPONSE
  
    $sorted = [];
    // $date = new date();
    foreach($data as $k=>$item){
            
        $M  = current(explode(" ", $item->date->date));
        if(!array_key_exists($M, $sorted)){
            $sorted[$M]              = $item;
        }else{
            $details  = $sorted[$M]->details;         
            $taskTitle  = $sorted[$M]->taskTitle;
            $sorted[$M]->details   = $details + $item->details;           
            $sorted[$M]->task_title  = ($taskTitle != $item->taskTitle) ?
                                                ($taskTitle . ", {$item->taskTitle}") : $taskTitle;
        }
    }


    return json_encode($sorted);



    }
}
