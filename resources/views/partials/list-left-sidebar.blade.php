<div id="left-sidebar">
    <div id="list-left-sidebar">
        <div class="sibebar-panel">
            <div class="sidebar-link-list">
                <div class="sidebar-menu-header">
                    <h5>POPULAR CATEGORIES</h5>
                </div>
                <ul class="list-unstyled action">
                    @if(isset($page2) && !empty($page2) && $page2=='Latest')
                        <li id="latest_stories_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a id="latest_stories" ><img src="{{ asset('img/profile-header-orginal.jpg') }}">Latest Stories</a></li>
                    @else
                    <li id="latest_stories_li" ><a id="latest_stories"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Latest Stories</a></li>
                    @endif
                    @if(isset($page2) && !empty($page2) && $page2=='Top')
                        <li id="top_stories_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a id="top_stories" ><img src="{{ asset('img/profile-header-orginal.jpg') }}">Top Stories</a></li>
                    @else
                            <li id="top_stories_li"><a id="top_stories"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Top Stories</a></li>
                    @endif
                    @if(isset($page2) && !empty($page2) && $page2=='Popular')
                            <li id="popular_stories_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a id="popular_stories" ><img src="{{ asset('img/profile-header-orginal.jpg') }}">Popular Stories</a></li>
                    @else
                            <li id="popular_stories_li"><a id="popular_stories"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Popular Stories</a></li>
                    @endif
                    @if(isset($page2) && !empty($page2) && $page2=='Trending')
                            <li id="trending_stories_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a id="trending_stories"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Trending Stories</a></li>
                    @else
                            <li id="trending_stories_li" ><a id="trending_stories"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Trending Stories</a></li>
                    @endif

                </ul>
            </div>
        </div>
        <div class="sibebar-panel">
            <div class="sidebar-link-list">
                <div class="sidebar-menu-header">
                    <h5>POPULAR TOPICS</h5>
                </div>
                <ul class="list-unstyled">
                    @if(isset($page1) && !empty($page1) && $page1=='all')
                        <li id="all_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a href="{{ url('/post') }}" id="all" style="color: #CF4945;"><img src="{{ asset('img/profile-header-orginal.jpg') }}">All</a></li>
                    @else
                        <li id="all_li"><a href="{{ url('/post') }}" id="all"><img src="{{ asset('img/profile-header-orginal.jpg') }}">All</a></li>
                    @endif
                    @if(isset($page1) && !empty($page1) && $page1=='web')
                            <li id="web_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a href="{{ url('/post/web') }}" id="web" style="color: #CF4945;"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Web</a></li>
                    @else
                         <li id="web_li" ><a href="{{ url('/post/web') }}" id="web"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Web</a></li>
                    @endif
                    @if(isset($page1) && !empty($page1) && $page1=='images')
                            <li id="images_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a href="{{ url('/post/images') }}" id="images" style="color: #CF4945;"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Images</a></li>
                    @else
                            <li id="images_li"><a href="{{ url('/post/images') }}" id="images"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Images</a></li>
                    @endif
                    @if(isset($page1) && !empty($page1) && $page1=='videos')
                            <li id="videos_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a href="{{ url('/post/videos') }}" id="videos" style="color: #CF4945;"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Videos</a></li>
                    @else
                            <li id="videos_li" ><a href="{{ url('/post/videos') }}" id="videos"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Videos</a></li>
                    @endif
                    @if(isset($page1) && !empty($page1) && $page1=='articles')
                            <li id="articles_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a href="{{ url('/post/articles') }}" id="articles" style="color: #CF4945;"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Articles</a></li>
                    @else
                            <li id="articles_li"><a href="{{ url('/post/articles') }}" id="articles"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Articles</a></li>
                    @endif
                    @if(isset($page1) && !empty($page1) && $page1=='lists')
                            <li id="lists_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a href="{{ url('/post/lists') }}" id="lists" style="color: #CF4945;"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Lists</a></li>
                    @else
                            <li id="lists_li"><a href="{{ url('/post/lists') }}" id="lists"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Lists</a></li>
                    @endif
                    @if(isset($page1) && !empty($page1) && $page1=='polls')
                            <li id="polls_li" style="background-color: #fff; border-radius: 3px; border: 1px solid #eaeaea;"><a href="{{ url('/post/polls') }}" id="polls" style="color: #CF4945;"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Polls</a></li>
                    @else
                            <li id="polls_li"><a href="{{ url('/post/polls') }}" id="polls"><img src="{{ asset('img/profile-header-orginal.jpg') }}">Polls</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!--<div class="sidebar-panel-divider"></div>
        <div class="sibebar-panel">
            <div class="sidebar-link-list">
                <ul class="list-unstyled">
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('pages/register') }}">Register</a></li>

                    @else
                    <li><a href="{{ url('/user/profile') }}">My Profile</a></li>
                    <li><a href="{{ url('/saved') }}">Saved Stories</a></li>
                    <li><a href="{{ url('/folders') }}">Folders</a></li>
                    <li><a href="{{ url('/post/create') }}">Add Story</a></li>
                    <li><a href="{{ url('/user/settings') }}">Settings</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @endif
                </ul>
            </div>
        </div>-->
    </div>
</div>