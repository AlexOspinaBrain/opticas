<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class abonovalido implements Rule
{
    public $total;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($total = 0)
    {
        $this->total = $total;
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
        return $value <= $this->total ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El abono no puede ser mayor al total de la factura.';
    }
}
