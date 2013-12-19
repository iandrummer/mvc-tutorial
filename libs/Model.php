<?php
/**
 * The base Model class.
 */
Class Model {

    /**
     * __construct - 
     */
    function __construct() {
        $this->db = new Database();
    }

}