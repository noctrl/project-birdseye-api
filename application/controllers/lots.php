<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'libraries/REST_Controller.php';

class Lots extends REST_Controller {

    /**
     * Return list of all lots with lot id, lot name, spaces available, and spaces_total
     *
     * WORKS!
     */
    public function index_get() {
        $this->load->model('lots_model');

        $all = $this->get('all') == 'true' ? true : false;
        $active = $this->get('onlyActive') == 'false' ? false : true;
        $limit = is_numeric($this->get('limit')) ? intval($this->get('limit')) : 1000;
        $offset = is_numeric($this->get('offset')) ? intval($this->get('offset')) : 0;

        $result = $this->lots_model->read_lots($all, $active, $limit, $offset);

        $http_code = $result ? 200 : 204;

        $this->response($result, $http_code);
    }

    /**
     * @param $lot_id
     *
     * WORKS!
     */
    public function lot_get($lot_id) {
        $this->load->model('lots_model');

        $result = $this->lots_model->read_lot($lot_id);

        $http_code = $result ? 200 : 404;

        $this->response($result, $http_code);
    }

    /**
     * Update an existing lot.
     *
     * WORKS!
     *
     * @param $lot_id
     */
    public function active_get($lot_id) {
        $this->load->model('lots_model');
        $result = $this->lots_model->is_lot_active($lot_id);

        $http_code = $result ? 200 : 404;

        $this->response(array('active' => $result), $http_code);
    }

    /**
     * Change lot activity state.
     *
     * WORKS!
     *
     * @param $lot_id
     */
    public function active_post($lot_id) {
        $this->load->model('lots_model');
        $new_active = $this->post('active');
        $successful = $this->lots_model->update_active($lot_id, $new_active);

        $http_code = $successful ? 200 : 400;
        $this->response(null, $http_code);
    }

    /**
     * Increment spaces available
     *
     * @param $lot_id
     */
    public function increment_post($lot_id) {
        $this->load->model('lots_model');
        $successful = $this->lots_model->add_spaces_available($lot_id);

        $http_code = $successful ? 200 : 404;
        $this->response(null, $http_code);

    }

    /**
     * Decrement spaces available
     *
     * @param $lot_id
     */
    public function decrement_post($lot_id) {
        $this->load->model('lots_model');
        $successful = $this->lots_model->dec_spaces_available($lot_id);

        $http_code = $successful ? 200 : 404;
        $this->response(null, $http_code);
    }

    /**
     * Update total spaces for lot
     *
     * @param $lot_id
     */
    public function total_spaces_post($lot_id) {

    }

    /**
     * Update spaces available for lot
     *
     * @param $lot_id
     */
    public function spaces_avaliable_post($lot_id) {

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
