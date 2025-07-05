<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->db->table('diskon')->truncate(); 

        $tanggalMulai = date('Y-m-d');
        $nominalList = [100000, 200000, 300000];
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $tanggal = date('Y-m-d', strtotime("+$i day", strtotime($tanggalMulai)));
            $data[] = [
                'tanggal'    => $tanggal,
                'nominal'    => $nominalList[$i % 3],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ];
        }

        $this->db->table('diskon')->insertBatch($data);
    }
}
