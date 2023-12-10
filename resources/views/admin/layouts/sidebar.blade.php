<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('inquiry.dashboard')}}" class="waves-effect">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Inquiries</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-plus"></i>
                        <span>Hospitals</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('hospital.dashboard')}}">Hoapitals Listing</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Doctors</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('doctor.dashboard')}}">Doctors Listing</a></li>
                       
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>