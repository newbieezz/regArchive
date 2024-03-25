@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Categories/Requirements for Enrollment</h5>
        <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody >
                <tr>
                    <td><span class="fw-medium">1</span> </td>
                    <td><span class="fw-medium">Form 137</span> </td>
                    <td>Category Descrption</td>
                    <td></td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                        >
                        </div>
                    </div>
                    </td>
                </tr>
            </tbody>
            <tfoot class="table-border-bottom-0">
                <tr>
                  <th class="rounded-start-bottom"><button class="btn btn-primary">
                    <a href="{{url('addCategory')}}" style="color: white">Click to Add</a></button></th>
                </tr>
              </tfoot>
        </table>
        </div>
    </div>
</div>
@endsection