<?php

namespace App\Repositories;

use App\Components\Company\CompanyCreateComponent;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository
{
    /**
     * @param CompanyCreateComponent $component
     * @return Model|Company|Builder
     */
    public function create(CompanyCreateComponent $component): Model|Company|Builder
    {
        return Company::query()->create($component->all());
    }

    /**
     * @param User $user
     * @return Collection|array
     */
    public function list(User $user): Collection|array
    {
        return Company::query()->where('user_id', '=', $user->id)->get();
    }


}
