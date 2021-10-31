<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoSearchController extends Controller
{
    public function search(Request $request)
    {
        $q = strtolower($request->q);

        $todos = collect((new TodoService)->all());

        $searchResult = $todos->filter(function ($item, $key) use ($q) {
            return str_contains(strtolower($item['title']), $q);
        });

        return response()->json([
            'message' => 'Search results',
            'count' => count($searchResult->toArray()),
            'data' => array_values($searchResult->toArray())
        ]);
    }
}
