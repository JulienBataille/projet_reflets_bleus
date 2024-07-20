<?php

namespace App\Service;

use App\Repository\OptionRepository;

class OptionService
{
    public function __construct( private OptionRepository $optionRepository)
    {

    }

    public function findAll():array
    {
        return $this->optionRepository->findAllForTwig();
    }

}