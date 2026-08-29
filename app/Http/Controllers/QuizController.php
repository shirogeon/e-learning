<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizController extends Controller
{
    public function show(Quiz $quiz): Response
    {
        $quiz->load(['questions.options', 'module.course']);
        $latestAttempt = QuizAttempt::where('student_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->latest()
            ->first();

        return response()->view('quizzes.show', compact('quiz', 'latestAttempt'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|exists:options,id',
        ]);

        $questions = $quiz->questions;
        $totalQuestions = $questions->count();
        $correctAnswers = 0;

        foreach ($questions as $question) {
            $submittedOptionId = $request->answers[$question->id] ?? null;
            if ($submittedOptionId) {
                $option = Option::find($submittedOptionId);
                if ($option && $option->is_correct) {
                    $correctAnswers++;
                }
            }
        }

        $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

        QuizAttempt::create([
            'student_id' => $request->user()->id,
            'quiz_id' => $quiz->id,
            'score' => $score,
            'completed_at' => now(),
        ]);

        return redirect()->route('courses.learn', [
            'course' => $quiz->module->course->slug,
        ])->with('success', "Quiz completed! Your score: {$score}%");
    }
}
