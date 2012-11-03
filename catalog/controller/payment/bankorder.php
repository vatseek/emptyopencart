<?php
class ControllerPaymentBankorder extends Controller {
	protected function index() {
        $this->load->language('payment/bankorder');
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $this->data['action_order'] = $this->url->link('payment/bankorder/document');
        $this->data['action'] = $this->url->link('checkout/success');
        $this->data['order_id'] = $order_info;
        $this->data['text_instruction'] = $this->language->get('text_instruction');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/bankorder.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/bankorder.tpl';
        } else {
            $this->template = 'default/template/payment/bankorder.tpl';
        }
		
		$this->render();
	}

    public function confirm() {
        $this->load->model('checkout/order');
        $comment = 'Created bank order';
        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('bankorder_order_status_id'), $comment, true);
    }

    public function document()
    {
        $this->load->model('payment/bankorder');
        $language = $this->load->language('payment/bankorder');
        $orderId = '';
        if (isset($this->session->data['order_id'])) {
            $orderId = $this->session->data['order_id'];
        }
        $fileName = $this->model_payment_bankorder->generatePdf($orderId);
        if (!$fileName) {
            $this->data['breadcrumbs'] = array();
            $this->data['text_error'] = sprintf($this->language->get('text_error'), $orderId);
            $this->template = 'default/template/error/not_found.tpl';
            $this->children = array(
                'common/column_left',
                'common/column_right',
                'common/content_top',
                'common/content_bottom',
                'common/footer',
                'common/header'
            );
            $this->data = array_merge($language, $this->data);

            $this->response->setOutput($this->render());
        }
        else {
            $this->redirect( HTTP_SERVER . 'orders/' . $fileName );
        }
    }

}
?>