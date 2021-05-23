<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand mb-3" href="/home">
            <img src="{{!empty($company->image)?asset($logo):asset($company->image)}}" class="navbar-brand-img"/>
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a href="" class="nav-link {{ (Request::route()->getName() == 'home') ? ' active' : '' }}">
                        <i class="fas fa-fire"></i>{{__('Dashboard')}}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link {{ (Request::segment(1) == 'productservice')?'active':''}}">
                        <i class="fas fa-shopping-cart"></i>{{__('Product & Service')}}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/category" class="nav-link {{ (Request::segment(1) == 'category')?'active':''}}">
                        <i class="fas fa-list-ul"></i>{{__('Category')}}
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
