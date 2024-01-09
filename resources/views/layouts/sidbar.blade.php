            <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
                <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3"
                    data-toggle="toggle">
                    <i class="fe fe-x"><span class="sr-only"></span></i>
                </a>
                <nav class="vertnav navbar navbar-light">
                    <!-- nav bar -->
                    <div class="w-100 mb-4 d-flex">
                        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/">
                            <img src="{{ asset('./assets/images/logo.png') }}"
                                class="navbar-brand-img brand-sm mx-auto mb-4" style="width: 100px" alt="..." />
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
                    <ul class="navbar-nav flex-fill w-100 mb-2">
                        @can('الفواتير')
                            <p class="text-muted nav-heading mt-4 mb-1">
                                <span>الفواتير</span>
                            </p>
                            <li class="nav-item dropdown  {{ request()->is('invoice*') ? 'active' : '' }}">
                                <a href="#forms" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle nav-link">
                                    <i class="fe fe-credit-card fe-16"></i>
                                    <span class="ml-3 item-text"> ادارة الفواتير</span>
                                </a>
                                <ul class="collapse list-unstyled pl-4 w-100  {{ request()->is('invoice*') ? 'show' : '' }}"
                                    id="forms">
                                    <li class="nav-item">
                                        <a class="nav-link pl-3 {{ request()->is('invoice/invoice_table/invoice_all') ? 'nav-active' : '' }}
                                        {{ request()->is('invoice/invoice_insert') ? 'nav-active' : '' }}
                                        {{ request()->is('invoice/invoice_payment*') ? 'nav-active' : '' }}"
                                            href="{{ route('invoice.index', $id_page = 'invoice_all') }}">
                                            <span class="ml-1 item-text">قائمة الفواتير</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-3 {{ request()->is('invoice/invoice_table/paid_invoice') ? 'nav-active' : '' }}"
                                            href="{{ route('invoice.index', $id_page = 'paid_invoice') }}">
                                            <span class="ml-1 item-text"> الفواتير المدفوعة</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-3 {{ request()->is('invoice/invoice_table/partpaid_invoice') ? 'nav-active' : '' }}"
                                            href="{{ route('invoice.index', $id_page = 'partpaid_invoice') }}">
                                            <span class="ml-1 item-text"> الفواتير المدفوعة جزئا</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-3 {{ request()->is('invoice/invoice_table/unpaid_invoice') ? 'nav-active' : '' }}"
                                            href="{{ route('invoice.index', $id_page = 'unpaid_invoice') }}">
                                            <span class="ml-1 item-text"> الفواتير الغير المدفوعة</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-3 {{ request()->is('invoice/invoice_archive') ? 'nav-active' : '' }}"
                                            href="{{ route('invoice.archive') }}">
                                            <span class="ml-1 item-text">ارشيف الفواتير</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @can('التقارير')
                            <p class="text-muted nav-heading mt-4 mb-1">
                                <span>ادارة التقارير</span>
                            </p>
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
                        @endcan
                        @can('المستخدمين')
                            <p class="text-muted nav-heading mt-4 mb-1">
                                <span>ادارة المستخدمين</span>
                            </p>
                            {{-- Users --}}
                            <li
                                class="nav-item dropdown {{ request()->is('users*') ? 'active' : '' }}
                            {{ request()->is('role*') ? 'active' : '' }}">
                                <a href="#profile" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle nav-link">
                                    <i class="fe fe-user fe-16"></i>
                                    <span class="ml-3 item-text">المستخدمين</span>
                                </a>
                                <ul class="collapse list-unstyled pl-4 w-100 
                                {{ request()->is('users*') ? 'show' : '' }}
                                {{ request()->is('roles*') ? 'show' : '' }}
                                "
                                    id="profile">
                                    <a class="nav-link pl-3 {{ request()->is('users') ? 'nav-active' : '' }}"
                                        href="{{ route('user.index') }}">
                                        <span class="ml-1">قائمة المستخدمين</span>
                                    </a>
                                    <a class="nav-link pl-3 {{ request()->is('roles') ? 'nav-active' : '' }}"
                                        href="{{ route('role.index') }}">
                                        <span class="ml-1">صلاحيات المستخدمين</span>
                                    </a>
                                </ul>
                            </li>
                        @endcan
                        @can('الاعدادات')
                            <p class="text-muted nav-heading mt-4 mb-1">
                                <span>الاعدادات</span>
                            </p>
                            {{-- Settings --}}
                            <li class="nav-item dropdown {{ request()->is('setting*') ? 'active' : '' }}">
                                <a href="#settings" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle nav-link">
                                    <i class="fe fe-tool fe-16"></i>
                                    <span class="ml-3 item-text">الاعدادات</span>
                                </a>
                                <ul class="collapse list-unstyled pl-4 w-100 {{ request()->is('setting*') ? 'show' : '' }}"
                                    id="settings">
                                    <a class="nav-link pl-3 {{ request()->is('setting/section') ? 'nav-active' : '' }}"
                                        href="{{ route('section.index') }}"><span class="ml-1">الاقسام</span></a>
                                    <a class="nav-link pl-3 {{ request()->is('setting/Product') ? 'nav-active' : '' }}"
                                        href="{{ route('product.index') }}"><span class="ml-1">المنتاجات</span></a>
                                </ul>
                            </li>
                        @endcan
                    </ul>

                    <div class="btn-box w-100 mt-4 mb-1">
                        <a href="#" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
                            <i class="fe fe-phone-missed fe-12 mr-2"></i><span class="small">تواصل معنا</span>
                        </a>
                    </div>
                </nav>
            </aside>
