<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('app/seeder/sd');

        if (!file_exists($path)) {
            School::create([
                'name' => 'Example High School',
                'logo_path' => 'logos/example-logo.png',
                'address' => '123 Main St, City',
            ]);

            return;
        }

        $lines = array_filter(array_map('trim', file($path)));
        $header = array_shift($lines);

        foreach ($lines as $line) {
            $columns = explode("\t", $line);

            if (count($columns) < 2) {
                continue;
            }

            [$name, $region, $district, $schoolType, $gender, $ownership, $source] = array_pad($columns, 7, null);

            School::updateOrCreate(
                ['name' => $name],
                [
                    'region' => $region,
                    'district' => $district,
                    'school_type' => $schoolType,
                    'gender' => $gender,
                    'ownership' => $ownership,
                    'source' => $source,
                    'address' => trim((string) ($region && $district ? "$region, $district" : $district ?? $region)),
                ]
            );
        }
    }
}
