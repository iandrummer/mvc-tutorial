<?php

Class Database extends PDO {

    public function __construct() {
        parent::__construct('mysql:host=localhost;dbname=films', 'films_user', 'password');
    }


    /**
     * Updates the table based on the data and where values
     * @param  string $table name of table
     * @param  Array $data  update values
     * @param  Array $where conditional values
     * @return null
     */
    public function update( $table, $data, $where ) {

        $updatedValues = '';

        foreach ( $data as $key => $value ) {

            $updatedValues .= "`$key` = :$key,";

        }

        $updatedValues = rtrim( $updatedValues, ',' );

        $whereValues = '';

        foreach ( $where as $key => $value ) {

            $whereValues .= "`$key` = :$key AND";

        }

        $whereValues = rtrim( $whereValues, 'AND' );

        $sth = $this->prepare("UPDATE $table SET $updatedValues WHERE $whereValues");

        foreach ( $data as $key => $value ) {

            $sth->bindValue(":$key", $value);

        }

        foreach ( $where as $key => $value ) {

            $sth->bindValue(":$key", $value);

        }

        $sth->execute();

    }


    /**
     * Select statement abstraction
     * @param  string $what  the columns to be selected
     * @param  string $table name of table
     * @param  Array $where key value pairs for the where conditions
     * @return Array results.
     */
    public function select( $what, $table, $where = false ) {

        if ( $where != false ) {

            $whereValues = '';

            foreach ( $where as $key => $value ) {

                $whereValues .= "`$key` = :$key AND";

            }

            $whereValues = rtrim( $whereValues, 'AND' );

            $sth = $this->prepare("SELECT $what FROM $table WHERE $whereValues");

            foreach ( $where as $key => $value ) {

                $sth->bindValue(":$key", $value);

            }

        } else {

            $sth = $this->prepare("SELECT $what FROM $table");

        }

        $sth->execute();

        return $sth->fetchAll();

    }

    /**
     * Delete records from table
     * @param  string $table table to delete from
     * @param  Array $where array of conditionals
     * @return null
     */
    public function delete( $table, $where ) {

        $whereValues = '';

        foreach ( $where as $key => $value ) {

            $whereValues .= "`$key` = $value AND";

        }

        $whereValues = rtrim( $whereValues, 'AND' );

        $sth = $this->exec("DELETE FROM $table WHERE $whereValues LIMIT 1");

    }

    /**
     * Insert new data into the database
     * @param  string $table table to insert to
     * @param  Array $data  array of data
     * @return null
     */
    public function insert( $table, $data ) {

        ksort( $data );

        $whatColumns = implode( '`, `', array_keys( $data ) );

        $whatValues = ':' . implode( ', :', array_keys( $data ) );

        $sth = $this->prepare("INSERT INTO $table ( `$whatColumns` ) VALUES ( $whatValues ) ");

        foreach ( $data as $key => $value ) {

            $sth->bindValue(":$key", $value);

        }

        $sth->execute();

        return $sth->fetchAll();

    }

}