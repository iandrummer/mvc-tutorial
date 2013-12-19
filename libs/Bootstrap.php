<?php 

class Bootstrap {


    private $_url = null;
    private $_controller = null;

    private $_controllerPath = 'controllers/';
    private $_errorFile = 'error.php';
    private $_defaultController = 'Welcome.php';

    public function __construct() {


        $this->_getURL();

        if ( empty( $this->_url[0] ) ) {

            $this->_loadDefaultController();

            return false;

        }

        $this->_loadExistingController();

    }


    /**
     * _getURL - handles the url 
     * @return null
     */
    private function _getURL() {

        $url = isset( $_GET['url'] ) ? $_GET['url'] : '';

        $url = filter_var( $url, FILTER_SANITIZE_URL);

        $url = rtrim( $url, '/' );

        $url = explode('/', $url );

        $this->_url = $url;

    }


    /**
     * _loadDefaultController - Loads the default controller
     * @return null
     */
    private function _loadDefaultController() {

        include $this->_controllerPath . $this->_defaultController;

        $this->_controller = new Welcome();

        $this->_controller->index();

    }

    /**
     * This tries to load the controller from the url, if it doesn't exist it throws an error
     * @return mixed false if an error is thrown
     */
    private function _loadExistingController() {

        $file = $this->_controllerPath . $this->_url[0] . '.php';

        if( file_exists( $file ) ) {

            include $file;

            $this->_controller = new $this->_url[0]();

            $this->_callControllerMethod();

        } else {

            $this->_error();

            return false;

        }

    }

    /**
     * Determines what method to call and how many arguments to pass it
     * @return mixed False if an error is thrown
     */
    private function _callControllerMethod() {

        $length = count( $this->_url );

        if ( $length > 1 ) {

            if ( !method_exists( $this->_controller, $this->_url[1] ) ) {

                $this->_error();

                return false;

            }

        }

        switch ( $length ) {

            case 5: 

                $this->_controller->{$this->_url[1]}( $this->_url[2], $this->_url[3], $this->_url[4] );

                break;

            case 4: 

                $this->_controller->{$this->_url[1]}( $this->_url[2], $this->_url[3] );

                break;

            case 3: 

                $this->_controller->{$this->_url[1]}( $this->_url[2] );

                break;

            case 2: 

                $this->_controller->{$this->_url[1]}();

                break;

            default: 

                $this->_controller->index();

        }

    }


    /**
     * Handles any errors that are thrown
     * @return false
     */
    private function _error() {

        require $this->_controllerPath . $this->_errorFile;

        $this->_controller = new Error();

        $this->_controller->index();

        return false;

    }


}