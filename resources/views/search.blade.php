<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <input placeholder="Search field" id="query" type="text"><button onclick="searchHandler()">Search</button>
        <p>Search Results in JSON:</p>
        <pre id="codeblock"></pre>


        <script>
            function searchHandler() {
                var query = $('#query').val();

                $.getJSON('api/v1/demo-search?organisation_id=613a3ac959842c7444fb0240&q=' + query, function (res) {
                    $('#codeblock').html(JSON.stringify(res.data, undefined, 2))
                });
            }

        </script>
    </body>
</html>
