<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $tasks = Task::orderBy("priority",'ASC')->paginate(10);
        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        try {
            $task = Task::create($request->validated());
            if ($task) {
                return redirect()->route('task.index')->withSuccess('Task created successfully');
            } else {
                return back()->withError('something went wrong');
            }
        } catch (\Exception $ex) {
            return back()->withError('something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @return View
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        try {
            $task->update($request->validated());
            return redirect()->route('task.index')->withSuccess('Task updated successfully');

        } catch (\Exception $ex) {
            return back()->withError('something went wrong');
        }
    }

    /**
     * Update priority.
     * @return Response
     */
    public function taskSortable(Request $request): Response
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            foreach ($request->order as $order) {
                if ($order['id'] == $task->id) {
                    $task->update(['priority' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        try {
            $task->delete();
            return back()->withSuccess('Task deleted successfully');
        } catch (\Exception $ex) {
            return back()->withError('something went wrong');
        }
    }
}
