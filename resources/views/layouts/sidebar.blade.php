
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{url('dashboard')}}" class="app-brand-link">
        <span class="demo menu-text fw-bold ms-2"><h4>Registrar-Archive</h4></span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <li class="menu-header medium text-uppercase">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <span class="menu-header-text">Registrar Files</span>
    </li>
    <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="{{ url('student/records') }}"class="menu-link">
              <div data-i18n="CRM">Students Records</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('/enrollment') }}"class="menu-link">
              <div data-i18n="CRM">Enrollment Records</div>
            </a>
          </li>
          <li class="menu-item ">
            <a href="{{url('graduating/applicants')}}" class="menu-link ">
              <div data-i18n="Analytics">Graduating Applicants</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('documents/records') }}"class="menu-link">
              <div data-i18n="CRM">Document Records</div>
            </a>
          </li>
    </ul>
    <div class="menu-inner-shadow"></div>
      <li class="menu-header medium text-uppercase">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <span class="menu-header-text">Settings</span>
      </li>
      <ul class="menu-inner py-1">
          @if (Auth::guard('web')->user()->role===Config::get('user.roles.admin'))
            <li class="menu-item">
              <a href="{{ url('settings/user') }}"class="menu-link">
                <div data-i18n="CRM">Users / Staff</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('documents/records') }}"class="menu-link">
                <div data-i18n="CRM">Document Transactions</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="{{url('settings/department')}}" class="menu-link">
                <div data-i18n="Analytics">College Departments</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="{{ url('settings/course/')}}" class="menu-link">
                <div data-i18n="Analytics">Department Course</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="{{ url('settings/requirement') }}" class="menu-link">
                <div data-i18n="Analytics">Categories/Requirements</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="{{ url('settings/schoolyear') }}" class="menu-link">
                <div data-i18n="Analytics">School Year</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="{{ url('settings/section') }}" class="menu-link">
                <div data-i18n="Analytics">Class Sections</div>
              </a>
            </li>
          @endif
            <li class="menu-item">
              <a href="{{ url('settings/trash') }}" class="menu-link">
                <div data-i18n="Analytics">Trash</div>
              </a>
            </li>
            
      </ul>
   

  </aside>