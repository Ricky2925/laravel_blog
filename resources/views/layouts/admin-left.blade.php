<div data-simplebar="" class="h-100">

    <!-- User details -->
    <div class="user-profile text-center mt-3">
        <div class="">
            <!-- <img src="static/picture/avatar-1.jpg" alt="" class="avatar-md rounded-circle"> -->
        </div>
        <div class="mt-3">
            <h4 class="font-size-16 mb-1">{{ Auth::guard('admin')->user()->name }}</h4>
            <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
        </div>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <!-- <li class="menu-title">Menu</li> -->

            <!-- <li>
                <a href="{{route('admin.dashboard')}}" class="waves-effect">
                    <i class="ri-dashboard-line"></i>
                  
                    <span>Dashboard</span>
                </a>
            </li> -->
            <li class="menu-title">Pages</li>
            <li>
                <a href="{{ route('admin.users.index') }}" class=" waves-effect">
                    <i class="ri-account-circle-line"></i>
                    <span>User</span>
                </a>
                               
            </li>
            <li>
                <a href="{{ route('admin.comments.index') }}" class="  waves-effect">
                    <i class=" ri-chat-2-fill"></i>
                    <span>Comment</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.posts.index') }}" class="waves-effect">
                    <i class="ri-list-check"></i>
                    <span>Posts</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- Sidebar -->
</div>
