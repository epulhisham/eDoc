<?php

namespace Database\Seeders;

use App\Models\Classification;
use App\Models\Location;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Location::create([

            'location_name' => ' '
        ]);

        Location::create([

            'location_name' => 'B MDI'
        ]);

        Location::create([

            'location_name' => 'B OP'
        ]);

        Location::create([

            'location_name' => 'DMS'
        ]);

        Location::create([

            'location_name' => 'Portal RTM'
        ]);

        Location::create([

            'location_name' => 'DMS & Portal RTM'
        ]);

        Classification::create([

            'classification_name' => ''
        ]);

        Classification::create([

            'classification_name' => 'TERBUKA'
        ]);

        Classification::create([

            'classification_name' => 'TERHAD'
        ]);

        Classification::create([

            'classification_name' => 'SULIT'
        ]);

        // File::create([

        //     'document_name' => 'test saje',
        //     'reference_no' => 'test 123',
        //     'version' => 1,
        //     'release_date'=> '22/2/2022',
        //     'location_id' => 2,
        //     'classification_id'=> 2,
        //     'folder_id' => 1
        // ]);

        // File::create([

        //     'document_name' => 'file ',
        //     'reference_no' => 'file 123',
        //     'version' => 1,
        //     'release_date'=> '22/2/2015',
        //     'location_id' => 2,
        //     'classification_id'=> 3,
        //     'folder_id' => 2
        // ]);

        // Folder::create([

        //     'name' => 'test saje',
        //     'slug' => 'test-saje'
        // ]);

        // Folder::create([

        //     'name' => 'test tiga',
        //     'slug' => 'test-tiga'
        // ]);
    }
}
