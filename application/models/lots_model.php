<?php
/**
 * Created for No Ctrl's Project Birdseye
 * Author: Michael Holler
 * Date: 2/6/13
 * Time: 9:23 AM
 */
class Lots_Model extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function read_lots($all=false, $active=true, $limit=0, $offset=0) {
        $this->db->from('lots');

        if($all)
            $this->db->select();
        else
            $this->db->select('lot_id, name, spaces_available, total_spaces');

        if($active)
            $this->db->where('active', true);

        $this->db->limit($limit, $offset);
//        $this->db->where('active', true)->limit($limit, $offset);

        $query = $this->db->get();

        return $query->result();
    }

    public function read_lot($lot_id) {
        $this->db->from('lots')->select()->where('lot_id', $lot_id);

        return $this->db->get()->result();
    }

    public function update_active($lot_id, $active) {
        $this->db->where('lot_id', $lot_id)->set('active', $active)->update('lots');

        return $this->db->affected_rows() ? true : false;
    }

    public function is_lot_active($lot_id) {
        $this->db->from('lots')->select('lot_id')->where('lot_id', $lot_id);

        return $this->db->count_all_results() ? true : false;
    }

    public function inc_spaces_available($lot_id, $inc_by=1) {
        $this->db->where('id', $lot_id);
        $this->db->set('spaces_available', 'spaces_available+'.$inc_by, FALSE);
        $this->db->update('lots');

        return $this->db->affected_rows() ? true : false;
    }

    public function dec_spaces_available($lot_id, $dec_by=1) {
        $this->db->where('id', $lot_id);
        $this->db->set('spaces_available', 'spaces_available+'.$dec_by, FALSE);
        $this->db->update('lots');

        return $this->db->affected_rows() ? true : false;
    }

}
