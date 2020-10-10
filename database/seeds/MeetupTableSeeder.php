<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meetups')->delete();

        $lieux = ["Ratoma", 'Dixinn', "Matam", "Matoto", "Kaloum"];

        for($i = 1; $i <= 10; $i++)
        {
            $meetup = new \App\Meetup();
            $meetup->theme = ' Theme ' .$i;
            $meetup->description = 'Description';
            $meetup->lieu = $lieux[rand(0, 4)];
            $meetup->save();
        }
    }
}
