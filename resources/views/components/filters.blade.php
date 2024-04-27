<div class="card search-warpper mb-2">
  <div class="card-body">
    <form action="{{$url}}" method="get" id="filter-form">
      <div class="row mb-3">
        <div class="col-sm-12 col-md-5 mb-3 mb-md-0 px-1">
          <input type="text" class="form-control" placeholder="Search ID number or Student Name" name="student_query"  value="{{$request->input('student_query') }}">
        </div>
        <div class="col-sm-6 col-md-2 mb-3 mb-md-0 px-1">
          <select class="form-select form-control" name="school_year">
            <option selected value="">School Year</option>
            @foreach(getSchoolYear() as $sy)
              <option value="{{ $sy->id }}" {{ $request->input('school_year') == $sy->id ? 'selected' : '' }}>{{ $sy->year }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6 col-md-2 mb-3 mb-md-0 px-1">
          <select class="form-select form-control" name="semester">
            <option selected value="">Semester</option>
            @foreach(config('student.semester'); as $key => $sem)
              <option value="{{ $key}}" {{ $request->input('semester') == $key ? 'selected' : '' }}>{{ $sem}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-12 col-md-3 mb-md-0 px-1">
          <select class="form-select form-control"  name="department" id="department">
            <option selected value="">Choose Department</option>
            @foreach(getDepartments() as $dept)
              <option value="{{ $dept->id }}" {{ $request->input('department') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-3 px-1">
        <input type="hidden" value="{{ old('course') }}" id="course-value">
          <select class="form-select form-control" name="course">
            <option selected value="">Choose Course</option>
            @foreach(getCourses() as $course)
              <option value="{{ $course->id }}" {{ $request->input('course') == $course->id ? 'selected' : '' }}>{{ $course->code }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6 col-md-2 mb-3 mb-md-0 px-1">
        <input type="hidden" value="{{ old('major') }}" id="major-value">
          <select class="form-select form-control" name="major">
            <option selected value="">Choose Major</option>
            @foreach(getMajors() as $major)
              <option value="{{ $major->id }}" {{ $request->input('major') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6 col-md-2 mb-1 mb-md-0  px-1">
          <select class="form-select form-control" name="year_level">
            <option selected value="">Year Level</option>
            @foreach(config('student.year_level'); as $key => $level)
              <option value="{{ $key}}" {{ $request->input('year_level') == $key ? 'selected' : '' }}>{{ $level}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6 col-md-2 mb-1 mb-md-0  px-1">
          <select class="form-select form-control" name="section">
            <option selected value="">Section</option>
            @foreach(getSections() as $section)
              <option value="{{ $section->id }}" {{ $request->input('section') == $section->id ? 'selected' : '' }}>{{ $section->name }} ({{ $section->sched }})</option>
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