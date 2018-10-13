<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Entity\Project::class,12)->create()->each(function ($project) {


            /** @var \App\Entity\Project $project */
            $max=random_int(3,15);
            for ($i=0; $i <= $max; $i++ )
                $project->tasks()->save(factory(\App\Entity\Task::class)->make());
        });
    }
}



