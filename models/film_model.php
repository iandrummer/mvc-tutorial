<?php
/**
 * This is the Film Model that handles all the communications for CRUD of film reviews.
 */
Class Film_Model extends Model {

    /**
     * Constructs the Class and instantiates the parent.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Inserts a Film review into the films table.
     * @param  Array $data contains the data from the submit form
     * @return null
     */
    public function createReview( $data ) {

        $this->db->insert('films', $data );

    }

    /**
     * Updates a record after it has been edited
     * @param  Array $data contains the updated data from the edit form
     * @param  integer $filmId row id of the record
     * @return null
     */
    public function saveReview( $data, $filmId ) {

        $this->db->update('films', $data, array('filmid' => $filmId ) );

    }

    /**
     * Grabs all reviews from the website
     * @return Array Contains the arrays of the data
     */
    public function grabReviews() {

        return $this->db->select( '*', 'films');

    }


    /**
     * Grabs a single review from the films table
     * @param  integer $filmId the row id of the entry in the database
     * @return Array   of the data
     */
    public function grabSingleReview( $filmId ) {

        $query = $this->db->select( '*', 'films', array('filmid' => $filmId ) );

        return $query[0];

    }

    /**
     * Deletes the relevant review
     * @param  integer $filmId the row id of the entry in the database
     * @return null
     */
    public function deleteReview( $filmId ) {

        $sth = $this->db->delete('films', array('filmid' => $filmId ) );

    }

}