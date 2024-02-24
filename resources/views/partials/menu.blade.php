<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align: center">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('role_permission_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} ">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-user-edit">

                            </i>
                            <p>
                                {{ trans('cruds.role.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('role_permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/staffs*") ? "menu-open" : "" }} ">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/staffs*") ? "active" : "" }} " href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user_management_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('staff_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.staffs.index") }}" class="nav-link {{ request()->is("admin/staffs") || request()->is("admin/staffs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-shield">

                                        </i>
                                        <p>
                                            {{ trans('cruds.staff.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('expo_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/expoes*") ? "menu-open" : "" }} {{ request()->is("admin/expoes/*") ? "menu-open" : "" }} {{ request()->is("admin/expos/*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/expoes*") ? "active" : "" }} {{ request()->is("admin/expoes/*") ? "active" : "" }} {{ request()->is("admin/expos/*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-binoculars">

                            </i>
                            <p>
                                {{ trans('cruds.expo.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route("admin.expoes.index",  ['type' => 0]) }}" class="nav-link {{ (request()->is("admin/expoes*") || request()->is("admin/expoes/*") || request()->is("admin/expos/*")) && request()->query('type') == '0' ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-globe-asia">

                                    </i>
                                    <p>
                                        {{ trans('cruds.expo.title-jawa') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.expoes.index",  ['type' => 1]) }}" class="nav-link {{ (request()->is("admin/expoes*") || request()->is("admin/expoes/*") || request()->is("admin/expos/*")) && request()->query('type') == '1' ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-globe-americas">

                                    </i>
                                    <p>
                                        {{ trans('cruds.expo.title-luar-jawa') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('registrant_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/registrants*") ? "menu-open" : "" }} {{ request()->is("admin/registrants/*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/registrants*") ? "active" : "" }} {{ request()->is("admin/registrants/*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-user-tag">

                            </i>
                            <p>
                                {{ trans('cruds.registrant.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("admin.registrants.index",  ['status' => 0]) }}" class="nav-link {{ (request()->is("admin/registrants*") || request()->is("admin/registrants/*")) && request()->query('status') == '0' ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-minus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.registrant.belum_diterima') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.registrants.index",  ['status' => 1]) }}" class="nav-link {{ (request()->is("admin/registrants*") || request()->is("admin/registrants/*")) && request()->query('status') == '1' ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.registrant.regis') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.registrants.index",  ['status' => 2]) }}" class="nav-link {{ (request()->is("admin/registrants*") || request()->is("admin/registrants/*")) && request()->query('status') == '2' ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.registrant.diterima') }}
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                @endcan
                @can('information_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/informations*") ? "menu-open" : "" }} {{ request()->is("admin/informations/*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/informations*") ? "active" : "" }} {{ request()->is("admin/informations/*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-info-circle">

                            </i>
                            <p>
                                {{ trans('cruds.information.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("admin.informations.index",  ['type' => 0]) }}" class="nav-link {{ (request()->is("admin/informations*") || request()->is("admin/informations/*")) && request()->query('type') == '0' ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-signature">

                                        </i>
                                        <p>
                                             {{ App\Models\Information::TYPE_SELECT[0]}}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.informations.index",  ['type' => 1]) }}" class="nav-link {{ (request()->is("admin/informations*") || request()->is("admin/informations/*")) && request()->query('type') == '1' ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar-alt">

                                        </i>
                                        <p>
                                             {{ App\Models\Information::TYPE_SELECT[1]}}
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                @endcan
                @can('selection_information_access')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is("admin/selection-informations*") || request()->is("admin/selection-informations/*") ? "active" : "" }}" href="{{ route("admin.selection-informations.index") }}">
                        <i class="fas fa-fw fa-file-signature nav-icon">
                        </i>
                        <p>
                            {{ trans('cruds.information.title') }} {{ App\Models\Information::TYPE_SELECT[0] }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('activity_information_access')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is("admin/activity-informations*") || request()->is("admin/activity-informations/*") ? "active" : "" }}" href="{{ route("admin.activity-informations.index") }}">
                        <i class="fas fa-fw fa-calendar-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('cruds.information.title') }} {{ App\Models\Information::TYPE_SELECT[1] }}
                        </p>
                    </a>
                </li>
                @endcan

                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>