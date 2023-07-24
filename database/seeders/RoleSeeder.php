<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

           $data=[ 
        ['name'=>'Admin'],
        ['name'=>'Editor'],
        ['name'=>'Creator'],
    ];
    
    Role::insert($data);
    $loop=0;
        foreach ($data as $key ) {
            User::create([
                    'name'=>$key['name'],
                    'email'=>$key['name'].'@gmail.com',
                    'password'=>password_hash('123',1),
                    'role_id'=>$loop+1,
            
            ]);
            $loop++;
        }
    }

    }
