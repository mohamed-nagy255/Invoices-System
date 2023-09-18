            <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
                <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                <i class="fe fe-x"><span class="sr-only"></span></i>
                </a>
                <nav class="vertnav navbar navbar-light">
                <!-- nav bar -->
                <div class="w-100 mb-4 d-flex">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/">
                    <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                        <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                        </g>
                    </svg>
                    </a>
                </div>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                        <a href="/" class="nav-link">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text">الرئيسية</span>
                        </a>
                    </li>
                </ul>
                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>الفواتير</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    {{-- <li class="nav-item dropdown">
                    <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-box fe-16"></i>
                        <span class="ml-3 item-text">UI elements</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-color.html"><span class="ml-1 item-text">Colors</span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-typograpy.html"><span class="ml-1 item-text">Typograpy</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-icons.html"><span class="ml-1 item-text">Icons</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-buttons.html"><span class="ml-1 item-text">Buttons</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-notification.html"><span class="ml-1 item-text">Notifications</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-modals.html"><span class="ml-1 item-text">Modals</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-tabs-accordion.html"><span class="ml-1 item-text">Tabs & Accordion</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./ui-progress.html"><span class="ml-1 item-text">Progress</span></a>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-item w-100">
                    <a class="nav-link" href="widgets.html">
                        <i class="fe fe-layers fe-16"></i>
                        <span class="ml-3 item-text">Widgets</span>
                        <span class="badge badge-pill badge-primary">New</span>
                    </a>
                    </li> --}}
                    <li class="nav-item dropdown">
                    <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-credit-card fe-16"></i>
                        <span class="ml-3 item-text"> ادارة الفواتير</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_elements.html"><span class="ml-1 item-text">Basic Elements</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_advanced.html"><span class="ml-1 item-text">Advanced Elements</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_validation.html"><span class="ml-1 item-text">Validation</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_wizard.html"><span class="ml-1 item-text">Wizard</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_layouts.html"><span class="ml-1 item-text">Layouts</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./form_upload.html"><span class="ml-1 item-text">File upload</span></a>
                        </li>
                    </ul>
                    </li>
                    {{-- <li class="nav-item dropdown">
                    <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-grid fe-16"></i>
                        <span class="ml-3 item-text">Tables</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./table_basic.html"><span class="ml-1 item-text">Basic Tables</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./table_advanced.html"><span class="ml-1 item-text">Advanced Tables</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./table_datatables.html"><span class="ml-1 item-text">Data Tables</span></a>
                        </li>
                    </ul>
                    </li> --}}
                    <li class="nav-item dropdown">
                    <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-pie-chart fe-16"></i>
                        <span class="ml-3 item-text">التقارير</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./chart-inline.html"><span class="ml-1 item-text">Inline Chart</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./chart-chartjs.html"><span class="ml-1 item-text">Chartjs</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./chart-apexcharts.html"><span class="ml-1 item-text">ApexCharts</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link pl-3" href="./datamaps.html"><span class="ml-1 item-text">Datamaps</span></a>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#profile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                            <i class="fe fe-user fe-16"></i>
                            <span class="ml-3 item-text">المستخدمين</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="profile">
                            <a class="nav-link pl-3" href="./profile.html"><span class="ml-1">Overview</span></a>
                            <a class="nav-link pl-3" href="./profile-settings.html"><span class="ml-1">Settings</span></a>
                            <a class="nav-link pl-3" href="./profile-security.html"><span class="ml-1">Security</span></a>
                            <a class="nav-link pl-3" href="./profile-notification.html"><span class="ml-1">Notifications</span></a>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                            <i class="fe fe-tool fe-16"></i>
                            <span class="ml-3 item-text">الاعدادات</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="settings">
                            <a class="nav-link pl-3" href="./profile.html"><span class="ml-1">Overview</span></a>
                            <a class="nav-link pl-3" href="./profile-settings.html"><span class="ml-1">Settings</span></a>
                            <a class="nav-link pl-3" href="./profile-security.html"><span class="ml-1">Security</span></a>
                            <a class="nav-link pl-3" href="./profile-notification.html"><span class="ml-1">Notifications</span></a>
                        </ul>
                    </li>
                </ul>
                
                <div class="btn-box w-100 mt-4 mb-1">
                    <a href="#" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
                    <i class="fe fe-phone-missed fe-12 mr-2"></i><span class="small">تواصل معنا</span>
                    </a>
                </div>
                </nav>
            </aside>