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
                   
                   
                    <a href="{{url('/dashboard/users')}}"> <i class="menu-icon fa fa-user"></i>Pelanggan</a>
                    <a href="{{url('/dashboard/mekanik')}}"> <i class="menu-icon fa fa-users"></i>Mekanik</a>
                    <a href="{{url('/dashboard/supplier')}}"> <i class="menu-icon fa fa-truck"></i>Supplier</a>
                    <a href="{{url('/dashboard/sparepart')}}"> <i class="menu-icon fa fa-motorcycle"></i>Sparepart</a>
                    <a href="{{url('/dashboard/layanan')}}"> <i class="menu-icon fa fa-paper-plane"></i>Layanan</a>
                   
                </li>
               
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Laporan</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{url('/dashboard/status')}}">Kerja Mekanik</a></li>
                        <li><i class="fa fa-table"></i><a href="{{url('/dashboard/transaksi')}}">Laporan Penghasilan</a></li>
                        <li><i class="fa fa-star"></i><a href="{{url('/dashboard/rating')}}">Rating</a></li>
                    </ul>
                </li>
               

               
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>