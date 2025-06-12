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
            'Kecamatan Babakan Madang' => [' Desa Babakan Madang', 'Desa Bojong Koneng', 'Desa Cijayanti', 'Desa Cipambuan', 'Desa Citaringgul', 'Desa Kadumangu', 'Desa Karang Tengah', 'Desa Sentul', 'Desa Sumur Batu'],
            'Kecamatan Bojonggede' => ['Desa Bojong Baru', 'Desa Bojonggede', 'Desa Cimanggis', 'Desa Kedung Waringin', 'Desa Ragajaya', 'Desa Rawa Panjang', 'Susukan', 'Waringin Jaya', 'Kelurahan Pabuaran'],
            'Kecamatan Caringin' => ['Desa Pasir Buncir', 'Desa Caringin', 'Desa Ciderum', 'Desa Ciherang Pondok', 'Desa Cimande', 'Desa Cimande Hilir', 'Desa Cinagara', 'Desa Lemah Duhur', 'Desa Muara Jaya', 'Desa Pancawati', 'Desa Pasir Muncang', 'Desa Tangkil'],
            'Kecamatan Cariu' => ['Desa Babakan Raden', 'Desa Bantar Kuning', 'Desa Cariu', 'Desa Cibatu Tiga', 'Desa Cikutamahi', 'Desa Karya Mekar', 'Desa Kuta Mekar', 'Desa Mekarwangi', 'Desa Sukajadi', 'Desa Tegal Panjang'],
            'Kecamatan Ciampea' => ['Desa Bojong Jengkol', 'Desa Bojong Rangkas', 'Desa Benteng', 'Desa Ciampea', 'Desa Ciampea Udik', 'Desa Cibadak', 'Desa Cibanteng', 'Desa Cibuntu', 'Desa Cicadas', 'Desa Cihideung Ilir', 'Desa Cihideung Udik', 'Desa Cinangka', 'Desa Tegal Waru'],
            'Kecamatan Cibinong' => ['Kelurahan Cibinong', 'Kelurahan Cirimekar', 'Kelurahan Ciriung', 'Kelurahan Harapan Jaya', 'Kelurahan Karadenan', 'Kelurahan Nanggewer', 'Kelurahan Nanggewer Mekar', 'Kelurahan Pabuaran', 'Kelurahan Pabuaran Mekar', 'Kelurahan Pakansari', 'Kelurahan Pondok Rajeg', 'Kelurahan Sukahati', 'Kelurahan Tengah'],
            'Kecamatan Cibungbulang' => ['Desa Cemplang', 'Desa Ciaruteun Ilir', 'Desa Ciaruteun Udik', 'Desa Cibatok 1', 'Desa Cibatok 2', 'Desa Cijujung', 'Desa Cimanggu 1', 'Desa Cimanggu 2', 'Desa Dukuh', 'Desa Galuga', 'Desa Girimulya', 'Desa Leuweung Kolot', 'Desa Situ Ilir', 'Desa Situ Udik', 'Desa Sukamaju'],
            'Kecamatan Cigombong' => ['Desa Ciadeg', 'Desa Ciburayut', 'Desa Ciburuy', 'Desa Cigombong', 'Desa Cisalada', 'Desa Pasirjaya', 'Desa Srogol', 'Desa Tugujaya', 'Desa Watesjaya'],
            'Kecamatan Cigudeg' => ['Desa Argapura', 'Desa Bangunjaya', 'Desa Banyu Asih', 'Desa Banyu Resmi', 'Desa Banyu Wangi', 'Desa Batu Jajar', 'Desa Bunar', 'Desa Cigudeg', 'Desa Cintamanik', 'Desa Mekarjaya', 'Desa Rengasjajar', 'Desa Sukamaju', 'Desa Sukaraksa', 'Desa Tegalega', 'Desa Wargajaya'],
            'Kecamatan Cijeruk' => ['Desa Cibalung', 'Desa Cijeruk', 'Desa Cipelang', 'Desa Cipicung', 'Desa Palasari', 'Desa Sukaharja', 'Desa Tajur Halang', 'Desa Tanjung Sari', 'Desa Warung Menteng'],
            'Kecamatan Cileungsi' => ['Desa Cileungsi', 'Desa Cileungsi Kidul', 'Desa Cipenjo', 'Desa Cipeucang', 'Desa Dayeuh', 'Desa Gandoang', 'Desa Jatisari', 'Desa Limus Nunggal', 'Desa Mampir', 'Desa Mekarsari', 'Desa Pasir Angin', 'Desa Setu Sari'],
            'Kecamatan Ciomas' => ['Desa Ciapus', 'Desa Ciomas', 'Desa Ciomas Rahayu', 'Desa Kota Batu', 'Desa Laladon', 'Desa Mekarjaya', 'Desa Pagelaran', 'Desa Parakan', 'Desa Sukaharja', 'Desa Sukamakmur', 'Kelurahan Padasuka'],
            'Kecamatan Citeureup' => ['Desa Citeureup', 'Desa Gunung Sari', 'Desa Hambalang', 'Desa Karang Asem Timur', 'Desa Leuwinutug', 'Desa Pasir Mukti', 'Desa Puspasari', 'Desa Sanja', 'Desa Sukahati', 'Desa Tajur', 'Desa Tangkil', 'Desa Tarikolot', 'Kelurahan Karang Asem Barat', 'Kelurahan Puspanegara'],
            'Kecamatan Cisarua' => ['Desa Batu Layang', 'Desa Cibeureum', 'Desa Cilember', 'Desa Citeko', 'Desa Jogjogan', 'Desa Kopo', 'Desa Leuwimalang', 'Desa Tugu Selatan', 'Desa Tugu Utara', 'Kelurahan Cisarua'],
            'Kecamatan Ciseeng' => ['Desa Babakan', 'Desa Cibeuteung Muara', 'Desa Cibeuteung Udik', 'Desa Cibentang', 'Desa Cihoe', 'Desa Ciseeng', 'Desa Karihkil', 'Desa Kuripan', 'Desa Parigi Mekar', 'Desa Putat Nutug'],
            'Kecamatan Ciawi' => ['Desa Banjar Sari', 'Desa Banjar Wangi', 'Desa Banjar Waru', 'Desa Bendungan', 'Desa Bitung Sari', 'Desa Bojong Murni', 'Desa Ciawi', 'Desa Cibedug', 'Desa Cileungsi', 'Desa Citapen', 'Desa Jambu Luwuk', 'Desa Pandansari', 'Desa Teluk Pinang'],
            'Kecamatan Dramaga' => ['Desa Babakan', 'Desa Ciherang', 'Desa Cikarawang', 'Desa Dramaga', 'Desa Neglasari', 'Desa Petir', 'Desa Purwasari', 'Desa Sinar Sari', 'Desa Sukadamai', 'Desa Sukawening'],
            'Kecamatan Gunung Putri' => ['Desa Bojong Kulur', 'Desa Bojong Nangka', 'Desa Ciangsana', 'Desa Cicadas', 'Desa Cikeas Udik', 'Desa Gunung Putri', 'Desa Karanggan', 'Desa Nagrak', 'Desa Tlajung Udik', 'Desa Wanaherang'],
            'Kecamatan Gunungsindur' => ['Desa Cibadung', 'Desa Cibinong', 'Desa Cidokom', 'Desa Curug', 'Desa Gunungsindur', 'Desa Jampang', 'Desa Pabuaran', 'Desa Padurenan', 'Desa Pengasinan', 'Desa Rawakalong'],
            'Kecamatan Jasinga' => ['Desa Bagoang', 'Desa Barengkok', 'Desa Cikopomayak', 'Desa Curug', 'Desa Jasinga', 'Desa Jugala Jaya', 'Desa Kalongsawah', 'Desa Koleang', 'Desa Neglasari', 'Desa Pamagersari', 'Desa Pangaur', 'Desa Pangradin', 'Desa Sipak', 'Desa Setu', 'Desa Tegal Wangi', 'Desa Wirajaya'],
            'Kecamatan Jonggol' => ['Desa Balekambang', 'Desa Bendungan', 'Desa Cibodas', 'Desa Jonggol', 'Desa Singajaya', 'Desa Singasari', 'Desa Sirnagalih', 'Desa Sukagalih', 'Desa Sukajaya', 'Desa Sukamaju', 'Desa Sukamanah', 'Desa Sukanegara', 'Desa Sukasirna', 'Desa Weninggalih'],
            'Kecamatan Kemang' => ['Desa Bojong', 'Desa Jampang', 'Desa Kemang', 'Desa Pabuaran', 'Desa Parakan Jaya', 'Desa Pondok Udik', 'Desa Semplak Barat', 'Desa Tegal','Kelurahan Atang Senjaya'],
            'Kecamatan Klapanunggal' => ['Desa Bantar Jati', 'Desa Bojong', 'Desa Cikahuripan', 'Desa Kembang Kuning', 'Desa Klapanunggal', 'Desa Leuwikaret', 'Desa Ligarmukti', 'Desa Lulut', 'Desa Nambo'],
            'Kecamatan Leuwiliang' => ['Desa Barengkok', 'Desa Cibeber I', 'Desa Cibeber II', 'Desa Karacak', 'Desa Karyasari', 'Desa Karehkel', 'Desa Leuwiliang', 'Desa Leuwimekar', 'Desa Pabangbon', 'Desa Purasari', 'Desa Puraseda'],
            'Kecamatan Leuwisadeng' => ['Desa Babakan Sadeng', 'Desa Kalong I', 'Desa Kalong II', 'Desa Leuwisadeng', 'Desa Sadeng', 'Desa Sadengkolot', 'Desa Sibanteng', 'Desa Wangun Jaya'],
            'Kecamatan Megamendung' => ['Desa Cipayung Datar', 'Desa Cipayung Girang', 'Desa Gadog', 'Desa Kuta', 'Desa Megamendung', 'Desa Pasir Angin', 'Desa Sukagalih', 'Desa Sukakarya', 'Desa Sukamahi', 'Desa Sukamaju', 'Desa Sukamanah', 'Desa Sukaresmi'],
            'Kecamatan Nanggung' => ['Desa Bantar Karet', 'Desa Batu Tulis', 'Desa Cisarua', 'Desa Curug Bitung', 'Desa Hambaro', 'Desa Kalong Liud', 'Desa Malasari', 'Desa Nanggung', 'Desa Pangkal Jaya', 'Desa Parakan Muncang', 'Desa Sukaluyu'],
            'Kecamatan Pamijahan' => ['Desa Ciasihan', 'Desa Ciasmara', 'Desa Cibening', 'Desa Cibitung Kulon', 'Desa Cibitung Wetan', 'Desa Cibunian', 'Desa Cimayang', 'Desa Gunung Bunder', 'Desa Gunung Bunder II', 'Desa Gunung Menyan', 'Desa Gunung Picung', 'Desa Gunung Sari', 'Desa Pamijahan', 'Desa Pasarean', 'Desa Purwabakti'],
            'Kecamatan Parung' => ['Desa Bojong Indah', 'Desa Bojong Sempu', 'Desa Cogreg', 'Desa Iwul', 'Desa Jabon Mekar', 'Desa Pamegarsari', 'Desa Parung', 'Desa Waru', 'Desa Warujaya'],
            'Kecamatan Parung Panjang' => ['Desa Cibunar', 'Desa Cikuda', 'Desa Dago', 'Desa Gintung Cilejet', 'Desa Gorowong', 'Desa Jagabaya', 'Desa Jagabita', 'Desa Kabasiran', 'Desa Lumpang', 'Desa Parung Panjang', 'Desa Pingku'],
            'Kecamatan Ranca Bungur' => ['Desa Bantarjaya', 'Desa Bantarsari', 'Desa Candali', 'Desa Cimulang', 'Desa Mekarsari', 'Desa Pasirgaok', 'Desa Rancabungur'],
            'Kecamatan Rumpin' => ['Desa Cibodas', 'Desa Cidokom', 'Desa Cipinang', 'Desa Gobang', 'Desa Kampung Sawah', 'Desa Kertajaya', 'Desa Leuwibatu', 'Desa Mekar Jaya', 'Desa Mekar Sari', 'Desa Rabak', 'Desa Rumpin', 'Desa Sukamulya', 'Desa Sukasari', 'Desa Taman Sari'],
            'Kecamatan Sukajaya' => ['Desa Cileuksa', 'Desa Cisarua', 'Desa Harkatjaya', 'Desa Kiarapandak', 'Desa Kiarasari', 'Desa Pasir Madang', 'Desa Sipayung', 'Desa Sukaraja', 'Desa Sukamulih', 'Desa Jaya Raharja', 'Desa Urug'],
            'Kecamatan Sukamakmur' => ['Desa Cibadak', 'Desa Pabuaran', 'Desa Sirnajaya', 'Desa Sukadamai', 'Desa Sukaharja', 'Desa Sukamakmur', 'Desa Sukamulya', 'Desa Sukaresmi', 'Desa Sukawangi', 'Desa Wargajaya'],
            'Kecamatan Sukaraja' => ['Desa Cadas Ngampar', 'Desa Cibanon', 'Desa Cijujung', 'Desa Cikeas', 'Desa Cilebut Barat', 'Desa Cilebut Timur', 'Desa Cimandala', 'Desa Gunung Geulis', 'Desa Nagrak', 'Desa Pasir Jambu', 'Desa Pasirlaja', 'Desa Sukaraja', 'Desa Sukatani'],
            'Kecamatan Tajurhalang' => ['Desa Citayam', 'Desa Kalisuren', 'Desa Nanggerang', 'Desa Sasak Panjang', 'Desa Sukmajaya', 'Desa Tajurhalang', 'Desa Tonjong'],
            'Kecamatan Tamansari' => ['Desa Pasireurih', 'Desa Sirnagalih', 'Desa Sukajadi', 'Desa Sukajaya', 'Desa Sukaluyu', 'Desa Sukamantri', 'Desa Sukaresmi', 'Desa Tamansari'],
            'Kecamatan Tanjungsari' => ['Desa Antajaya', 'Desa Buanajaya', 'Desa Cibadak', 'Desa Pasir Tanjung', 'Desa Selawangi', 'Desa Sirnarasa', 'Desa Sirnasari', 'Desa Sukarasa', 'Desa Tanjungrasa', 'Desa Tanjungsari'],
            'Kecamatan Tenjo' => ['Desa Babakan', 'Desa Batok', 'Desa Bojong', 'Desa Cilaku', 'Desa Ciomas', 'Desa Singabangsa', 'Desa Singabraja', 'Desa Tapos', 'Desa Tenjo'],
            'Kecamatan Tenjolaya' => ['Desa Cibitung Tengah', 'Desa Cinangneng', 'Desa Gunung Malang', 'Desa Gunung Mulya', 'Desa Situ Daun', 'Desa Tapos 1', 'Desa Tapos 2'],
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

