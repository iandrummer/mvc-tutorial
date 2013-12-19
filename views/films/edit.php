<p> Welcome to the Film section of the site </p>

<?php print_r( $this->review ); ?>

<form action="<?php echo SITE_URL . 'films/save/' . $this->review['filmid']?>" method="post">

    <ul>

       <li>

            <label for="title">Title</label><input id="title" name="title" type="text" value = "<?php echo isset( $this->review['title'] ) ? $this->review['title'] : ''; ?>"/>

        </li>

        <li>

            <label for="rating">Rating</label>
            <select id="rating" name="rating">
                <option value="0" <?php echo ( $this->review['rating'] == 0 ) ? 'selected="selected"' : ''; ?>> 0 stars</option>
                <option value="1" <?php echo ( $this->review['rating'] == 1 ) ? 'selected="selected"' : ''; ?>> 1 stars</option>
                <option value="2" <?php echo ( $this->review['rating'] == 2 ) ? 'selected="selected"' : ''; ?>> 2 stars</option>
                <option value="3" <?php echo ( $this->review['rating'] == 3 ) ? 'selected="selected"' : ''; ?>> 3 stars</option>
                <option value="4" <?php echo ( $this->review['rating'] == 4 ) ? 'selected="selected"' : ''; ?>> 4 stars</option>
                <option value="5" <?php echo ( $this->review['rating'] == 5 ) ? 'selected="selected"' : ''; ?>> 5 stars</option>
            </select>

        </li>

        <li>

            <label for="notes">Notes</label>
            <textarea name="notes" id="notes"><?php echo isset( $this->review['notes'] ) ? trim( $this->review['notes'] ) : ''; ?></textarea>

        </li>

        <li>

            <input type="submit" value="Submit" />

        </li>

    </ul>

</form>


