<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * class TodoController extends Controller
 * @author Atoyebi, Ajibola (atoyebieniola93@gmail.com|Ajibola03)
 */
class TodoController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'end_date' => 'required|max:255',
            'workspace_id' => 'required|max:255',
            'category_id' => 'required|max:255',
        ]);
        $data = $request->except('_method', '_token');
        $data['status_id'] = $request->input('status_id', 1);
        $data['parent_id'] = $request->input('parent_id');
        $data['start_date'] = $request->input('start_date', date('Y-m-d'));
        $data['recurring'] = $request->input('recurring', false);
        $data['reminder'] = $request->input('reminder');
        $data['email'] = "eve.holt@reqres.in";
        $data['password'] = "pistol";
        $response = Http::post('https://reqres.in/api/register', $data);
        if ($response->successful()) {
            return redirect()->back()->with('sent', true);
        }
        return $request->except('_method', '_token');
    }

    public function show()
    {
        return view('test');
    }
}
