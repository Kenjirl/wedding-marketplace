<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_categories')->insert([
            [
                'admin_id'   => 1,
                'nama'       => 'Tradisional',
                'keterangan' => 'Pernikahan yang mengikuti adat dan tradisi budaya tertentu. Tertutupi dengan ritual, upacara, dan pakaian khas sesuai dengan warisan budaya pasangan.',
            ],
            [
                'admin_id'   => 1,
                'nama'       => 'Modern',
                'keterangan' => 'Pernikahan yang menekankan aspek kontemporer dan gaya hidup modern. Desain, tata letak, dan konsep acara cenderung lebih terkini dan sesuai dengan tren terkini.',
            ],
            [
                'admin_id'   => 1,
                'nama'       => 'Outdoor',
                'keterangan' => 'Acara pernikahan yang diselenggarakan di luar ruangan, seperti taman, pantai, atau taman belakang. Menawarkan suasana alam yang indah.',
            ],
            [
                'admin_id'   => 1,
                'nama'       => 'Intim',
                'keterangan' => 'Acara pernikahan yang diselenggarakan dengan jumlah tamu terbatas, fokus pada keintiman dan hubungan dekat antara keluarga dan teman-teman terdekat.',
            ],
            [
                'admin_id'   => 1,
                'nama'       => 'DIY',
                'keterangan' => 'Pernikahan yang banyak diorganisir dan dihias oleh pasangan sendiri atau dengan bantuan keluarga dan teman-teman. Memberikan sentuhan pribadi dan unik.',
            ],
            [
                'admin_id'   => 1,
                'nama'       => 'Budaya',
                'keterangan' => 'Pernikahan yang menyoroti kekayaan budaya pasangan atau menggabungkan elemen budaya dari dua keluarga yang berbeda.',
            ],
            [
                'admin_id'   => 1,
                'nama'       => 'Vintage',
                'keterangan' => 'Pernikahan yang mengadopsi gaya dan elemen dari masa lalu, seringkali menekankan dekorasi, pakaian, dan musik yang mencerminkan era tertentu, seperti tahun 1920-an, 1950-an, atau 1970-an.',
            ]
        ]);
    }
}
