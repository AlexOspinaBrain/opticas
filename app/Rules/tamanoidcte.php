<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class tamanoidcte implements Rule
{
    public $tiposid_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tiposid_id = null)
    {
        $this->tiposid_id=$tiposid_id;
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
        switch($this->tiposid_id){
            case 1:
                return strlen(strval($value)) <= 10;
                break;
            case 3:
                return strlen(strval($value)) <= 6;
                break;
            case 4:
                return strlen(strval($value)) <= 16;
                break;
            case 5:
                return strlen(strval($value)) <= 16;
                break;
            case 6:
                return strlen(strval($value)) <= 16;
                break;
            case 7:
                return strlen(strval($value)) <= 15;
                break;
            case 8:
                return strlen(strval($value)) <= 11;
                break;
            case 9:
                return strlen(strval($value)) <= 11;
                break;
            case 10:
                return strlen(strval($value)) <= 9;
                break;
            case 11:
                return strlen(strval($value)) <= 10;
                break;                                                                                                                                                                                                                                         
            case 12:
                return strlen(strval($value)) <= 12;
                break;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tamaño de identificación no coincide con el tipo de identificación.';
    }
}
