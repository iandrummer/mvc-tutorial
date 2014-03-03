<p> Please log in below </p>
<?php print_r( $_SESSION ); ?>
<form action="<?php echo SITE_URL; ?>login/run" method="post" id="addFilmReview">

    <ul>

        <li>

            <label for="name">Name</label><input id="name" name="name" type="text" />

        </li>

        <li>

            <label for="password">Password</label><input id="password" name="password" type="password" />

        </li>

        <li>

            <input type="submit" value="Submit" />

        </li>

    </ul>

</form>

<hr>
