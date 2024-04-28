<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documents extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'type',
        'file_name',
        'file_path',
        'added_by',
    ];

    /**
     * Retrieves the document category 
     *
     * @return App\Models\DocumentCategory
     */
    public function category()
    {
        return $this->belongsTo(DocumentCategory::class)->withTrashed();
    }
}
