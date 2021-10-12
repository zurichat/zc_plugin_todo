<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <p>Get sidebar:</p>
        <button onclick="testSideBarHandler()">Test</button>

        <p>Get Todo:</p>

        <button onclick="testTodoHandler()">Test</button>
        
        <span id="result2"></span>


        <script>
            function testSideBarHandler() {
                $.ajax({
                url  : 'api/v1/sidebar?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7',
                type : 'get',
                }).done(function(data, statusText, xhr){
                var status = xhr.status;                //200
                if (status == 200) {
                    $('#result').text('ok');
                    return "ok";
                }
                });
            }

            function testTodoHandler() {
                $.ajax({
                url  : 'api/v1/user-todo?user_id=614b453144a9bd81cedc0b25&organisation_id=614679ee1a5607b13c00bcb7',
                type : 'get',
                }).done(function(data, statusText, xhr){
                var status = xhr.status;                //200
                if (status == 200) {
                    $('#result2').text('ok');
                    return "ok";
                }
                });
            }
        </script>
    </body>
</html>
