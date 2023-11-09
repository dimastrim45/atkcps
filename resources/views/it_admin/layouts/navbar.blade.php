        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @php
                use Illuminate\Support\Str;
            @endphp
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="sidebar-toggle-button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @php
                            $unreadChatInfo = auth()
                                ->user()
                                ->unreadChatCount();
                        @endphp
                        <span class="badge badge-warning navbar-badge">{{ $unreadChatInfo['count'] }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span
                            class="dropdown-item dropdown-header">{{ $unreadChatInfo['count'] . ' Notifications' }}</span>
                        @foreach ($unreadChatInfo['chats'] as $chat)
                            <a href="{{ route('chat', ['feedback' => $chat->feedback->feedback_docnum]) }}"
                                class="dropdown-item">
                                @if ($chat->message_type === 'text')
                                    <i class="fas fa-envelope mr-2"></i> New message:
                                    {{ Str::limit($chat->message, 20, '...') }}
                                @else
                                    <i class="fas fa-image mr-2"></i> New image message
                                @endif
                                <span
                                    class="float-right text-muted text-sm">{{ $chat->created_at->diffForHumans() }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                        <a href="{{ route('feedbacks') }}" class="dropdown-item dropdown-footer">See All
                            Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="{{ route('profile.showITAdmin') }}" class="dropdown-item">
                            <i class="mr-2 fas fa-file"></i>
                            {{ __('My profile') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mr-2 fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
