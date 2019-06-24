<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
            <img style="margin-left:35px;" src="img/Blogger-2.png" alt="">
<!---<h4 style="color: #3a414e;" class="brand"> Sensive</h4>--->
            </div>

            <ul class="list-unstyled components">

                <li>
                    <a href="admindashboard.php">Home</a>

                </li>
                <li>
                    <a href="#">Blogs</a>
                    <ul class='list-unstyled components'>
                        <li><a href="adminblogs.php?type=3">New Blog</a></li>
                        <li><a href="adminblogs.php?type=0">Published</a></li>
                        <li><a href="adminblogs.php?type=1">Requested</a></li>
                    </ul>
                </li>
                <li>
                    <a onclick="getusers()">Users</a>
                </li>

            </ul>



        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>

                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active btn btn-light">
                                <a class="nav-link" href='adminprofile.php'>
                                    <span class="fas fa-cog"></span> Profile
                                </a>
                            </li>
                            <li class="nav-item active btn btn-light" style="margin-left:4px;">
                                <a class="nav-link" href="login.php?type=1">
                                    <span class="fas fa-power-off"></span> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>