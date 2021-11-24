<?php

namespace App\Rules;

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\Rule;

class RecaptchaRule implements Rule
{
    protected $score;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($score = 0.7)
    {
        $this->score = $score;
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

        if(config('app.env') == 'local') return true;
        
        try {
            $response = Http::asForm()->post(config('recaptcha.url'), [
                'secret' => config('recaptcha.secret'),
                'response' => $value
            ])->json();
    
            if (!$response['success']) {
                return false;
            }
    
            if ($response['success'] < $this->score) {
                return false;
            }
        } catch (\Exception $e) {
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
        return 'Invalid Recaptcha.';
    }
}
