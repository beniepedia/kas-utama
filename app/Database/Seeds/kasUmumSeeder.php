<?php

namespace App\Database\Seeds;


class kasUmumSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {

        $faker = \Faker\Factory::create('id_ID');


        for ($i = 0; $i < 100; $i++) {

            $kas = $faker->randomElement($array = array('M', 'K'));


            $kategori = [1, 2, 3];

            shuffle($kategori);

            foreach ($kategori as $v => $k) {

                $id_kategori = $k;
            }


            if ($kas === "M") {
                $masuk =  $faker->numberBetween($min = 20000, $max = 100000);
                $keluar = 0;
            } else {
                $masuk = 0;
                $keluar =  $faker->numberBetween($min = 20000, $max = 100000);
            }

            $data = [
                'kode_kas_umum' => 'KU-' . $faker->date($format = '20' . 'mdis', $max = 'now'),
                'tanggal' => $faker->date($format = '2020' . '-m-d', $max = 'now'),
                'id_kategori' => $id_kategori,
                'jenis_kas' => $kas,
                'masuk' => $masuk,
                'keluar' => $keluar,
                'keterangan' => $faker->sentence(6, true),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('kas_umum')->insert($data);
        }




        // // Kode Kas
        // echo 'KU-' . $faker->date($format = '20' . 'mdis', $max = 'now');
        // echo "<br>";
        // // tanggal
        // echo $faker->date($format = '2020' . '-m-d', $max = 'now');
        // echo "<br>";
        // // id kategori
        // echo $data;
        // echo "<br>";
        // // jenis kas
        // $kas = $faker->randomElement($array = array('M', 'K'));
        // echo $kas;
        // echo "<br>";
        // if ($kas == 'M') {
        //     echo $faker->numberBetween($min = 20000, $max = 100000);
        // } else {
        //     echo $faker->numberBetween($min = 20000, $max = 100000);
        // }

        // die;
    }
}
