<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DocumentCategory;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documents extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'type',
        'file_name',
        'file_path',
        'added_by',
        'expiration',
    ];


    public function category() : BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'type')->withTrashed();
    }

    public function deletedByUser() : BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function addedByUser() : BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
