<?php

namespace Aaran\Common\Database\Factories;

use Aaran\Common\Models\Receipttype;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceipttypeFactory extends Factory
{

    protected $model = Receipttype::class;

    public function definition(): array
    {
        return [
            'vname' => $this->faker->name,
            'active_id' => 1
        ];
    }
}
