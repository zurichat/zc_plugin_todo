<?php

namespace App\Http\Controllers;

use App\Repositories\HTTP\HTTPRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller

{
    protected $httpRepository;

    public function __construct(HTTPRepository $HTTPRepository)
    {
        $this->httpRepository = $HTTPRepository;
    }




    public function writeTest() {

        $response = Http::post('https://api.zuri.chat/data/write');

        return $this->httpRepository->store(1,[
            'Todo' => 'MyFirstTodo',
            'Date' => '01-09-2021'

        ]);
    }


//    public function testWrite($endpoint, $message)
//    {
//        $post = Http::post('https://api.zuri.chat/data/write', [
//            'userId' => 1,
//            'title' => 'New Post Title',
//            'body' => 'This is a new post description'
//        ]);
//        return $post->json();
//    }


}
