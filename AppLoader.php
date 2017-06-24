<?php
/**
 * Created by IntelliJ IDEA.
 * User: LT
 * Date: 25/06/17
 * Time: 2:28 AM
 */

namespace bootphp\loader {

    abstract class AppLoader
    {
        private static $__SCANNED__PARAMS__ = false;

        public abstract function invoke();

        public function __get($name)
        {
            if (isset($_GET[$name])) {
                return $_GET[$name];
            }
            return null;
        }

        private function _populate_params_()
        {
            if (!self::$__SCANNED__PARAMS__) {
                foreach ($this as $key => $value) {
                    if (isset($_REQUEST[$key])) {
                        $this->{$key} = $_REQUEST[$key];
                    }
                }
                self::$__SCANNED__PARAMS__ = true;
                return true;
            }
            return false;
        }

        public function execute()
        {
            $this->_populate_params_();
            $this->invoke();
        }


        public function __invoke()
        {
            return $this->execute();
        }
    }

}

