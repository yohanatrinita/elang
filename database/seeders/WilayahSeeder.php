<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Desa;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Cibinong' => ['Ciriung', 'Pabuaran', 'Nanggewer', 'Karadenan', 'Cirimekar', 'Cibinong', 'Pakansari'],
            'Dramaga' => ['Dramaga', 'Babakan', 'Neglasari', 'Petir', 'Pamulang', 'Purwasari'],
            'Cileungsi' => ['Cileungsi', 'Mekarsari', 'Dayeuh', 'Cipeucang', 'Pasirangin'],
            'Gunung Putri' => ['Gunung Putri', 'Ciangsana', 'Nagrak', 'Bojongkulur', 'Tlajung Udik'],
            'Bojonggede' => ['Bojonggede', 'Susukan', 'Rawa Panjang', 'Waringin Jaya'],
            'Citeureup' => ['Citeureup', 'Tajur', 'Puspanegara', 'Leuwinutug', 'Saninten'],
            'Jonggol' => ['Jonggol', 'Sukaresmi', 'Bantar Karet', 'Cibodas', 'Sukagalih'],
            'Parung' => ['Parung', 'Warujaya', 'Bojong Indah', 'Warung Jambu'],
            'Parung Panjang' => ['Parung Panjang', 'Cibunar', 'Jagabaya', 'Kabasiran'],
            'Rumpin' => ['Rumpin', 'Sukamulya', 'Gobang', 'Cibodas'],
            'Leuwiliang' => ['Leuwiliang', 'Leuwimekar', 'Purasari', 'Karyasari'],
            'Cibungbulang' => ['Cibungbulang', 'Girimulya', 'Pabangbon', 'Gunung Picung'],
            // Tambahkan kecamatan dan desa lain sesuai kebutuhan
        ];

        foreach ($data as $kecamatan => $desas) {
            $kecamatanRecord = Kecamatan::create(['nama' => $kecamatan]);

            foreach ($desas as $desa) {
                Desa::create([
                    'nama' => $desa,
                    'kecamatan_id' => $kecamatanRecord->id
                ]);
            }
        }
    }
}

