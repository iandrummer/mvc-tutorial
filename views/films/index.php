<p> Welcome to the Film section of the site </p>

<form action="<?php echo SITE_URL; ?>films/create" method="post" id="addFilmReview">

    <ul>

        <li>

            <label for="title">Title</label><input id="title" name="title" type="text" />

        </li>

        <li>

            <label for="rating">Rating</label>
            <select id="rating" name="rating">
                <option value="0"> 0 stars</option>
                <option value="1"> 1 stars</option>
                <option value="2"> 2 stars</option>
                <option value="3"> 3 stars</option>
                <option value="4"> 4 stars</option>
                <option value="5"> 5 stars</option>
            </select>

        </li>

        <li>

            <label for="notes">Notes</label>
            <textarea name="notes" id="notes"></textarea>

        </li>

        <li>

            <input type="submit" value="Submit" />

        </li>

    </ul>

</form>

<hr>

<?php if ( isset( $this->reviews ) ) : ?>

    <table>

        <tr> 

            <th> Title </th>

            <th> Rating </th>

            <th> Notes </th>

        </tr>



    <?php foreach ( $this->reviews as $key => $value ) : ?>

        <tr>

            <td> <?php echo $value['title']; ?> </td>

            <td> <?php echo $value['rating']; ?> </td>

            <td> <?php echo $value['notes']; ?> <a href="<?php echo SITE_URL . 'films/edit/' . $value['filmid']; ?>"> Edit </a><a href="<?php echo SITE_URL . 'films/delete/' . $value['filmid']; ?>"> Delete </a> </td>

        </tr>

    <?php endforeach; ?>

    </table>

<?php endif; ?>
