<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCCD implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match("/^([0-9]{8})-([0-9]{6})-([0-9]{7})$/", $value)){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong CCD pattern.';
    }
}
