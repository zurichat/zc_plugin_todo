<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
    $tasks = [
        "name"=> "Clean the house",
        "author" => "Billy Hans",
        "date" => "13/02/2015",
        "priority" => "high"
    ];
    print_r(json_encode($tasks));
    ?>


    <form action="/task-priority" method="POST">
    @csrf
    <input type="text" name="priority" placeholder="new priority"/>
    <button>Submit</button>
    </form>
</body>
</html>