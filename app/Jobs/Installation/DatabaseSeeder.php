<?php

namespace App\Jobs\Installation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;

# Models
use App\Models\Area\Province;
use App\Models\Area\District;
use App\Models\Area\Subdistrict;
use App\Models\Area\Village;

use App\User;
use App\Role;

class DatabaseSeeder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '-1'); ini_set('max_execution_time', 0); set_time_limit(0);
        
        $this->roles();
        $this->users();

        $this->provinces();
        $this->districts();
        $this->subdistricts();
        $this->villages();
    }

    private function roles()
    {
        Role::create([
            "name" => 'admin',
            "display_name" => 'Administrator',
            "description" => 'Admin Sistem',
        ]);

        Role::create([
            "name" => 'lecturer',
            "display_name" => 'Dosen',
            "description" => null
        ]);

        Role::create([
            "name" => 'student',
            "description" => null
        ]);
    }

    private function users()
    {
        $admin = User::create([
            'name' => 'Administrator', 
            'email' => 'admin@app.com', 
            'password' => Hash::make('default'),
        ]);
        $admin->attachRole('admin');

        $lecturer = User::create([
            'name' => 'Contoh Akun Dosen', 
            'email' => 'dosen@app.com', 
            'password' => Hash::make('default'),
        ]);
        $lecturer->attachRole('lecturer');

        $student = User::create([
            'name' => 'Contoh Akun Mahasiswa', 
            'email' => 'mahasiswa@app.com', 
            'password' => Hash::make('default'),
        ]);
        $student->attachRole('student');
    }

    private function provinces()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/provinces.csv'), 'r');
        foreach ($csv as $row) {
            Province::create([
                'code' => $row[1],
                'name' => $row[2]
            ]);
        }
    }

    private function districts()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/districts.csv'), 'r');
        $provinces = Province::all();

        foreach ($csv as $row) {
            try {
                $province = $provinces->where('code', $row[1])->first();
                
                District::create([
                    'province_id' => empty($province) ? null : $province->id,
                    'code' => "$row[2]",
                    'name' => $row[3]
                ]);
            } catch (\Exception $e) {
                Log::warning('Seeder district - '.$e->getMessage());
            }
        }
    }

    private function subdistricts()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/subdistricts.csv'), 'r');
        $districts = District::all();

        foreach ($csv as $row) {
            try {
                $district = $districts->where('code', $row[1])->first();
                
                Subdistrict::create([
                    'district_id' => empty($district) ? null : $district->id,
                    'code' => $row[2],
                    'name' => $row[3]
                ]);
            } catch (\Exception $e) {
                Log::warning('Seeder subdistrict - '.$e->getMessage());
            }
        }
    }

    private function villages()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/villages.csv'), 'r');
        $subdistricts = Subdistrict::all();

        foreach ($csv as $row) {
            try {
                $subdistrict = $subdistricts->where('code', $row[1])->first();

                Village::create([
                    'subdistrict_id' => empty($subdistrict) ? null : $subdistrict->id,
                    'code' => "$row[2]",
                    'name' => $row[3]
                ]);
            } catch (\Exception $e) {
                Log::warning('Seeder village - '.$e->getMessage());
            }
        }
    }
}
