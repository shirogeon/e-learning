<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController extends Controller
{
    public function store(Request $request, Assignment $assignment)
    {
        $request->validate([
            'text_content' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10MB max
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions');
        }

        Submission::updateOrCreate(
            [
                'assignment_id' => $assignment->id,
                'student_id' => $request->user()->id,
            ],
            [
                'file_path' => $filePath,
                'text_content' => $request->text_content,
                'submitted_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Assignment submitted successfully!');
    }

    public function gradeShow(Submission $submission): Response
    {
        if ($submission->assignment->module->course->teacher_id !== auth()->id()) {
            abort(403);
        }

        return response()->view('teacher.submissions.grade', compact('submission'));
    }

    public function gradeStore(Request $request, Submission $submission)
    {
        if ($submission->assignment->module->course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $submission->update([
            'grade' => $request->grade,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('teacher.dashboard')->with('success', 'Submission graded successfully!');
    }
}
