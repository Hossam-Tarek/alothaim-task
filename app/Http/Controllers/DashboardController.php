<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('dashboard.index', [
            'usersCount' => User::user()->count(),
            'tasksCount' => Task::query()->count(),
        ]);
    }
}
