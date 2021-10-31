<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="description" content="Zuri todo test page">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        <meta name="HandheldFriendly" content="true">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Todo Test Page</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        
        <div class="container">
        <h1>TODO TEST PAGE</h1>
            <div class="row">
                <div class="col-md-6">Create todo</div>
                <div id="createTodo" class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">Get todo</div>
                <div id="getTodo" class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">Create task in a todo</div>
                <div id="createTask" class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">Get task in a todo</div>
                <div id="getTask" class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">Get todo comment</div>
                <div id="getComment" class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">Get todo sidebar</div>
                <div id="getSidebar" class="col-md-6"></div>
            </div>
        </div>
        

        <script>
            function getSidebar() {
                $.ajax({
                url  : 'api/v1/sidebar?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7',
                type : 'get',
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#getSidebar').text('failed').css('color', 'red');
                },
                }).done(function(data, statusText, xhr){
                var status = xhr.status;   
                               //200
                if (status == 200) {
                    $('#getSidebar').text('ok').css('color', 'green');
                }else{
                    $('#getSidebar').text('failed').css('color', 'red');
                }
                }); 
            
            }

            function getTask() {
                $.ajax({
                url  : 'api/v1/task?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7',
                type : 'get',
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#getTask').text('failed').css('color', 'red');
                },
                }).done(function(data, statusText, xhr){
                var status = xhr.status;   
                               //200
                if (status == 200) {
                    $('#getTask').text('ok').css('color', 'green');
                }else{
                    $('#getTask').text('failed').css('color', 'red');
                }
                }); 
            
            }

            function createTodo() {
                $.ajax({
                url  : 'api/v1/create-todo?organisation_id=614679ee1a5607b13c00bcb7&user_id=614b453144a9bd81cedc0b25',
                type : 'post',
                data: {
                    "title":"hello",
                    "type":"prive"
                }
                }).done(function(data, statusText, xhr){
                    console.log(data);
                var status = xhr.status;                //200
                if (status == 200) {
                    $('#createTodo').text('ok').css('color', 'green');
                }else{
                    $('#createTodo').text('failed').css('color', 'red');
                }
                
                });
            }

            function getTodo() {
                $.ajax({
                url  : 'api/v1/user-todo?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7',
                type : 'get',
                }).done(function(data, statusText, xhr){
                var status = xhr.status; 
                console.log(status);           //200
                if (status == 200) {
                    $('#getTodo').text('ok').css('color', 'green');
                }else{
                    $('#getTodo').text('failed').css('color', 'red');
                }
                });
            }

            function getComment() {
                $.ajax({
                url  : 'api/v1/todo-comment/6154eb8c7f0874785c51cdf4?user_id=614f089fe35bb73a77bc2b77&organisation_id=614679ee1a5607b13c00bcb7',
                type : 'get',
                }).done(function(data, statusText, xhr){
                var status = xhr.status;                //200
                if (status == 200) {
                    $('#getComment').text('ok').css('color', 'green');
                }else{
                    $('#getComment').text('failed').css('color', 'red');
                }
                });
            }

            function createTask() {
                $.ajax({
                url  : 'api/v1/add-task/6166aeb6533276f1a384b8b7?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7',
                type : 'put',
                data:{
                    "title":"testing",
                    "recurring":0,
                },
                statusCode: {
                    404: function() {
                        $('#createTask').text('failed').css('color', 'red');
                    }
                }
                }).done(function(data, statusText, xhr){
                var status = xhr.status;               //200
                if (status == 200) {
                    $('#createTask').text('ok').css('color', 'green');
                }else{
                    $('#createTask').text('failed').css('color', 'red');
                }

                })
            }


            getComment();
            getTask();
            getTodo();
            createTodo();
            createTask();
            getSidebar();

        </script>
    </body>
</html>
