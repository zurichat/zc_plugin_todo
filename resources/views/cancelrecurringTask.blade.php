<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Cancel recurring task</title>
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 90px;
                height: 34px;
                }

                .switch input {display:none;}

                .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ca2222;
                -webkit-transition: .4s;
                transition: .4s;
                border-radius: 34px;
                }

                .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
                border-radius: 50%;
                }

                input:checked + .slider {
                background-color: #2ab934;
                }

                input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
                }

                input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(55px);
                }

                /*------ ADDED CSS ---------*/
                .slider:after
                {
                content:'OFF';
                color: white;
                display: block;
                position: absolute;
                transform: translate(-50%,-50%);
                top: 50%;
                left: 50%;
                font-size: 10px;
                font-family: Verdana, sans-serif;
                }

                input:checked + .slider:after
                {  
                content:'ON';
                }
        </style>
    </head>

    <body>
        <div class="w-100 h-100 d-flex justify-content-center align-items-center">
            <form action="{{--url('/api/cancel_recurringTask/')--}}" method="post">
                @csrf
                <label class="switch">
                    <input type="hidden" name="taskId" value="{{$id}}">
                    <label class="switch">
                        <input type="checkbox" name="active" id="togBtn" checked>
                        <div class="slider round"></div>
                    </label>
                <button class="btn btn-success" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </body>
</html>
