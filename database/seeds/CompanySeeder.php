<?php

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Storage::exists("public/company/logo")){
            Storage::makeDirectory("public/company/logo");
        }

        factory(Company::class, 20)->create();

        factory(Employee::class, 25)->create();
    }
}
