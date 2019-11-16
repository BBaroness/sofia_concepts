<?php

    class FormHandler {

        /* Class has empty destructers are empty because this class only has
            static methods
        */

        function _construct() {

        }

        function _destruct() {

        }
        
        // Include static methods for form handling

        public static function sanitizeHtmlInput( $input) {
            $input = htmlspecialchars($input);
            $input = trim($input);      // remove unnecessary characters
            $input = stripslashes($input);      // remove any backslash

            return $input;            
        }


        /**
         * This is a method that validates Ghanaian mobile phone numbers. It validates numbers without the country code
         */
        public static function validatePhoneNumber($inputPhoneNumber) {
            // Firstly, remove all whitespace from the string
            $inputPhoneNumber = preg_replace('/\s+/', '', $inputPhoneNumber);

            if (preg_match("/0[2,5][0,4,5,6,7]([0-9]{7})/",$inputPhoneNumber)) {
                return true;
            }else {
                return false;
            }                
        }


    }


?>