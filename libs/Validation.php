<?php
/**
 * Tell it what fields you expect
 * Pass the Post data to these fiels 
 * Send them through any rules you add
 * Validate
 */
Class Validation {

    public function __construct() {

        

    }

    public function minlength( $data, $arg ){

        if ( strlen( $data ) < $arg ) {

            return "Your string can only be $arg long";

        }

    }


    public function maxlength( $data, $arg ) {

        if ( strlen( $data ) > $arg ) {

            return "Your string can only be $arg long";

        }

    }

    public function digit( $data ) {

        if ( ctype_digit( $data ) == false ) {

            return "Your string must be a digit";

        }

    }

    public function required( $data ) {

        if ( empty( $data ) ) {

            return "This field is required";

        }

    }

    public function __call( $name, $arguments ) {

       throw new Exception("$name does not exist inside of: " . __CLASS__);

    }



}