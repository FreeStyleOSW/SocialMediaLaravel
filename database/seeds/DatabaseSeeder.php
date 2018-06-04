<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	$faker = Faker::create('pl_PL');
    	$password = 'pass';
        $number_of_users = 20;
        $max_posts_user = 20;
        $max_comments_per_post = 15;

        DB::table('roles')->insert([
                'id' => 1,
                'type' => 'admin',
                ]);

        DB::table('roles')->insert([
                'id' => 2,
                'type' => 'user',
                ]);

    	for ($user_id= 1; $user_id <= $number_of_users; $user_id++) { 

    		if ($user_id === 1) {
    			DB::table('users')->insert([
    			'name' => 'Marcin Krzemień',
    			'email' => 'poczta@marcinkrzemien.pl',
    			'sex' => 'm',
                'role_id' => 1,
    			'password' => bcrypt('kadimato')
	       		]);
    		}

    		$sex = $faker->randomElement(['m','f']);

    		switch ($sex) {
    			case 'm':
	        		$name = $faker->firstnameMale . ' ' . $faker->lastNameMale;
                    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
    			break;
    			
    			case 'f':
	        		$name = $faker->firstnameFemale . ' ' . $faker->lastNameFemale;
                    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
    			break;
    		}
    		DB::table('users')->insert([
    			'name' => $name,
    			'email' => str_replace('-','',str_slug($name)) . '@' . $faker->safeEmailDomain,
    			'sex' => $sex,
                'role_id' => 2,
                'avatar' => $avatar,
    			'password' => bcrypt($password),
	       	]);
        for ($i= 1; $i <= $faker->numberBetween($min = 0, $max = $number_of_users - 1); $i++) {

            $friend_id = $faker->numberBetween($min = 1 , $max = $number_of_users);

            $friend_query1 = Friend::where([
            'user_id' => $user_id,
            'friend_id' => $friend_id,
            ])->first();

            $friend_query2 = Friend::where([
            'user_id' => $friend_id,
            'friend_id' => $user_id,
            ])->first();

            if (is_null($friend_query1) && is_null($friend_query2)) {

             DB::table('friends')->insert([
                'user_id' => $user_id,
                'friend_id' => $friend_id,
                'accepted' => 1,
                'created_at' => $faker->dateTimeThisYear($max = 'now'),
            ]);
            }
        }
        $posts = 0;
        for ($post_id= 1; $post_id <= $faker->numberBetween($min = 0, $max = $max_posts_user); $post_id++) 
        {
            DB::table('posts')->insert([
                'user_id' => $user_id,
                'content' => $faker->paragraph($nbSenteces = 1,$variableNbSentences = true),
                'created_at' => $faker->dateTimeThisYear($max = 'now'),
            ]);
        }  // koniec pętli postów / posts loop
        } // koniec pętli użytkownika / users loop

        for ($post_id=1; $post_id <= 70 ; $post_id++) { 
        for ($comment_id= 1; $comment_id <= $faker->numberBetween($min = 3, $max = $max_comments_per_post); $comment_id++) 
            {
                DB::table('comments')->insert([
                    'post_id' => $post_id,
                    'user_id' => $faker->numberBetween($min = 1, $max = $number_of_users),
                    'content' => $faker->paragraph($nbSenteces = 1,$variableNbSentences = true),
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                ]);

        }
        }
    }
}
