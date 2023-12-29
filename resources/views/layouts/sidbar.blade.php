            <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
                <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3"
                    data-toggle="toggle">
                    <i class="fe fe-x"><span class="sr-only"></span></i>
                </a>
                <nav class="vertnav navbar navbar-light">
                    <!-- nav bar -->
                    <div class="w-100 mb-4 d-flex">
                        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/">
                            <svg version="1.1" id="logo" class="navbar-brand-img brand-sm"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                y="0px" viewBox="0 0 120 120" xml:space="preserve">
                                <g>
                                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                                </g>
                            </svg>
                        </a>
                    </div>
                    <ul class="navbar-nav flex-fill w-100 mb-2">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
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
                        <li class="nav-item dropdown  {{ request()->is('invoice*') ? 'active' : '' }}">
                            <a href="#forms" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle nav-link">
                                <i class="fe fe-credit-card fe-16"></i>
                                <span class="ml-3 item-text"> ادارة الفواتير</span>
                            </a>
                            <ul class="collapse list-unstyled pl-4 w-100  {{ request()->is('invoice*') ? 'show' : '' }}"
                                id="forms">
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="{{ route('invoice.index') }}">
                                        <span class="ml-1 item-text">قائمة الفواتير</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="{{ route('invoice.archive') }}">
                                        <span class="ml-1 item-text">الارشيف</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Reborts  --}}
                        <li class="nav-item dropdown">
                            <a href="#charts" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle nav-link">
                                <i class="fe fe-pie-chart fe-16"></i>
                                <span class="ml-3 item-text">التقارير</span>
                            </a>
                            <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="./chart-inline.html"><span
                                            class="ml-1 item-text">Inline Chart</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="./chart-chartjs.html"><span
                                            class="ml-1 item-text">Chartjs</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="./chart-apexcharts.html"><span
                                            class="ml-1 item-text">ApexCharts</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="./datamaps.html"><span
                                            class="ml-1 item-text">Datamaps</span></a>
                                </li>
                            </ul>
                        </li>
                        {{-- Users --}}
                        <li class="nav-item dropdown">
                            <a href="#profile" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle nav-link">
                                <i class="fe fe-user fe-16"></i>
                                <span class="ml-3 item-text">المستخدمين</span>
                            </a>
                            <ul class="collapse list-unstyled pl-4 w-100" id="profile">
                                <a class="nav-link pl-3" href="./profile.html"><span class="ml-1">Overview</span></a>
                                <a class="nav-link pl-3" href="./profile-settings.html"><span
                                        class="ml-1">Settings</span></a>
                                <a class="nav-link pl-3" href="./profile-security.html"><span
                                        class="ml-1">Security</span></a>
                                <a class="nav-link pl-3" href="./profile-notification.html"><span
                                        class="ml-1">Notifications</span></a>
                            </ul>
                        </li>
                        {{-- Settings --}}
                        <li class="nav-item dropdown {{ request()->is('setting*') ? 'active' : '' }}">
                            <a href="#settings" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle nav-link">
                                <i class="fe fe-tool fe-16"></i>
                                <span class="ml-3 item-text">الاعدادات</span>
                            </a>
                            <ul class="collapse list-unstyled pl-4 w-100 {{ request()->is('setting*') ? 'show' : '' }}"
                                id="settings">
                                <a class="nav-link pl-3" href="{{ route('section.index') }}"><span
                                        class="ml-1">الاقسام</span></a>
                                <a class="nav-link pl-3" href="{{ route('product.index') }}"><span
                                        class="ml-1">المنتجات</span></a>
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
