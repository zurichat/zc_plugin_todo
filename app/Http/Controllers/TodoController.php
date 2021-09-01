<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\VarDumper\VarDumper;

/**
 * class TodoController extends Controller
 * @author Atoyebi, Ajibola (atoyebieniola93@gmail.com|Ajibola03)
 */
class TodoController extends Controller
{
    public function create(Request $request)
    {
        // VarDumper::dump($request->except('_method', '_token'));
        // die;
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            // 'status_id' => 'required|max:255',
            // 'parent_id' => 'required|max:255',
            'end_date' => 'required|max:255',
            // 'start_date' => 'required|max:255',
            'workspace_id' => 'required|max:255',
            'category_id' => 'required|max:255',
            // 'priority_id' => 'required',
            // 'recurring' => "required",
            // 'reminder' => 'required',
            // 'color_code' => "required",
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
