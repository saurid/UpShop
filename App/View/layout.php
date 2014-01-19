<?php use UpMvc\Container as Up; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php _e($title) ?> | <?php _e(Up::site_name()) ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo Up::site_path() ?>/App/View/format.css" />    
</head>
<body>

<div id="header">
    <div class="container">
        <h1><a href="<?php echo Up::site_path() ?>"><?php _e(Up::site_name()) ?></a></h1>
        <?php include('App/View/cart_small.php') ?>
    </div>
</div>

<div id="divider"></div>

<div class="container">
    <?php if($categorycount): ?>
        <div id="menu">
            <ul>
                <?php foreach($categories as $key => $value): ?>
                    <li>
                        <a href="<?php echo Up::site_path() ?>/Category/show/<?php echo $value['id'] ?>"><?php _e($value['name']) ?></a>
                        <small>(<?php echo $value['count'] ?>)</small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif ?>

    <div id="body">
        <?php echo $content ?>
    </div>
</div>

</body>
</html>