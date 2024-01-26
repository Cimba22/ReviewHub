<header class="header">
    <div class="container">
        <div class="header__inner">
            <a class="header__logo" href="/categories"> <img src="public/img/logo_dashboard.svg"></a>

            <div class="header__user">

                <nav>
                    <img class="avatar__circle" src="public/img/userAvatar.svg"
                         alt size="48" height="48" width="48" >

                    <div class="sidebar">

                        <img class="avatar__circle" src="public/img/userAvatar.svg"
                             alt size="48" height="48" width="48" >
                        <span style="padding-left: 38px"> <?php echo SessionManager::getCurrentUserLogin(); ?></span>

                        <div class="sidebar_content">
                            <ul class="lists">
                                <li class="list">
                                    <a href="#" class="nav-link">
                                        <i class='bx bx-user icon'></i>
                                        <span class="link">Your profile</span>
                                    </a>
                                </li>

                                <li class="list">
                                    <a href="#" class="nav-link">
                                        <i class='bx bxs-book-content icon' ></i>
                                        <span class="link">Your repositories</span>
                                    </a>
                                </li>

                                <li class="list">
                                    <a href="#" class="nav-link">
                                        <i class='bx bx-support icon' ></i>
                                        <span class="link">ReviewHub Support</span>
                                    </a>
                                </li>

                                <li class="list">
                                    <a href="#" class="nav-link">
                                        <i class='bx bx-book-open icon'></i>
                                        <span class="link">ReviewHub Docs</span>
                                    </a>
                                </li>

                                <li class="list">
                                    <a href="#" class="nav-link">
                                        <i class='bx bx-cog icon' ></i>
                                        <span class="link">Settings</span>
                                    </a>
                                </li>

                                <li class="list">
                                    <a href="/logout" class="nav-link" onclick="confirmLogout()">
                                        <span class="link">Logout</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>

                </nav>

                <section class="overlay"></section>
            </div>

        </div>
    </div>
</header>
