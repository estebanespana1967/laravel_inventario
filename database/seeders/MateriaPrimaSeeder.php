<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materia_prima;

class MateriaPrimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materia_prima::create(
            [
               
                'nombre_mp'=>'BUPROPION',
                'fecha_venci'=>'2022-07-20',
                'lote'=>'5657484',
                'serie'=>'S3456',
                'proveedor'=>'REUTTER',
                'costo'=>'20',
                'venta'=>'30',
                'stock'=>'200'

            ]
        );

    }
}
