<div class="card search-warpper mb-2">
  <div class="card-body">
    <form action="{{$url}}" method="get" id="filter-form">
      <div class="row mb-3">
        <div class="col-sm-12 col-md-5 mb-3 mb-md-0 px-1">
          <input type="text" class="form-control" placeholder="Search student id or user created/deleted by" name="main_query"  value="{{$request->input('main_query') }}">
        </div>
        <div class="col-sm-6 col-md-4 mb-3 mb-md-0 px-1">
          <select class="form-select form-control" name="type">
            <option selected value="">Select Type</option>
            @foreach(getDocumentCategories() as $category)
             <option value="{{ $category->id }}" {{ $request->input('type') == $category->id ? 'selected' : '' }}>{{ $category->type }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-12 col-md-2 my-3 my-md-0 px-1">
          <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-sm-12 col-md-1 px-1">
            <button type="button" class="btn btn-primary w-100" id="clear-search-button">Clear</button>
        </div>
      </div>
    </form>
  </div>
</div>