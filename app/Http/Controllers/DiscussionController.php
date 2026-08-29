<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'message' => 'required|string',
            'parent_id' => 'nullable|exists:discussions,id',
        ]);

        Discussion::create([
            'course_id' => $course->id,
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Message posted to discussion forum!');
    }
}
