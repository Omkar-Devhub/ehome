<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center" style="padding: 6px 0px">
        <span class="brand-text font-weight-bold text-success" style="font-size: 30px;">eirehome</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Request::routeIs('admin.category*') || Request::routeIs('admin.services-sub-category*') || Request::routeIs('admin.features*') || Request::routeIs('admin.facility*') || Request::routeIs('admin.ber*') || Request::routeIs('admin.property-types*') || Request::routeIs('admin.services-category*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-swatchbook"></i>
                        <p>Specifications <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}"
                                class="nav-link {{ Route::is('admin.category*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Property Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.services-category') }}"
                                class="nav-link {{ Route::is('admin.services-category*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Service Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.services-sub-category') }}"
                                class="nav-link {{ Route::is('admin.services-sub-category*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Service Sub-categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.features') }}"
                                class="nav-link {{ Route::is('admin.features*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Features</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.facility') }}"
                                class="nav-link {{ Route::is('admin.facility*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Near by Facilities</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ber') }}"
                                class="nav-link {{ Route::is('admin.ber*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>BER</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.property-types') }}"
                                class="nav-link {{ Route::is('admin.property-types*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Property Types</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Request::routeIs('admin.properties*') || Request::routeIs('admin.property-in-review*') || Request::routeIs('admin.property-disapproved*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Properties <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.properties') }}"
                                class="nav-link {{ Route::is('admin.properties*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Property Listings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.property-in-review') }}"
                                class="nav-link {{ Route::is('admin.property-in-review*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Awaiting Review</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.property-disapproved') }}"
                                class="nav-link {{ Route::is('admin.property-disapproved*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Disapproved Listings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Request::routeIs('admin.counties*') || Request::routeIs('admin.areas*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p> Locations <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.counties') }}"
                                class="nav-link {{ Route::is('admin.counties*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Counties</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.areas') }}"
                                class="nav-link {{ Route::is('admin.areas*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Areas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users') }}"
                        class="nav-link {{ Route::is('admin.users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.agents') }}"
                        class="nav-link {{ Route::is('admin.agents*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-secret"></i>
                        <p>Estate Agents</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.vendors') }}"
                        class="nav-link {{ Route::is('admin.vendors*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Service Providers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.agreements.create') }}"
                        class="nav-link {{ Route::is('admin.agreements*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Agreements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.registration-requests') }}"
                        class="nav-link {{ Route::is('admin.registration-requests*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Reg. Requests</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pages') }}"
                        class="nav-link {{ Route::is('admin.pages*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Custom Pages</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Payment logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Packages</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Request::routeIs('admin.blogs-posts*') || Request::routeIs('admin.blog-categories*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p> Blog Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.blogs-posts') }}"
                                class="nav-link {{ Route::is('admin.blogs-posts*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Post</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-categories') }}"
                                class="nav-link {{ Route::is('admin.blog-categories*') ? 'active' : '' }}">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-ad"></i>
                        <p>Advertisements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Annauncements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-mail-bulk"></i>
                        <p> Support Tickets <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>All Tickets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Pending</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Open</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle-notch nav-icon"></i>
                                <p>Closed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Payment Gateway</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}"
                        class="nav-link {{ Route::is('admin.settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
