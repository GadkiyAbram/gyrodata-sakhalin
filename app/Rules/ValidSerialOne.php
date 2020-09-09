<?php

namespace App\Rules;

use App\Http\Controllers\APIHelper;
use Illuminate\Contracts\Validation\Rule;

class ValidSerialOne implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $serialOne;

    public function __construct($serialOne)
    {
        $this->serialOne = $serialOne;
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
        $service = 'BatteryBySerial';
        $uri = APIHelper::getUrl($service) . $this->serialOne;
        $data = APIHelper::getRecord($uri);
        // dd($data);
        if(count($data) != 0){
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
        return 'Sorry, Battery ' . $this->serialOne . ' already stored';
    }
}
