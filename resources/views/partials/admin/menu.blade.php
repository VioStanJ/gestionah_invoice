@php
    $logo=asset(Storage::url('uploads/logo/'));
    // $company_logo=Utility::getValByName('company_logo');
    // $company_small_logo=Utility::getValByName('company_small_logo');
@endphp

<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="">
            <img src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'/assets/landing_logo.png')}}" class="navbar-brand-img"/>
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
                    {{-- @if(\Auth::guard('customer')->check())
                        <a href="{{route('customer.dashboard')}}" class="nav-link {{ (Request::route()->getName() == 'customer.dashboard') ? ' active' : '' }}">
                            <i class="fas fa-fire"></i>{{__('Dashboard')}}
                        </a>
                    @elseif(\Auth::guard('vender')->check())
                        <a href="{{route('vender.dashboard')}}" class="nav-link {{ (Request::route()->getName() == 'vender.dashboard') ? ' active' : '' }}">
                            <i class="fas fa-fire"></i>{{__('Dashboard')}}
                        </a>
                    @else
                        <a href="{{route('dashboard')}}" class="nav-link {{ (Request::route()->getName() == 'dashboard') ? ' active' : '' }}">
                            <i class="fas fa-fire"></i>{{__('Dashboard')}}
                        </a>
                    @endif --}}
                </li>
                @can('manage customer proposal')
                    <li class="nav-item">
                        {{-- <a href="{{route('customer.proposal')}}" class="nav-link {{ (Request::route()->getName() == 'customer.proposal' || Request::route()->getName() == 'customer.proposal.show') ? ' active' : '' }}">
                            <i class="fas fa-file"></i>{{__('Proposal')}}
                        </a> --}}
                    </li>
                @endcan
                @can('manage customer invoice')
                    <li class="nav-item">
                        {{-- <a href="{{route('customer.invoice')}}" class="nav-link {{ (Request::route()->getName() == 'customer.invoice' || Request::route()->getName() == 'customer.invoice.show') ? ' active' : '' }} ">
                            <i class="fas fa-file"></i>{{__('Invoice')}}
                        </a> --}}
                    </li>
                @endcan
                @can('manage customer payment')
                    <li class="nav-item">
                        {{-- <a href="{{route('customer.payment')}}" class="nav-link {{ (Request::route()->getName() == 'customer.payment') ? ' active' : '' }} ">
                            <i class="fas fa-money-bill-alt"></i>{{__('Payment')}}
                        </a> --}}
                    </li>
                @endcan
                @can('manage customer transaction')
                    <li class="nav-item">
                        {{-- <a href="{{route('customer.transaction')}}" class="nav-link {{ (Request::route()->getName() == 'customer.transaction') ? ' active' : '' }}">
                            <i class="fas fa-history"></i>{{__('Transaction')}}
                        </a> --}}
                    </li>
                @endcan
                @can('manage vender bill')
                    <li class="nav-item">
                        {{-- <a href="{{route('vender.bill')}}" class="nav-link {{ (Request::route()->getName() == 'vender.bill' || Request::route()->getName() == 'vender.bill.show') ? ' active' : '' }} ">
                            <i class="fas fa-file"></i>{{__('Bill')}}
                        </a> --}}
                    </li>
                @endcan
                @can('manage vender payment')
                    <li class="nav-item">
                        {{-- <a href="{{route('vender.payment')}}" class="nav-link {{ (Request::route()->getName() == 'vender.payment') ? ' active' : '' }} ">
                            <i class="fas fa-money-bill-alt"></i>{{__('Payment')}}
                        </a> --}}
                    </li>
                @endcan
                @can('manage vender transaction')
                    <li class="nav-item">
                        {{-- <a href="{{route('vender.transaction')}}" class="nav-link {{ (Request::route()->getName() == 'vender.transaction') ? ' active' : '' }}">
                            <i class="fas fa-history"></i>{{__('Transaction')}}
                        </a> --}}
                    </li>
                @endcan

            </ul>
        </div>
    </div>
</div>
