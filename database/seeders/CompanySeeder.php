<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::updateOrCreate(
            [
                'id' => 1,
            ],
            [
                'company_name' => 'Laravel POS',
                'company_address' => '123 Main Street, Suite 3306',
                'company_phone' => '+880 1580398086',
                'company_email' => 'utsabdey83@gmail.com',
            ]
        );
    }
}
