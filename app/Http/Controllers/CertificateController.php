<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Symfony\Component\HttpFoundation\Response;

class CertificateController extends Controller
{
    public function download(Enrollment $enrollment): Response
    {
        if ($enrollment->student_id !== auth()->id()) {
            abort(403);
        }

        if ($enrollment->status !== 'completed' || ! $enrollment->certificate) {
            abort(400, 'Course is not completed yet.');
        }

        $certificate = $enrollment->certificate;
        $course = $enrollment->course;
        $student = $enrollment->student;

        return response()->view('certificates.view', compact('certificate', 'course', 'student'));
    }
}
