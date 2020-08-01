<?php


namespace App\Http\Controllers;


class SHAHasher implements Illuminate\Hashing\HasherInterface {

    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @return string
     * @return string
     */
    public function make($value, array $options = array()) {
        return hash('sha256', $value);
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = array()) {
        return $this->make($value) === $hashedValue;
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = array()) {
        return false;
    }

}