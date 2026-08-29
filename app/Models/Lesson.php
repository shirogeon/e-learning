<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['module_id', 'title', 'content_text', 'video_url', 'attachment_path', 'order'])]
class Lesson extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function completedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lesson_completed', 'lesson_id', 'student_id')
            ->withTimestamps();
    }
}
