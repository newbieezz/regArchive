<?php

namespace App\Services;

use DB;
use Hash;
use Exception;
use Carbon\Carbon;
use App\Models\DocumentCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class DocumentCategoryService
{
    /**
     * @var App\Models\DocumentCategory
     */
    protected $documentCategory;

    /**
     * UserService constructor.
     *
     * @param App\Models\DocumentCategory $user
     */
    public function __construct(DocumentCategory $documentCategory)
    {
        $this->documentCategory = $documentCategory;
    }

    /**
     * Creates a new category in the database
     *
     * @param array $params
     */
    public function create(array $params): DocumentCategory
    {
        try {
            $category = $this->documentCategory->create($params);

        } catch (Exception $e) {
            throw $e;
        }

        return $category;
    }

    /**
     * Updates category in the database
     */
    public function update(array $params): DocumentCategory
    {
        // retrieve category information
        $category = $this->findById($params['id']);
        // perform update
        $category->update($params);

        return $category;
    }

    
    /**
     * Deletes the major in the database
     */
    public function delete(int $id): bool
    {
        // retrieve category
        $category = $this->findById($id);

        // perform delete
        $category->delete();

        return true;
    }


    /**
     * Retrieves a category by id
     */
    public function findById(int $id): DocumentCategory
    {
        // retrieve the category
        $category = $this->documentCategory->find($id);

        if (!($category instanceof DocumentCategory)) {
            throw new ModelNotFoundException('DocumentCategory with ID: '.$id.' not found!');
        }

        return $category;
    }

    public function findByRequiredStudent(string $required_student)
    {
        // retrieve the categories

        $fileCategories = $this->documentCategory->where(function ($query) use ($required_student) {
            foreach (str_split($required_student) as $char) {
                $query->orWhere('required_student', 'LIKE', '%' . $char . '%');
            }
        })->get();

        return $fileCategories;
    }

    /**
     * List all document categories from database
     *
     */
    public function listAll()
    {
        try {
            $categories =  $this->documentCategory->orderBy('type', 'ASC')->get();
        } catch (Exception $e) {
            throw $e;
        }

        return $categories;
    }
}