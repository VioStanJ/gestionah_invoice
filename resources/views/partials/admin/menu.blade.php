<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand mb-3" href="/home">
            <img src="{{!empty($company->image)||!isset($company->image)?asset($logo):asset($company->image)}}" class="navbar-brand-img"/>
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
                @if(\Auth::guard('customer')->check())
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ (Request::route()->getName() == 'customer.home') ? ' active' : '' }}">
                            <i class="fas fa-fire"></i>{{__('Dashboard')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('customer.proposal')}}" class="nav-link {{ (Request::route()->getName() == 'customer.proposal' || Request::route()->getName() == 'customer.proposal.show') ? ' active' : '' }}">
                            <i class="fas fa-file"></i>{{__('Proposal')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('customer.invoice')}}" class="nav-link {{ (Request::route()->getName() == 'customer.invoice' || Request::route()->getName() == 'customer.invoice.show') ? ' active' : '' }} ">
                            <i class="fas fa-receipt"></i>{{__('Invoice')}}
                        </a>
                    </li>

                @else
                    <li class="nav-item">
                        <a href="" class="nav-link {{ (Request::route()->getName() == 'home') ? ' active' : '' }}">
                            <i class="fas fa-fire"></i>{{__('Dashboard')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/product-service" class="nav-link {{ (Request::segment(1) == 'product-service')?'active':''}}">
                            <i class="fas fa-shopping-cart"></i>{{__('Product & Service')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/proposal" class="nav-link {{ (Request::segment(1) == 'proposal')?'active':''}}">
                            <i class="fas fa-receipt"></i>{{__('Proposal')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/customer" class="nav-link {{ (Request::segment(1) == 'customer')?'active':''}}">
                            <i class="fas fa-user-ninja"></i>{{__('Customer')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/category" class="nav-link {{ (Request::segment(1) == 'category')?'active':''}}">
                            <i class="fas fa-list-ul"></i>{{__('Category')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ (Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?' active':'collapsed'}}" href="#navbar-constant" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) ==
                        'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?'true':'false'}}" aria-controls="navbar-constant">
                            <i class="fas fa-cog"></i>{{__('Constant')}}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?'show':''}}" id="navbar-constant">
                            <ul class="nav flex-column submenu-ul">
                                <li class="nav-item {{ (Request::route()->getName() == 'product-unit.index' ) ? ' active' : '' }}">
                                    <a href="/unit" class="nav-link">{{ __('Unit') }}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
