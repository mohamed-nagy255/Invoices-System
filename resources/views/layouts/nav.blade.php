        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-16"></i>
                    </a>
                </li>

                @can('الاشعارات')

                    {{-- notifications --}}
                    <li class="nav-item dropdown mr-2 ml-2">
                        <a class="nav-link dropdown text-muted pr-0 nav-link text-muted my-2 mr-2" href="#"
                            id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="fe fe-bell fe-16"></span>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="dot dot-md bg-success"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"
                            style="padding: 0;text-align: center; border-radius: 10px;border-bottom: #1b68ff solid 3px"
                            aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-item"
                                style="
                            background-color:#1b68ff;
                            text-align: center;
                            color:white;
                            border-radius: 10px;
                            font-size: 20px;
                            padding: 10px;
                            margin-bottom: 10px;">
                                الاشعارات
                                <span class="fe fe-bell fe-16"></span>
                                <br>
                                <span style="font-size: 14px;">
                                    عدد الاشعارات الغير مقروأة :
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </div>
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <a class="dropdown-item" style="padding: 20px 10px"
                                    href="{{ route('details.index', $notification->data['id']) }}">
                                    <span class="circle circle-sm bg-primary">
                                        <i class="fe fe-16 fe-clipboard text-white mb-0"></i>
                                    </span>
                                    {{ $notification->data['title'] }}
                                    {{ $notification->data['usre'] }}
                                    {{ $notification->markAsRead() }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endcan

                {{-- User --}}
                <li class="nav-item dropdown" style="text-align: center">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span> {{ Auth::user()->name }} </span>
                        <span class="avatar avatar-sm mt-2">
                            <img src="{{ asset('assets/avatars/face-1.jpg') }}" alt="..."
                                class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">الحساب</a>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">الاعدادات</a>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"> تسجيل
                            الخروج </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
