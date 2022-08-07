<?php

namespace Database\Seeders;

use App\Models\Cadastre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CadastreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = resource_path('csv/sig_cdmx_ALVARO OBREGON_08-2020.csv');
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];
        $line = 0;
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000)) !== false) {
                $line++;
                if (!$header) {
                    $header = $row;
                    continue;
                }
                if (count($header) !== count($row)) {
                    continue;
                }
                Cadastre::create([
                    'fid' => is_numeric($row[0]) ? $row[0] : null,
                    'geo_shape' => $row[1] ?? null,
                    'call_numero' => $row[2] ?? null,
                    'codigo_postal' => $row[3] ?? null,
                    'colonia_predio' => $row[4] ?? null,
                    'superficie_terreno' => $row[5] ?? null,
                    'superficie_construccion' => $row[6] ?? null,
                    'uso_construccion' => $row[7] ?? null,
                    'clave_rango_nivel' => is_numeric($row[8]) ? $row[8] : null,
                    'anio_construccion' => is_numeric($row[9]) ? $row[9] : null,
                    'instalaciones_especiales' => $row[10] ?? null,
                    'valor_unitario_suelo' => is_numeric($row[11]) ? $row[11] : null,
                    'valor_suelo' => is_numeric($row[12]) ? $row[12] : null,
                    'clave_valor_unitario_suelo' => $row[13] ?? null,
                    'colonia_cumpliemiento' => $row[14] ?? null,
                    'alcaldia_cumplimiento' => $row[15] ?? null,
                    'subsidio' => is_numeric($row[16]) ? $row[16] : null,
                ]);
            }
            fclose($handle);
        }
    }
}
