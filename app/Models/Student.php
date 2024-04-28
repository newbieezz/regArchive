<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DocumentCategory;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'middle_name',
        'home_address',
        'city_address',
        'contact_no',
        'email',
        'gender',
        'birthdate',
        'birth_address',
        'citizenship',
        'religion',
        'civil_status',
        'fathers_name',
        'fathers_occupation',
        'mothers_name',
        'mothers_occupation',
        'guardians_name',
        'guardian_contact',
        'primary',
        'primary_sy',
        'primary_awards',
        'secondary',
        'secondary_sy',
        'secondary_awards',
        'senior_high',
        'senior_high_sy',
        'senior_high_awards',
    ];

    protected $appends = ['document_status'];

    /**
     * Retrieve all enrollments under this student
     *
     * @return App\Models\Enrollment[]
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id', 'student_id')->withTrashed();
    }

    /**
     * Retrieve all enrollments under this student
     *
     * @return App\Models\Documents[]
     */
    public function documents()
    {
        return $this->hasMany(Documents::class, 'student_id', 'student_id')->withTrashed();
    }

    /**
     * Get the count of u records.
     *
     * @return array
     */
    public function getDocumentStatusAttribute(): array
    {
        // Retrieve all file categories
        $fileCategories = DocumentCategory::all();  

        // Get the types of all required documents
        $requiredDocumentTypes = DocumentCategory::all()->pluck('type')->toArray();  

        // Count the total number of required documents
        $requiredDocumentCount = count($requiredDocumentTypes);

        // Get the documents associated with this student
        $studentDocuments = $this->documents;

        // Get the documents associated with this student
        $studentDocumentIds = $this->documents->pluck('type')->unique()->toArray();

        // Get the corresponding types from DocumentCategory based on the IDs
        $presentDocumentTypes = DocumentCategory::whereIn('id', $studentDocumentIds)->pluck('type')->toArray();

        // Count the number of submitted documents
        $submittedDocumentCount = count($presentDocumentTypes);

        // Find the lacking document types
        $lackingDocumentTypes = array_diff($requiredDocumentTypes, $presentDocumentTypes);
        
        $complete = $requiredDocumentCount === $submittedDocumentCount ? true : false;

        return [
            "is_complete" => $complete,
            "status" => $complete ? "Completed" : "Incomplete",
            "lacking" => [
                'count' => count($lackingDocumentTypes),
                'documents' => $lackingDocumentTypes,
            ]
        ];
    }

}
