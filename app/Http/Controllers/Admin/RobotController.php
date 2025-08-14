<?php

namespace App\Http\Controllers\Admin;

use App\Models\Robot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RobotController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $robot = Robot::first();

        if ($robot) {
            $robot->update(['content' => $request->content]);
        } else {
            Robot::create(['content' => $request->content]);
        }

        return redirect()->back()->with('toast', ['message' => 'Robot.txt updated successfully', 'type' => 'success']);
    }

    // Serve the robots.txt file
    public function serve()
    {
        $robot = Robot::first();
        $content = $robot ? $robot->content : "User-agent: *\nAllow: /";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
