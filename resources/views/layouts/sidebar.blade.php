
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
    <img src="{{asset('assets/img/logo.png')}}" alt class="w-px-40 h-auto rounded-circle" />

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
       <!-- <li class="menu-item ">
          <li class="menu-item">
            <a href="{{ url('student/records') }}"class="menu-link">
              <div data-i18n="CRM">Students Records</div>
            </a>
          </li>
        -->
          <li class="menu-item">
            <a href="{{ url('enrollment/records') }}"class="menu-link">
              <div data-i18n="CRM">Students Records</div>
            </a>
          </li>
          <!-- <li class="menu-item ">
            <a href="{{url('graduating/applicants')}}" class="menu-link ">
              <div data-i18n="Analytics">Graduating Applicants</div>
            </a>
          </li> -->
    </ul>
    <li class="menu-header medium text-uppercase">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <span class="menu-header-text">Document/Files</span>
    </li>
    <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="{{ url('documents/records') }}"class="menu-link">
              <div data-i18n="CRM">Document Records</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('documents/trash') }}" class="menu-link">
              <div data-i18n="Analytics">Trash</div>
            </a>
          </li>
          @if (Auth::guard('web')->user()->role===Config::get('user.roles.admin'))
          <li class="menu-item ">
            <a href="{{url('documents/transactions')}}" class="menu-link ">
              <div data-i18n="Analytics">Transactions</div>
            </a>
          </li>
          @endif
    </ul>
    @if (Auth::guard('web')->user()->role===Config::get('user.roles.admin'))
    <div class="menu-inner-shadow"></div>
      <li class="menu-header medium text-uppercase">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <span class="menu-header-text">Settings</span>
      </li>
      <ul class="menu-inner py-1">
            <li class="menu-item">
              <a href="{{ url('settings/user') }}"class="menu-link">
                <div data-i18n="CRM">Users / Staff</div>
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
                <div data-i18n="Analytics">Document Categories</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="{{ url('settings/studentType') }}" class="menu-link">
                <div data-i18n="Analytics">Student Type</div>
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
          
      </ul>
    @endif
  </aside>