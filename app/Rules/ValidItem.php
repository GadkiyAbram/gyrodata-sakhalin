<?php

namespace App\Rules;

use App\Http\Controllers\APIHelper;
use Illuminate\Contracts\Validation\Rule;

class ValidItem implements Rule
{
    /**
     * Create a new rule instance.
     *
     *
     * @return void
     */
    
    protected $item;
    protected $asset;
//     protected $asset;
    
    public function __construct($item, $asset)
    {
        $this->item = $item;
        $this->asset = $asset;
//         $this->asset = $value[1];
        
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
//         dd($value, $this->item);
        $service = 'ToolGetItemAsset';
        $uri = APIHelper::getUrl($service) . "?item=" . $this->item . "&asset=" . $value;
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
        return 'Sorry, ' . $this->item . ' ' . $this->asset . ' already stored';
    }
}
