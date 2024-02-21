<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail):void
    {

        $g_response = Http::asForm()->post( "https://www.google.com/recaptcha/api/siteverify",[
            'secret' => '6LcpwlEpAAAAAAprUTBl6lV3KhCIHcpf_oovmKMx',
            'response' => $value,
            'remoteip' => \request()->ip()
        ])->object();
        if ($g_response->success == true && $g_response->score>=7) {
        }
        else{
        }
        
    }
}
