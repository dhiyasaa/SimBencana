<?php

class bencana_model extends CI_Model {

    public function getBencanaWithTotalKerugian()
{
    // Ambil harga terbaru
    $this->db->select('bencana.*, SUM( 
        (bangunan_rusak_bencana.seng * bangunan_rusak.seng) +
        (bangunan_rusak_bencana.kayu * bangunan_rusak.kayu) +
        (bangunan_rusak_bencana.dinding * bangunan_rusak.dinding)
    ) AS total_kerugian');
    
    // Join tabel-tabel yang diperlukan
    $this->db->from('bencana');
    $this->db->join('bangunan_rusak_bencana', 'bencana.id = bangunan_rusak_bencana.id_bencana', 'left');
    
    // Ambil harga terbaru
    $this->db->join('bangunan_rusak', '1=1', 'left');  // Assuming harga table has only one row with most recent prices

    // Grup berdasarkan id bencana untuk mendapatkan total kerugian
    $this->db->group_by('bencana.id');
    
    // Mengambil harga terbaru berdasarkan tanggal terbaru
    $this->db->order_by('bangunan_rusak.tanggal', 'desc'); // Mengambil harga terbaru

    // Eksekusi query dan kembalikan hasil
    return $this->db->get()->result();
}


}
