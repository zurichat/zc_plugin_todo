{
    "apps": [{
        "name": "laravel-app",
        "script": "artisan",
        "args": ["serve", "--host=0.0.0.0", "--port=3333"],
        "instances": "1",
        "wait_ready": true,
        "autorestart": false,
        "max_restarts": 1,
        "interpreter" : "php",
        "watch": true,
        "error_file": "log/err.log",
        "out_file": "log/out.log",
        "log_file": "log/combined.log",
        "time": true
    }]
}
