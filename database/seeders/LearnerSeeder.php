<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use Faker\Factory as Faker;

class LearnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $learnerFaker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            $user = new UserModel();
            $profile = new UserProfileModel();
            $gender = $learnerFaker->randomElement(['Male', 'Female', 'Prefer to not say']);
            $time_commitment = $learnerFaker->randomElement(['hrs', 'wk']);
            $School_rank = $learnerFaker->randomElement(['High', 'Secondry', 'College']);
            $School_type = $learnerFaker->randomElement(['Public', 'Private']);
            $user->username = $learnerFaker->unique()->userName($gender);
            $user->email = preg_replace('/@example\..*/', '@domain.com', $learnerFaker->unique()->safeEmail);
            $user->password = md5($learnerFaker->password);
            $user->status = "Active";
            $user->save();
            if (!empty($user->id)) {
                $profile->user_id = $user->id;
                $profile->f_name = $learnerFaker->firstName;
                $profile->l_name = $learnerFaker->lastName;
                $profile->state = $learnerFaker->state;
                $profile->city = $learnerFaker->city;
                $profile->zip = $learnerFaker->postcode;
                $profile->current_year = '2022';
                $profile->expected_graduation_date = $learnerFaker->date;
                $profile->high_school_name = $learnerFaker->name . "," . $learnerFaker->address;
                $profile->school_type = $School_type;
                $profile->school_rank = $School_rank;
                $profile->gender = $gender;
                $profile->target_school = $learnerFaker->name . "," . $learnerFaker->address;
                $profile->time_commitment = $time_commitment;
                $profile->save();
            }
        }
    }
}
