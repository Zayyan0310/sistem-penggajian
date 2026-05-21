
<?php
Class PajakModel extends CI_Model
{
  public function getById($id)
    {
    return $this->db->get_where('data_pajak', ['id_pajak' => $id])->row();
    }

    public function update($id, $data)
    {
    return $this->db->update('data_pajak', $data, ['id_pajak' => $id]);
    }

    public function delete($id)
    {
    return $this->db->delete('data_pajak', ['id_pajak' => $id]);
    }

    public function getDeskripsiByJenisTER()
  {
      $jenis_TER = $this->input->post('jenis_TER');
      $data = $this->db->get_where('data_pajak', ['jenis_TER' => $jenis_TER])->result();

      echo json_encode($data);
  }


}