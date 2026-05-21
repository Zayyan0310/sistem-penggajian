<?php
Class ModelPotongan_Gaji extends CI_Model
{
  function TampilPotongan() 
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->from('potongan_gaji')
          ->get()
          ->result();
    }

}