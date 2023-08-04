<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Log;
use App\Repositories\user;

class UserService
{
    private $user;

    public function __construct(ModelsUser $user)
    {
        $this->user = $user;
    }

    public function createUser(array $data): string
    {
        try {
            $user = $this->user->create($data);

            if(!$user)
            {
                Log::info('it was not possible to register the new user');
            }

            Log::info('Creating new user with queue');

            return 'successfully registered user';

        } catch (\Exception $exception) {
            throw new CustomException($exception->getMessage());
        }
    }
}
