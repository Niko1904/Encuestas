<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('master_aplications')->insert([
            'start_date' => Carbon::createFromFormat('d/m/Y', '17/11/2017')->toDateTimeString(),
            'user_id' =>  1,
            'poll_id' =>  1,
            'status' =>  0,
        ]);

        DB::table('admins')->insert([
            'name' => 'Admin',            
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),            
            'level' => 1,            
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);

        DB::table('admins')->insert([
            'name' => 'Rodolfo',            
            'email' => 'halconrod@gmail.com',
            'password' => bcrypt('12345678'),            
            'level' => 1,            
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);
        
        DB::table('admins')->insert([
            'name' => 'Moises',            
            'email' => 'moycs777@gmail.com',
            'password' => bcrypt('12345678'),            
            'level' => 1,            
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);

        DB::table('users')->insert([
            'name' => 'Rodolfo',            
            'email' => 'halconrod@gmail.com',
            'password' => bcrypt('12345678'),               
            'verificado' => true,               
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);
        
        DB::table('users')->insert([
            'name' => 'Moises',            
            'email' => 'moycs777@gmail.com',
            'password' => bcrypt('12345678'),               
            'verificado' => true,               
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);
        
        DB::table('categories')->insert([
            'name' => 'Con tiempo general',            
            'timer_type' => 3,
            'hour' => 0,            
            'minutes' => 1,            
            'seconds' => 0,            
            'pausable' => 0,            
            'status' => 0,            
            'answer_required' => 1,
            'show_all_questions' => 1,
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);
        
        DB::table('categories')->insert([
            'name' => 'Con tiempo por pregunta',            
            'timer_type' => 2,
            'hour' => 0,            
            'minutes' => 0,            
            'seconds' => 30,            
            'pausable' => 0,            
            'status' => 0,            
            'answer_required' => 1,
            'show_all_questions' => 1,
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);
        
        DB::table('polls')->insert([
            'name' => 'preparando ajedres, con tiempo general',            
            'status' => 1,
            'show_all_questions' => 1,
            'category_id' => 2,
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);
       
        DB::table('polls')->insert([
            'name' => 'preparando personalida, con tiempo por pregunta',            
            'status' => 1,
            'show_all_questions' => 0,
            'category_id' => 1,
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),        
        ]);
        
        DB::table('general_definitions')->insert([
            'name' => 'mucha suerte al responder',            
            'description' => "esperamos tenags suerte en esta encuesta",
        ]);
        
    }
}
