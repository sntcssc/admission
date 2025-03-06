<?php

return [
    'password' => [
        'min_length' => 8,
        'require_mixed_case' => true,
        'require_numbers' => true,
        'require_symbols' => true,
    ],
    'otp' => [
        'expiration' => 15, // minutes
        'max_attempts' => 3,
        'resend_cooldown' => 60, // seconds
    ],
    'session' => [
        'inactivity_timeout' => 1200, // seconds
        'regenerate' => true,
    ],
];