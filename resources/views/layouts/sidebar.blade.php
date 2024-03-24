
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="javascript:void(0);" class="app-brand-link">
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
            <a href="{{ url('studRecords') }}"class="menu-link">
              <div data-i18n="CRM">Students Records</div>
              <div class="badge bg-danger rounded-pill ms-auto">5</div>
            </a>
          </li>
          <li class="menu-item ">
            <a href="" class="menu-link menu-toggle">
              <div data-i18n="Analytics">College Department</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ url('collegeDept') }}" class="menu-link">
                  <div data-i18n="Without menu">College of Education</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="{{ url('enrollmentRec') }}" class="menu-link">
              <div data-i18n="Analytics">Enrollment Records</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('gradApplicants') }}" class="menu-link">
              <div data-i18n="Analytics">Graduating Applicants</div>
            </a>
          </li>
    </ul>
    <div class="menu-inner-shadow"></div>
    @if (Auth::guard('web')->user()->role=="SuperAdmin")
      <li class="menu-header medium text-uppercase">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <span class="menu-header-text">Settings</span>
      </li>
      <ul class="menu-inner py-1">
            <li class="menu-item">
              <a href="{{ url('users') }}"class="menu-link">
                <div data-i18n="CRM">Users / Staff</div>
                <div class="badge bg-danger rounded-pill ms-auto">5</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="{{ url('categories') }}" class="menu-link">
                <div data-i18n="Analytics">Categories/Requirements</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('trash') }}" class="menu-link">
                <div data-i18n="Analytics">Trash</div>
              </a>
            </li>
      </ul>
    @endif

  </aside>