<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => 3,
        ]);
        UserInfo::create([
            'user_id' => $user->id,
            'town' => $input['town'],
            'phone' => $this->formatPhoneNumber($input['phone']),
            'other_info' => $input['other_info'],
        ]);
        return $user;

    }

    public function formatPhoneNumber(string $number, string $country = null, bool $strip_plus = true): string
    {
        $number = preg_replace('/\s+/', '', $number);
        $replace = static function ($needle, $replacement) use (&$number) {
            if (Str::startsWith($number, $needle)) {
                $pos = strpos($number, $needle);
                $length = strlen($needle);
                $number = substr_replace($number, $replacement, $pos, $length);
            }
        };

//07 sanitizer
        $replace('2547', '+2547');
        $replace('07', '+2547');
        $replace('7', '+2547');

//01 sanitizer
        $replace('2541', '+2541');
        $replace('01', '+2541');

        if (!is_null($country)) {
            if ($country == 'KE') {
                $replace('1', '+2541');
            }
        }

        if ($strip_plus) {
            $replace('+254', '254');
        }

        return $number;
    }

}
