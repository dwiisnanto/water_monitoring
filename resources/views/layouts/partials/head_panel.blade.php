<div class="br-header">
        <div class="br-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i
                        class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i
                        class="icon ion-navicon-round"></i></a></div>
            {{-- <div class="input-group hidden-xs-down wd-170 transition">
                <input id="searchbox" type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
                </span>
            </div><!-- input-group --> --}}
        </div><!-- br-header-left -->
        <div class="br-header-right">
            <nav class="nav">
                
                <div class="dropdown">
                    <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                        <span class="logged-name hidden-md-down">
                            @php
                                $fullName = explode(' ',Auth::user()->name);
                                echo $fullName[0];
                            @endphp
                        </span>
                        <img src="{{ asset('backend/')}}/images/users/{{ Auth::user()->avatar }}" class="wd-32 rounded-circle" alt="">
                        <span class="square-10 bg-success"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-header wd-250">
                        <div class="tx-center">
                            <a href="#"><img src="{{ asset('backend/')}}/images/users/{{ Auth::user()->avatar }}" class="wd-80 rounded-circle" alt=""></a>
                            <h6 class="logged-fullname">{{ Auth::user()->name }}</h6>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        <hr>
                        <div class="tx-center">
                            <span class="profile-earning-label">{{ Auth::user()->departement->name }}</span>
                             
                        </div>
                        <hr>
                        <ul class="list-unstyled user-profile-nav">
                            <li><a href="{{url('users/'.Auth::user()->id.'/edit')}}"><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                            
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            
                            </li>
                        </ul>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
            </nav>
            {{-- <div class="navicon-right">
                <a id="btnRightMenu" href="#" class="pos-relative">
                    <i class="icon ion-ios-chatboxes-outline"></i>
                    <!-- start: if statement -->
                    <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
                    <!-- end: if statement -->
                </a>
            </div><!-- navicon-right --> --}}
        </div><!-- br-header-right -->
    </div><!-- br-header -->