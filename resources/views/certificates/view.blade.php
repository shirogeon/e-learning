<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion - {{ $course->title }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
            }
            .certificate-container {
                box-shadow: none !important;
                border-width: 12px !important;
                margin: 0 auto !important;
                max-width: 100% !important;
            }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col justify-between p-6 sm:p-12 font-sans antialiased text-slate-900">
    <!-- Top Action Bar -->
    <div class="no-print max-w-4xl mx-auto w-full mb-6 flex justify-between items-center">
        <a href="{{ route('student.dashboard') }}" class="text-sm font-bold text-amber-600 hover:text-amber-700 flex items-center space-x-1">
            <span>&larr; Back to Dashboard</span>
        </a>
        <button onclick="window.print()" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-black rounded-xl shadow-md shadow-amber-500/10 text-sm transition duration-200 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            <span>Print Certificate / Save PDF</span>
        </button>
    </div>

    <!-- Luxury Certificate Diploma Frame -->
    <div class="certificate-container max-w-4xl mx-auto w-full bg-white border-[14px] border-amber-900/90 p-8 sm:p-16 text-center relative shadow-2xl rounded-2xl my-auto">
        <!-- Inner Gold Border -->
        <div class="absolute top-3 left-3 right-3 bottom-3 border-2 border-amber-400 pointer-events-none rounded-lg"></div>

        <!-- Header -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-50 border-2 border-amber-500 text-amber-600 mb-4 shadow-inner">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <h1 class="text-4xl sm:text-5xl font-black tracking-widest uppercase text-slate-900 font-serif-display mb-1">
                Certificate of Completion
            </h1>
            <p class="text-xs uppercase tracking-widest text-amber-700 font-bold font-sans">
                Official Credential Verification
            </p>
        </div>

        <p class="text-slate-500 italic text-base sm:text-lg mb-4 font-serif">
            This certificate is proudly awarded to
        </p>

        <h3 class="text-3xl sm:text-4xl font-black text-slate-950 border-b-2 border-amber-500/50 pb-3 max-w-md mx-auto mb-8 font-serif-display">
            {{ $student->name }}
        </h3>

        <p class="text-slate-600 text-sm sm:text-base max-w-lg mx-auto mb-10 leading-relaxed font-sans">
            for successfully mastering all curriculum modules, passing comprehensive evaluations, and completing the coursework for:
            <strong class="text-amber-900 text-xl sm:text-2xl mt-3 block font-serif-display font-black">{{ $course->title }}</strong>
        </p>

        <!-- Footer Signatures & Credential Info -->
        <div class="flex flex-col sm:flex-row justify-between items-center sm:items-end border-t border-slate-200 pt-8 max-w-2xl mx-auto gap-6 sm:gap-0 font-sans">
            <div class="text-center sm:text-left">
                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold">Issue Date</span>
                <span class="text-sm font-bold text-slate-800 font-mono">{{ $certificate->issued_at->format('M d, Y') }}</span>
            </div>

            <div class="text-center">
                <div class="font-serif italic text-amber-900 font-bold text-xl border-b border-amber-600 pb-1 px-6">
                    {{ $course->teacher->name }}
                </div>
                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold mt-1">Instructor Signature</span>
            </div>

            <div class="text-center sm:text-right">
                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold">Certificate ID</span>
                <span class="text-xs font-mono font-black text-amber-700 bg-amber-50 px-2 py-1 rounded border border-amber-200 block mt-0.5">{{ $certificate->certificate_code }}</span>
            </div>
        </div>
    </div>

    <!-- Footer Disclaimer -->
    <div class="no-print text-center text-xs text-gray-400 mt-6">
        &copy; {{ date('Y') }} {{ config('app.name', 'E-Learning Portal') }}. Validated on Supabase Cloud.
    </div>
</body>
</html>
