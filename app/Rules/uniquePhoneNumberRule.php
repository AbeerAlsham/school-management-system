<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class uniquePhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Get all the phone numbers from the request
        $phoneNumbers = collect(request()->input('phone_numbers'))->pluck('phone_number')->toArray();

        // Remove the current phone number from the array
        $currentIndex = explode('.', $attribute)[1];

        // Remove the phone number at the correct index
        // unset($phoneNumbers[$index]);
        for ($i = 0; $i < $currentIndex; $i++) { {
                if ($value === $phoneNumbers[$i]) {
                    $fail('The :attribute must not be duplicate.');
                }
            }
        }
    }
}
