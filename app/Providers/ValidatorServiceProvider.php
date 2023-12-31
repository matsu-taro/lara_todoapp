<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('owner_name_check', function ($attribute, $value, $parameters, $validator) {
            $newOwnerName = $validator->getData()['new_owner_name'];
            $ownerName = $validator->getData()['owner_name'];

            if ($newOwnerName === null && $ownerName == '0') {
                return false;
            }

            if ($newOwnerName !== null && $ownerName !== '0') {
                return false;
            }            

            return true;
        });
    }
}
