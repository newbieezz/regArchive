
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
    <img src="{{asset('assets/img/logo.png')}}" alt class="w-px-40 h-auto rounded-circle" />

    @if (Auth::guard('web')->user()->password_default===0)
    <a href="{{url('dashboard')}}" class="app-brand-link">
      <span class="demo menu-text fw-bold ms-2"><h4>Registrar-Archive</h4></span>
    </a>
    @else
    <span class="demo menu-text fw-bold ms-2"><h4>Registrar-Archive</h4></span>
    @endif
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    @if (Auth::guard('web')->user()->password_default===0)
    <div class="menu-inner-shadow"></div>
    <li class="menu-header medium text-uppercase">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <span class="menu-header-text">Records/Files</span>
    </li>
    <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="{{ url('enrollment/') }}"class="menu-link">
              <div data-i18n="CRM">Student Records</div>
            </a>
          </li>
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
            <li class="menu-item ">
              <a href="{{ url('settings/role') }}" class="menu-link">
                <div data-i18n="Analytics">Roles</div>
              </a>
            </li>
          
      </ul>
    @endif   
    @else
    <div style="width: 100%; padding: 15px;">
      <div class="alert alert-warning" role="alert" style="width: 100%; padding: 15px; font-size: 16px; text-align: center;">
        <a href="{{url('update/'.Auth::guard('web')->user()->id)}}" class="app-brand-link" style="text-decoration: none; color: inherit;">
        To fully access, please change your default password.
        </a>
      </div>
    </div>
    @endif
  </aside>