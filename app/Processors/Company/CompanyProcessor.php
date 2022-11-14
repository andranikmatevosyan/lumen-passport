<?php

namespace App\Processors\Company;

use App\Components\Company\CompanyCreateComponent;
use App\Models\Company;
use App\Models\User;
use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyProcessor
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ) {
        //
    }

    /**
     * @param User $user
     * @param array $data
     * @return Model|Company|Builder
     */
    public function processCreate(User $user, array $data): Model|Company|Builder
    {
        $component = CompanyCreateComponent::fromArray($user, $data);
        $company = $this->companyRepository->create($component);

        return $company->load('user');
    }

    /**
     * @param User $user
     * @return Collection|array
     */
    public function processList(User $user): Collection|array
    {
        return $this->companyRepository->list($user);
    }

}
