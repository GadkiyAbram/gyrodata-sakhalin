<?php

namespace App\Rules;

use App\Http\Controllers\APIHelper;
use Illuminate\Contracts\Validation\Rule;

class ValidJobNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $jobNumber;

    public function __construct($jobNumber)
    {
        $this->jobNumber = $jobNumber;
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
        $service = 'JobCustom';
        $uri = APIHelper::getUrl($service) . "/" . $this->jobNumber;
        $data = APIHelper::getRecordItemAsset($uri);
        if (count($data) != 0){
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
        return 'Sorry, ' . $this->jobNumber . ' already stored';
    }
}
