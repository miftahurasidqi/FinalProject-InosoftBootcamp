<?php

namespace App\Repositories;

use App\Models\InvoiceTo;

class InvoiceToRepository
{
    public function create(array $data)
    {
        return InvoiceTo::create($data);
    }
}
