<?php
/**
 * The basic Controller class. This will be extended by all other classes.
 */
Class Controller {

    function __construct() {
        $this->view = new View();
    }

}