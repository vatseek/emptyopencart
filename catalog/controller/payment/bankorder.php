<?php
class ControllerPaymentBankorder extends Controller {
	protected function index() {
        $this->load->language('payment/bankorder');
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $this->data['action'] = $this->url->link('payment/bankorder/document');
        $this->data['order_id'] = $order_info;
        $this->data['text_instruction'] = $this->language->get('text_instruction');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/bankorder.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/bankorder.tpl';
        } else {
            $this->template = 'default/template/payment/bankorder.tpl';
        }
		
		$this->render();
	}

    public function document()
    {
        var_dump('document');
    }

    public function confirm() {
        $this->load->model('checkout/order');
        $comment = 'Created bank order';
        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('bankorder_order_status_id'), $comment, true);
    }
}
?>