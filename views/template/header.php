<head>

<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL . ASSETS . STYLE_CSS; ?>">

</head>
<body>

<header>

Filmbuzz

<ul>

    <li> <a href="<?php echo URL::fullURL(''); ?>" >Home </a> </li>

    <li> <a href="<?php echo URL::fullURL('films'); ?>" >Films </a> </li>

    <?php if ( isset( $_SESSION['loggedIn'] ) && $_SESSION['loggedIn'] == 1 ) : ?>

        <li> <a href="<?php echo URL::fullURL('login/logout'); ?>"> Log out </a> </li>

        <?php if ( $_SESSION['role'] == "owner" ) : ?>

            <li> <a href="<?php echo URL::fullURL('users'); ?>" > Users </a> </li>

        <?php endif; ?>

    <?php else : ?>

        <li> <a href="<?php echo URL::fullURL('login'); ?>"> Log in </a> </li>

    <?php endif; ?>

</ul>

</header>

<div>