<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="{{asset('images/logo_motor.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{asset('images/logo_motor.png')}}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{url('/dashboard')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                   
                    @role('admin')
                    <a href="{{url('/dashboard/users')}}"> <i class="menu-icon fa fa-dashboard"></i>User</a>
                    <a href="{{url('/dashboard/mekanik')}}"> <i class="menu-icon fa fa-dashboard"></i>Mekanik</a>
                    <a href="{{url('/dashboard/supplier')}}"> <i class="menu-icon fa fa-dashboard"></i>Supplier</a>
                    <a href="#"> <i class="menu-icon fa fa-dashboard"></i>Sparepart</a>
                    <a href="#"> <i class="menu-icon fa fa-dashboard"></i>Layanan</a>
                    @endrole
                </li>
               
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Laporan</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="tables-basic.html">Basic Table</a></li>
                        <li><i class="fa fa-table"></i><a href="tables-data.html">Data Table</a></li>
                    </ul>
                </li>
               

               
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>