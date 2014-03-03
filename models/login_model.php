<?php
/**
 * This is the Film Model that handles all the communications for CRUD of film reviews.
 */
Class Login_Model extends Model {

    /**
     * Constructs the Class and instantiates the parent.
     */
    public function __construct() {
        parent::__construct();
    }

    public function login() {

        $data = $_POST;

        $data['password'] = Hash::create( HASH_ALG, $data['password'], HASH_SALT );

        $user = $this->db->select( '*', 'users', $data );

        if ( count( $user ) > 0 ) {

            Session::init();

            Session::set('role', $user[0]['role'] );

            Session::set('loggedIn', true );

            Session::set('userid', $user[0]['userid'] );

        } 

    }

    public function logout() {

        Session::init();

        Session::destroy();

    }

}