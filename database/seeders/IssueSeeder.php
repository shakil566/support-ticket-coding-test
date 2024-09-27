<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('issues')->delete();

        $users = [
            ['id' => 1, 'user_id' => 2, 'ticket_number' => 'ST-00001', 'address' => 'Dhaka', 'details' => 'I have problem in road', 'remarks' => NULL, 'status' => 'Open', 'created_by' => 2, 'updated_by' => NULL],
            ['id' => 2, 'user_id' => 2, 'ticket_number' => 'ST-00002', 'address' => 'Dhaka2', 'details' => 'I have problem in road2', 'remarks' => NULL, 'status' => 'Open', 'created_by' => 2, 'updated_by' => NULL],
            ['id' => 3, 'user_id' => 2, 'ticket_number' => 'ST-00003', 'address' => 'Dhaka3', 'details' => 'I have problem in road3', 'remarks' => NULL, 'status' => 'Open', 'created_by' => 2, 'updated_by' => NULL],
            ['id' => 4, 'user_id' => 2, 'ticket_number' => 'ST-00004', 'address' => NULL, 'details' => 'I have problem in road 4', 'remarks' => 'Solved', 'status' => 'Closed', 'created_by' => 2, 'updated_by' => 1],
        ];

        Issue::insert($users);
    }
}