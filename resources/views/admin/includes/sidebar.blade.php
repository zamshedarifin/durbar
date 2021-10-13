<div class="left-side-menu">
    <div class="user-box">
        <div class="float-left">
            @if(!isset(Auth('admin')->user()->photo))
                <img src="{{asset("admin/images/users/pp.png")}}" alt="" class="avatar-md rounded-circle">
            @else
                <img src="{{asset("uploads/profile").'/'.Auth('admin')->user()->photo}}" style="object-fit: cover" alt="" class="avatar-md rounded-circle">
            @endif
        </div>
        <div class="user-info">
            <a href="#">{{Auth('admin')->user()->name}}</a>
            <p class="text-muted m-0">Administrator</p>
        </div>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">

            <li class="menu-title">Navigation</li>

            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="ti-home"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            {{--<li>
                <a href="ui-elements.html">
                    <i class="ti-paint-bucket"></i>
                    <span> UI Elements </span>
                    <span class="badge badge-primary float-right">11</span>
                </a>
            </li>--}}

            <li>
                <a href="javascript: void(0);">
                    <i class="ti-light-bulb"></i>
                    <span> Campaign </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.create.campaign')}}">Create Campaign</a></li>
                    <li><a href="{{route('admin.campaign')}}">Manage Campaign</a></li>
                    {{--                    <li><a href="{{route('admin.campaign.enroll')}}">Campaign Enroll</a></li>--}}
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);">
                    <i class="ti-book"></i>
                    <span> Story </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.create.story')}}">Add Story</a></li>
                    <li><a href="{{route('admin.stories')}}">Manage Stories</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="ti-gift"></i>
                    <span> Competition </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.create.competition')}}">Add Competition</a></li>
                    <li><a href="{{route('admin.competitions')}}">Manage Competition</a></li>
                </ul>
            </li>


            {{--<li>
                <a href="javascript: void(0);">
                    <i class="ti-calendar"></i>
                    <span> Event </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.create.event')}}">Create Event</a></li>
                    <li><a href="{{route('admin.events')}}">Manage Events</a></li>
                </ul>
            </li>--}}

            <li>
                <a href="javascript: void(0);">
                    <i class="ti-infinite"></i>
                    <span> Quiz </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.create.quiz')}}">Create Quiz</a></li>
                    <li><a href="{{route('admin.quiz.list')}}">Manage Quiz</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="ti-info"></i>
                    <span> Question </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.create.question')}}">Add Question</a></li>
                    <li><a href="{{route('admin.question.import')}}">CSV Import</a></li>
                    <li><a href="{{route('admin.question.list')}}">Manage Question</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="ti-gallery"></i>
                    <span> Gallery </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.album.create')}}">Add Album</a></li>
                    <li><a href="{{route('admin.album.index')}}">Manage Albums</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('admin.ambassador.list')}}">
                    <i class="ti-user"></i>
                    <span> Ambassadors </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.careercamp.list')}}">
                    <i class="ti-list-ol"></i>
                    <span> Career Camp </span>
                </a>
            </li>


            <li>
                <a href="{{route('admin.user.list')}}">
                    <i class="fa fa-users"></i>
                    <span> Users </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.feedback')}}">
                    <i class="ti-envelope"></i>
                    <span> Feedback </span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);">
                    <i class="fa fa-cogs"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('admin.union.ward')}}">Union/Ward</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>


</div>
