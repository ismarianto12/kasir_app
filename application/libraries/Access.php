<?php

define('EXT', PATHINFO_EXTENSION);

class Access
{
    // Codeigniter reference 
    private $CI;

    // Array that will hold the controller names and methods
    private $aControllers;

    // Construct
    function __construct()
    { 
        // Get Codeigniter instance 
        $this->CI = &get_instance();

        // Get all controllers 
        $this->setControllers();
    }

    /**
     * Return all controllers and their methods
     * return array
     */
    public function getControllers()
    {
        return $this->aControllers;
    }

    /**
     * Set the array holding the controller name and methods
     */
    public function setControllerMethods($p_sControllerName, $p_aControllerMethods)
    {
        $this->aControllers[$p_sControllerName] = $p_aControllerMethods;
    }

    /**
     * Search and set controller and methods.
     */
    private function setControllers()
    {

        foreach (glob(APPPATH . '/*') as $modules_all) {

            if (is_dir($modules_all)) {

                $dirname = basename($modules_all);

                foreach (glob(APPPATH . '/controllers/*') as $subdircontroller) {

                    $subdircontrollername = basename($subdircontroller, EXT);


                    if (!class_exists($subdircontrollername)) {
                        $this->CI->load->file($subdircontroller);
                    }

                    $aMethods = get_class_methods($subdircontrollername);
                    $aUserMethods = array();
                    foreach ($aMethods as $method) {
                        if ($method != '__construct' && $method != 'get_instance' && $method != $subdircontrollername) {
                            $aUserMethods[] = $method;
                        }
                    }
                    $this->setControllerMethods($subdircontrollername, $aUserMethods);
                }
            } else if (pathinfo($controller, PATHINFO_EXTENSION) == "php") {

                $controllername = basename($controller, EXT);


                if (!class_exists($controllername)) {
                    $this->CI->load->file($controller);
                }


                $aMethods = get_class_methods($controllername);
                $aUserMethods = array();
                if (is_array($aMethods)) {
                    foreach ($aMethods as $method) {
                        if ($method != '__construct' && $method != 'get_instance' && $method != $controllername) {
                            $aUserMethods[] = $method;
                        }
                    }
                }

                $this->setControllerMethods($controllername, $aUserMethods);
            }
        }
    }
}
