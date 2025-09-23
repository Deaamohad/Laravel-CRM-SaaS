<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SanitizeText implements Rule
{
    /**
     * Create a new rule instance.
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
        // This rule always passes - it's used for sanitization, not validation
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute contains invalid characters.';
    }

    /**
     * Sanitize the input value
     *
     * @param  mixed  $value
     * @return string
     */
    public static function sanitize($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        // Remove HTML tags and encode special characters
        $sanitized = strip_tags($value);
        
        // Decode HTML entities to prevent double encoding
        $sanitized = html_entity_decode($sanitized, ENT_QUOTES, 'UTF-8');
        
        // Re-encode special characters for security
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
        
        // Remove any remaining potentially dangerous characters
        $sanitized = preg_replace('/[<>"\']/', '', $sanitized);
        
        return trim($sanitized);
    }
}

