<div class="overlay"></div>
<!-- Sidebar -->
<nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <a href="#">Brand</a>
            </div>
        </div>
        <li><a href="{{ route('home') }}#home">Home</a></li>
        <li><a href="{{ route('companies.index') }}#works">Companies</a></li>
        <li><a href="{{ route('companies.create') }}#add">Create a Company</a></li>
        <li><a href="{{ route('employees.index') }}#team">Employees</a></li>
        <li><a href="{{ route('employees.create') }}#team">Add Employees</a></li>

    </ul>
</nav>
<!-- /#sidebar-wrapper -->
