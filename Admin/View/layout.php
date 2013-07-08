<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php _e($title) ?> | <?php _e(UpMvc\Container::get()->site_name) ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo UpMvc\Container::get()->site_path ?>/App/View/format.css" />    
</head>
<body>

<div id="header">
    <div class="container">
        <h1><a href="<?php echo UpMvc\Container::get()->site_path ?>"><?php _e(UpMvc\Container::get()->site_name) ?>: Admin</a></h1>
    </div>
</div>

<div id="divider"></div>

<div class="container">
    <div id="menu">
        <ul>
            <?php if($user->isin()): ?>
                <li><a href="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Item">Artiklar</a></li>
                <li><a href="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Category">Kategorier</a></li>
                <li><a href="<?php echo UpMvc\Container::get()->site_path ?>/Admin/User">Användare</a></li>
                <li>&nbsp;</li>
                <li><a href="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Login/logout">Logga ut</a></li>
            <?php endif; ?>
            <li><a href="<?php echo UpMvc\Container::get()->site_path ?>/">Visa shoppen</a></li>
        </ul>
    </div>

    <div id="body">
        <?php echo $content ?>
    </div>
</div>

</body>
</html>