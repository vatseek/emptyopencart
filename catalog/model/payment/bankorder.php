<?php 
class ModelPaymentBankorder extends Model {
	public function getMethod($address, $total) {
		$this->load->language('payment/bankorder');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('liqpay_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		$method_data = array();
        $status = $this->config->get('bankorder_status');

		if ($status) {
			$method_data = array(
				'code'       => 'bankorder',
				'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('bankorder_sort_order')
			);
		}

		return $method_data;
	}
}
?>