<?php

include 'engine/engine.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= WEBSITE_NAME ?></title>

    <!-- CSS Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/en.js"></script>
    <style>
        main { min-height: calc(100vh - 28px); }
        footer { height: 28px; overflow: hidden; }
        .accordion-button:not(.collapsed) { background-color: #ffca2c; color: #000; }
        .accordion-button:focus { border-color: #000!important; box-shadow: 0 0 0 0.25rem #000!important; }
        .tooltip-inner { background-color: #ffca2c!important; color: #000; }
        .tooltip-arrow { visibility: hidden!important; }
    </style>
</head>
<body>
    <main>

    <!-- Navigation -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand h1 my-0" href="index.php">
                <svg width="26" height="26" viewBox="0 0 16 16" class="bi bi-bootstrap-fill d-inline-block align-top" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.002 0a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4h-8zm1.06 12h3.475c1.804 0 2.888-.908 2.888-2.396 0-1.102-.761-1.916-1.904-2.034v-.1c.832-.14 1.482-.93 1.482-1.816 0-1.3-.955-2.11-2.542-2.11H5.062V12zm1.313-4.875V4.658h1.78c.973 0 1.542.457 1.542 1.237 0 .802-.604 1.23-1.764 1.23H6.375zm0 3.762h1.898c1.184 0 1.81-.48 1.81-1.377 0-.885-.65-1.348-1.886-1.348H6.375v2.725z" />
                </svg>
                <?= WEBSITE_NAME ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">

                <?
                if($user->isLoggedIn() && $user->getUserRole() == '2') $pages = $page->getPage('%', '2');
                elseif($user->isLoggedIn() && $user->getUserRole() != '2') $pages = $page->getPage();
                else $pages = $page->getPage('%', '1');

                $i = 0;
                foreach ($pages as $pg) {
                if($pg['access'] == '0' || $pg['access'] == '1' && $user->isLoggedIn() || $pg['access'] == '2' && $user->isLoggedIn() && $user->getUserRole() != '2') {
                    $i++;
                    echo '<li class="nav-item">
                        <a class="nav-link';
                        if($i == 1 && $b == '' || $b == $pg['page_id']) echo ' active';
                    echo '" href="index.php?p=menu&b=' . $pg['page_id'] . '">' . $pg['title'] . '</a>
                    </li>';
                    }
                } ?>
                </ul>

                <ul class="navbar-nav gap-2">
                <? if($user->isLoggedIn()) { ?>
                    <li class="navbar-item">
                        <button type="button" id="profile" class="btn btn-light btn-sm" data-toggle="modal" data-target="#profile-modal"><?= $_SESSION['name']; ?>
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </button>
                    </li>

                    <? if($user->isLoggedIn() && $user->hasPrivilege('1')) { ?>
                    <li class="navbar-item">
                        <a href="index.php?p=admin" class="btn btn-light btn-sm">Admin Panel
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                            </svg>
                        </a>
                    </li>
                    <? } ?>
                    <li class="nav-item">
                        <a href="index.php?p=logout" class="btn btn-light btn-sm">Logout
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
                                <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
                            </svg>
                        </a>
                    </li>
                    <? } else { ?>
                    <li class="nav-item">
                        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#login-modal">Login
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-key" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </button>
                    </li>
                    <? if(SIGNUP_ENABLED) { ?>
                    <li class="nav-item">
                        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#register-modal">Register
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-unlock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.655 8H2.333c-.264 0-.398.068-.471.121a.73.73 0 0 0-.224.296 1.626 1.626 0 0 0-.138.59V14c0 .342.076.531.14.635.064.106.151.18.256.237a1.122 1.122 0 0 0 .436.127l.013.001h7.322c.264 0 .398-.068.471-.121a.73.73 0 0 0 .224-.296 1.627 1.627 0 0 0 .138-.59V9c0-.342-.076-.531-.14-.635a.658.658 0 0 0-.255-.237A1.122 1.122 0 0 0 9.655 8zm.012-1H2.333C.5 7 .5 9 .5 9v5c0 2 1.833 2 1.833 2h7.334c1.833 0 1.833-2 1.833-2V9c0-2-1.833-2-1.833-2zM8.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                            </svg>
                        </button>
                    </li>
                    <? }} ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <?php

    if($p == '') {
        ?>
        <div class="container py-3">
            <? if(!empty($pages)) {
                $pg = $pages[0];
                if($pg['access'] == '0' || $pg['access'] == '1' && $user->isLoggedIn() || $pg['access'] == '2' && $user->isLoggedIn() && $user->getUserRole() != '2') {
                    echo $pg['content']; ?>
                    <span class="text-muted">
                        Published by: <?= $user->getUser($pg['author'])[0]['username'] . ' @ ' . $pg['timestamp']; ?>
                    </span>
                <? }
            } else { echo 'Empty'; } ?>
        </div>      
    <? }
    elseif($p == 'menu') {
        $pg = $page->getPage($b);
        $pg = $pg[0];
        if($pg['access'] == '0' || $pg['access'] == '1' && $user->isLoggedIn() || $pg['access'] == '2' && $user->isLoggedIn() && $user->getUserRole() != '2') { ?>
        <div class="container py-3">
            <?= $pg['content']; ?>
            <span class="text-muted">
                Published by: <?= $user->getUser($pg['author'])[0]['username'] . ' @ ' . $pg['timestamp']; ?>
            </span>
        </div>      
    <? }}
    elseif($p == 'admin' && $user->isLoggedIn() && $user->hasPrivilege('1')) {
        include 'adminpanel.php';
    }
    elseif($p == 'logout' && $user->isLoggedIn()) {
        session_destroy();
        redirect();
    }

    ?>

    </main>

    <!-- Footer -->
    <footer class="bg-dark">
        <span class="badge bg-light text-dark ml-5">
            <?= WEBSITE_NAME ?> &copy; 2020
        </span>
    </footer>

    <!-- Modals -->
    <? if(!$user->isLoggedIn() || $user->hasPrivilege('2')) { ?>
    <div class="modal fade" id="login-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login-form">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-success">Sign In</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="register-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register</h5>
                    <button type="button" class="btn-close" id="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success alert-dismissible fade collapse" id="registerUser" role="alert">
                        User added successfuly!
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <form id="register-form">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="register-username">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="register-email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="register-password1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="register-password1">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="register-password2" class="form-label">Repeat Password</label>
                            <input type="password" class="form-control" id="register-password2">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-success">Register</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <? } ?>
    
    <div class="modal fade" id="profile-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile</h5>
                    <button type="button" class="btn-close" id="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <? $u = $user->getUser($_SESSION['id'])[0]; ?>
                    Username:&nbsp;
                    <b><?= $u['username']; ?></b><br>
                    <br>Email:&nbsp;
                    <b><?= $u['email']; ?></b><br>
                    <br>Role:&nbsp;
                    <b><?= $role->getRole($u['role'])[0]['name'] . '</b>  (' . $role->getRole($u['role'])[0]['description'] . ')'; ?><br>
                    <br>Privileges:&nbsp;
                    <b><?= $role->getPrivileges($u['role'])[0]['privileges']; ?></b><br>
                    <br>Joined:&nbsp;
                    <b><?= $u['joined']; ?></b><br>
                </div>
                <button type="button" class="btn btn-secondary m-2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
    <script src="engine/javascript.js"></script>

</body>
</html>