<?php
/**
 * The base View class.
 */
Class View {

    /**
     * __construct - 
     */
    function __construct() {}

    /**
     * render - includes the requested view file
     * @param  string $view - path to the view file
     * @return null
     */
    public function render( $view, $noInclude = false ) {

        if ( $noInclude == true ) {

            require 'views/' . $view . '.php';

        }

        else {

            require 'views/template/header.php';

            require 'views/' . $view . '.php';

            require 'views/template/footer.php';

        }

    }
}