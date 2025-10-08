<?php

namespace Database\Factories;

use App\Enum\PersonnelGender;
use App\Enum\PersonnelType;
use App\Models\Rank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rankId = fake()->randomElement(Rank::all()->pluck('id')->toArray());
        $personnelType = "";
        $serviceNumber = "";
        $personnelRank = Rank::find($rankId);

        switch ($personnelRank->type) {
            case PersonnelType::OFFICER:
                $personnelType = PersonnelType::OFFICER;
                $serviceNumber = "GH/" . fake()->unique()->numberBetween(8000, 9000);
                break;

            case PersonnelType::OTHER_RANK:
                $personnelType = PersonnelType::OTHER_RANK;
                $serviceNumber = fake()->unique()->numberBetween(210000, 310000);
                break;

            case PersonnelType::CIVILIAN_EMPLOYEE:
                $personnelType = PersonnelType::CIVILIAN_EMPLOYEE;
                $serviceNumber = fake()->unique()->numberBetween(510000, 610000);
                break;

            default:
                break;
        }

        return [
            "service_number" => $serviceNumber,
            "rank_id" => $rankId,
            "last_name" => fake()->lastName(),
            "other_names" => fake()->name(),
            "gender" => fake()->randomElement(PersonnelGender::cases()),
            "phone" => fake()->phoneNumber(),
            "email" => fake()->email(),
            "type" => $personnelType,
        ];
    }
}
