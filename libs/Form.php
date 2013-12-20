<?php
/**
 * Tell it what fields you expect
 * Pass the Post data to these fiels 
 * Send them through any rules you add
 * Validate
 */
Class Form {

    private $_postData = array();

    private $_val = array();

    private $_error = array();

    public function __construct( $fields ) {

        $this->_val = new Validation();

        $this->_grabPostData( $fields );

    }

    /**
     * Grabs the relevant fields from the $_POST variables
     * @param  Array $fields Fields to be grabbed
     * @return Object  The Form object
     */
    private function _grabPostData( $fields ) {

        foreach( $fields as $field ) {

            if ( isset( $_POST[ $field ] ) ) {

                $this->_postData[ $field ] = $_POST[ $field ];

            }

        }

        return $this;

    }

    /**
     * Adds a rule to the validation call
     * @param string $field      Name of the field to be validated
     * @param string $validators Pipe (|) seperated list with arguments (if any) contained in square brackets
     */
    public function addRule( $field, $validators ) {

        $validators = explode( '|', $validators);

        foreach( $validators as $validator ) {

            $validatorPlusArgs = explode( '[', $validator);

            $validator = $validatorPlusArgs[0];

            $args = '';

            if ( isset( $validatorPlusArgs[1] ) ) {

                $args = rtrim( $validatorPlusArgs[1], ']' );

            }

            if ( $args == '' ) {

                $error = $this->_val->{$validator}( $this->_postData[ $field ] );

            } else {

                $error = $this->_val->{$validator}( $this->_postData[ $field ], $args );

            }

            if ( $error ) {

                $this->_error[ $field ][ $validator ] = $error;

            }


        }

        return $this;

    }


    public function addCAllback( $field, $nameOfFunction ) {

        $error = $nameOfFunction[0]::$nameOfFunction[1]( $this->_postData, $field );

        if ( $error ) {

            $this->_error[ $field ][ $nameOfFunction[1] ] = $error;

        }

        return $this;

    }

    /**
     * The execution method of the Form handler. This checks to see if there are any errors
     * @return boolean|Exception Either returns true or an exception
     */
    public function validate() {

        if ( empty( $this->_error ) ) {

            return true;

        } else {

            $str = '';

            foreach ( $this->_error as $key => $value ) {

                $str .= $key . ' => ';

                foreach ( $value as $val ) {

                    $str .= $val . ', ';

                }

                $str = rtrim( $str, ', ' );

            }

            throw new Exception( $str );

        }

    }

    /**
     * Public method to allow people to grab data
     * @return Array The post data
     */
    public function grabData() {

        return $this->_postData;

    }



}

