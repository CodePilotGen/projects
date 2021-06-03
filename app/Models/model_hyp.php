<?php

/**
 * --------------------------------------------------------------------
 * 
 * --------------------------------------------------------------------
 *
 */

namespace App\Models;

use CodeIgniter\Model;

class Model_hyp extends Model{
    function getTotalHyps()
    {
        return $this->db->count_all_results('hyps');
    }
    
    function getHyp($hyp_id)
    {
        $this->db->WHERE('hyp_id', $hyp_id);
        $query  = $this->db->get('hyps');
        return $query->row();
    }

    public function addHyp($hyp_data)
    {
        $data   = array(
            'hyp_id'         => $hyp_data['hyp_id'],
            'hyp_content' => $hyp_data['hyp_content'],
        );
        $this->db->insert('hyps', $data);
        return $this->db->insert_id();
    }

    public function updateHyp($hyp_id, $hyp_data){
        $data   = array(
            'hyp_content'         => $hyp_data['hyp_content'],
        );
        $this->db->where('hyps.hyp_id', $hyp_id);
        return $this->db->update('hyps', $data);
    }

    public function deleteHyp($hyp_id)
    {
        $this->db->where('hyps.hyp_id', $hyp_id);
        return $this->db->delete('hyps');
    }
}

?>