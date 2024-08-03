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
        'required_document'
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
        return $this->hasMany(Documents::class, 'student_id', 'student_id');
    }

    public function scopeByDepartment($query, $department_id)
    {
            return $query->whereHas('enrollments', function ($query) use ($department_id) {
                $query->where('department_id', $department_id );
            });
        
    }


    /**
     * Get the count of u records.
     *
     * @return array
     */
    public function getDocumentStatusAttribute(): array
    {
        $studentRequiredDocument = 'A' . $this->required_document;
        //dd($studentRequiredDocument);

        // Fetch Document Categories
        $fileCategories = DocumentCategory::where(function ($query) use ($studentRequiredDocument) {
            foreach (str_split($studentRequiredDocument) as $char) {
                $query->orWhere('required_student', 'LIKE', '%' . $char . '%');
            }
        })->get();
        //dd($fileCategories);

        //$fileCategories = DocumentCategory::all();  
        $requiredDocumentTypes = $fileCategories->pluck('id')->toArray();  

        $requiredDocumentCount = count($requiredDocumentTypes);
        $this->load('documents');
        $presentDocumentTypes = $this->documents->pluck('type')->unique()->toArray();
        $submittedDocumentCount = count($presentDocumentTypes);
        $lackingDocumentTypes = array_diff($requiredDocumentTypes, $presentDocumentTypes);
        $complete = $requiredDocumentCount === $submittedDocumentCount;
    
        return [
            "is_complete" => $complete,
            "status" => $complete ? "Completed" : "Incomplete",
            "lacking" => [
                'count' => count($lackingDocumentTypes),
                'documents' => DocumentCategory::find($lackingDocumentTypes)->pluck('type')->toArray(),
            ],
            "completed" => [
                'count' => $submittedDocumentCount,
                'documents' => DocumentCategory::find($presentDocumentTypes)->pluck('type')->toArray()
            ]
        ];
    }

    public function scopeDocumentByType($query, $categoryId)
    {
        return $query->whereHas('documents', function ($query) use ($categoryId) {
            $query->where('type', $categoryId);
        });
    }

    // In the Student model
    public function updateDocumentStatus()
    {
        // Calculate document status as before
        $status = $this->getDocumentStatusAttribute();

        // Update the 'is_complete' column in the database
        $this->is_complete = $status['is_complete'];
        $this->save();
    }

    
    public function scopeStatus($query, $status = null)
    {
        if($status){
            return $query->where('is_complete', $status === 'complete');
        }
        return $query;
    }
}
