<?php
/**
 * Handles all the calls to the films section of the site.
 */
Class Films extends Controller {

    /**
     * Constructs the parent, and then instatiates the Film Model
     */
    public function __construct() {

        session_start();

        parent::__construct();

        $this->film_model = new Film_Model();

    }

    /**
     * default method called
     * @return string the rendered html.
     */
    public function index() {
        $this->view->reviews = $this->film_model->grabReviews();
        $this->view->render('films/index');
    }

    /**
     * Handles the form submit and sends the data to the model
     * @return null
     */
    public function create() {

        if ( $_POST ) {

            try {

                $fields = array( 
                    'title',
                    'rating',
                    'notes'
                    );

                $this->form = new Form( $fields );

                // $this->form->addRule( 'title', 'required');

                $this->form->addCallback( 'title', array( $this, 'myRequired') );

                $this->form->validate();

                $this->film_model->createReview( $this->form->grabData() );

                header('Location: ' . SITE_URL . 'films');

            } catch ( Exception $e ) {

                echo $e->getMessage();

                $this->view->render('films/index');

            }

        }

    }

    /**
     * Saves the form data after being submitted from the edit form
     * @param  integer $filmId the row id of the record from the database
     * @return null
     */
    public function save( $filmId ) {

        if ( $_POST ) {

            try {

                $fields = array( 
                    'title',
                    'rating',
                    'notes'
                    );

                $this->form = new Form( $fields );

                $this->form->addRule( 'title', 'required');

                $this->form->validate();

                $this->film_model->saveReview( $this->form->grabData(), $filmId );

                header('Location: ' . SITE_URL . 'films');

            } catch ( Exception $e ) {

                echo $e->getMessage();

                $this->view->render('films/edit');

            }

        }

    }


    /**
     * Edit form page.
     * @param  id $filmId row id of the record from the database
     * @return string         html for the page
     */
    public function edit( $filmId ) {

        $this->view->review = $this->film_model->grabSingleReview( $filmId );

        $this->view->render('films/edit');

    }


    /**
     * Deletes the record from the database
     * @param  integer $filmId the row id of the record from the database
     * @return null
     */
    public function delete( $filmId ) {

        $this->film_model->deleteReview( $filmId );

        header('Location: ' . SITE_URL . 'films');

    }

    /**
     * Example of a custom callback
     * @param  Array $postData $_POST data
     * @param  string $field    The name of the field that this will apply to
     * @return string|boolean
     */
    public function myRequired( $postData, $field ) {

        if ( empty( $postData[ $field ] ) ) {

            return "This field is required innit";

        }

    }

}