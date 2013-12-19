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

    private function _grabPostData( $fields ) {

        foreach( $fields as $field ) {

            if ( isset( $_POST[ $field ] ) ) {

                $this->_postData[ $field ] = $_POST[ $field ];

            }

        }

        return $this;

    }

    public function add_rule( $field, $validators ) {

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


    public function grabData() {

        return $this->_postData;

    }



}

