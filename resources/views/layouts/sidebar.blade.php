<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <x-menu-main
            title="Dashboard"
            route="dashboard"
            type="single"
            icon="bi bi-grid"
        />

        <x-menu-main
            title="Staff"
            route="staff"
            type="single"
            icon="bi bi-people"
        />

        <x-menu-main
            title="Task"
            route="task"
            type="single"
            icon="bi bi-list-task"
        />

        <x-menu-main
            title="Sub Task"
            route="sub_task"
            type="single"
            icon="bi bi-check2-square"
        />

        <li class="nav-heading">Menus</li>

        <x-menu-main
            title="System Admin"
            type="multi"
            icon="bi bi-gear-fill"
            id="sys-admin-nav"
            :routes_array="['users', 'dropdowns', 'areas']"
        >
            <x-menu-item route="users" title="User Management" />

            <x-menu-item route="dropdowns" title="Dropdowns" />

            @if(get_logged_in_user_id() == 1)
                <x-menu-item route="areas" title="Areas" />
            @endif

        </x-menu-main>

    </ul>

</aside><!-- End Sidebar-->
