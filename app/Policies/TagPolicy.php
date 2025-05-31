<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Tag;

class TagPolicy
{
    public function create(User $user): bool
    {
        return true;
    }
}
