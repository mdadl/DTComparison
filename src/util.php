<?php
/**
 * Util class provides some utils.
 */
class Util {
    
    /**
     * 
     * This function accepts the list of supported functions and returns a formated text.
     * 
     * @param string $supported_functions
     * @return string
     */
    function supported_functions($supported_functions) {
        $return_value = '';
        $return_value .= 'Supported function_name are: ';
        $i = 0;
        foreach ($supported_functions as $value) {
            if ($i > 0) {
                $return_value .= ', ';
            }
            $return_value .= $value;
            $i++;
        }
        $return_value .= ".\n";
        return $return_value;
    }
    
    /**
     *
     * This function accepts the list of supported return types and returns a formated text.
     *
     * @param string $supported_return_types
     * @return string
     */
    function supported_return_type($supported_return_types) {
        $return_value = '';
        $return_value .= 'Supported return_type are: ';
        $i = 0;
        foreach ($supported_return_types as $key => $value) {
            if ($i > 0) {
                $return_value .= ', ';
            }
            $return_value .= "$key for $value";
            $i++;
        }
        $return_value .= ".\n";
        return $return_value;
    }
}
?>