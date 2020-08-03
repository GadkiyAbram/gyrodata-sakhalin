<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Monolog\Handler\FallbackGroupHandler;

class IfAssetNeeded implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $item;
    
    public function __construct($item)
    {
        $this->item = $item;
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
        if ($this->item == "GDP Sections" || 
            $this->item == "GWD Modem" || 
            $this->item == "GWD Bullplug")
        {
            if (empty($value)){
                return false;
            }
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
        return 'For ' . $this->item . ' you need Asset';
    }
}
