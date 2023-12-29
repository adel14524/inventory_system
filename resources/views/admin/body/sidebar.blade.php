<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Calendar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-share-line"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">Level 1.1</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 2.1</a></li>
                                <li><a href="javascript: void(0);">Level 2.2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="menu-title">System</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('user_management')
                            <li><a href="{{ route('user.all') }}">User Management</a></li>
                        @endcan

                        @can('roles_management')
                            <li><a href="{{ route('role.all') }}">User Role Management</a></li>
                        @endcan

                        @can('permission_management')
                            <li><a href="{{ route('permission.all') }}">Permission Management</a></li>
                        @endcan

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Maintainance</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('manage_product_category')
                            <li><a href="{{ route('category.all') }}">Manage Product Category</a></li>
                        @endcan

                        @can('manage_product_tag')
                            <li><a href="{{ route('tag.all') }}">Manage Product Tags</a></li>
                        @endcan

                        {{-- @can('view_permission')
                            <li><a href="{{ route('permission.all') }}">Permission Management</a></li>
                        @endcan --}}

                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
