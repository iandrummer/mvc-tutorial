<?php 

Class URL {

    public static function redirect( $relativeURL ) {

        header( 'Location:' . SITE_URL . $relativeURL );

    }

    public static function fullURL( $relativeURL ) {

        return SITE_URL . $relativeURL;

    }

}