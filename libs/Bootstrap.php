<?php 

class Bootstrap {


    private $_url = null;
    private $_controller = null;
    private $_method = 'index';
    private $_params = array();

    private $_controllerPath = 'controllers/';
    private $_errorFile = 'error.php';
    private $_defaultController = 'Welcome.php';

    public function __construct() {


        $this->_getURL();

    }


    /**
     * _getURL - handles the url 
     * @return null
     */
    private function _getURL() {

        $url = isset( $_GET['url'] ) ? $_GET['url'] : '';

        $url = filter_var( $url, FILTER_SANITIZE_URL);

        $url = rtrim( $url, '/' );

        $url = explode('/', $url, 3 );

        $this->_url = $url;

        @list( $controller, $method, $params ) = $url;

        if ( empty( $this->_url[0] ) ) {

            $this->_loadDefaultController();

            return false;

        }

        if ( isset( $controller ) ) {

            $this->_loadExistingController();

        }

        if ( isset( $method ) ) {

            $this->_callControllerMethod();

        }

        if ( isset( $params ) ) {

            $this->_loadParam( explode('/', $params ) );

        }

        $this->_run();


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

        } else {

            $this->_error();

            return false;

        }

        return $this;

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

        $this->_method = $this->_url[1];

        return $this;

        // switch ( $length ) {

        //     case 5: 

        //         $this->_controller->{$this->_url[1]}( $this->_url[2], $this->_url[3], $this->_url[4] );

        //         break;

        //     case 4: 

        //         $this->_controller->{$this->_url[1]}( $this->_url[2], $this->_url[3] );

        //         break;

        //     case 3: 

        //         $this->_controller->{$this->_url[1]}( $this->_url[2] );

        //         break;

        //     case 2: 

        //         $this->_controller->{$this->_url[1]}();

        //         break;

        //     default: 

        //         $this->_controller->index();

        // }

    }

    private function _loadParam( $params ) {

        $this->_params = $params;

        return $this;

    }

    private function _run() {

        call_user_func_array( array($this->_controller, $this->_method ), $this->_params );

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