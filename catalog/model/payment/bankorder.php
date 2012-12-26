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
				'sort_order' => $this->config->get('bankorder_sort_order'),
			);
		}

		return $method_data;
	}

    protected function getOrderItems($orderId)
    {
        $orderId += 0;
        $query = "SELECT * FROM `" . DB_PREFIX . "order_product` WHERE order_id = '$orderId';";
        $result = $this->db->query($query);

        return $result->rows;
    }

    public function generatePdf($orderId) {

        try {
            $sDirRoot = dirname(realpath((dirname(__FILE__)) . "/../../"));
            set_include_path(get_include_path().PATH_SEPARATOR.$sDirRoot.'/system/library/pdf/');
            require_once "Zend/Pdf.php";
            $this->load->model('checkout/order');


            //595:842
            $pHeight = 842;
            $pRatio = 300;

            $backColor = new Zend_Pdf_Color_Rgb( 1, 1, 1);
            $textColor = new Zend_Pdf_Color_Rgb( 0, 0, 0);

            $pdf = new Zend_Pdf();
            $page = $pdf->pages[] = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
            // set text style
            $style = new Zend_Pdf_Style();
            $style->setLineColor($textColor);

            $font = Zend_Pdf_Font::fontWithPath(DIR_BASE.'/fonts/arial.ttf');
            $page->setFont($font,10);

            $this->load->model('setting/setting');
            $moduleSettings = $this->model_setting_setting->getSetting('bankorder');

            $address = html_entity_decode($moduleSettings['bankorder_order_content'], ENT_QUOTES, 'UTF-8');

            $address = explode('|', $address);
            $pHeight = $pHeight - 54;
            $offset = 14;
            $page->drawText('Постачальник:', 54, $pHeight , 'utf-8');
            foreach ($address as $addrLine ) {
                $page->drawText($addrLine, 140, $pHeight , 'utf-8');
                $pHeight -= $offset;
            }

            $orderData = $this->model_checkout_order->getOrder($orderId);

            $page->drawText('Одержувач:', 54, $pHeight-5 , 'utf-8');
            $page->drawText($orderData['firstname'] . ' ' . $orderData['lastname'], 140, $pHeight-5 , 'utf-8');

            $pHeight -= 24;
            $page->drawText('Платник:', 54, $pHeight , 'utf-8');
            $page->drawText('Той самий', 140, $pHeight , 'utf-8');


            $page->setFont($font,16);
            $pHeight -= 24;
            $page->drawText('Рахунок-фактура № '.$orderData['order_id'], 180, $pHeight , 'utf-8');
            $page->setFont($font,10);
            $pHeight -= 19;
            $date = explode(' ', $orderData['date_added']);
            $page->drawText('від '.$date[0], 180, $pHeight , 'utf-8');

            $pHeight -= 12;
            $this->drawCell($page, '№', 54, $pHeight, 20, 14, $font, 10, NULL, NULL, new Zend_Pdf_Color_Rgb(0.7, 0.7, 0.7));
            $this->drawCell($page, 'Назва', 74, $pHeight, 350, 14, $font, 10, NULL, NULL, new Zend_Pdf_Color_Rgb(0.7, 0.7, 0.7));
            $this->drawCell($page, 'Кількість', 424, $pHeight, 50, 14, $font, 10, NULL, NULL, new Zend_Pdf_Color_Rgb(0.7, 0.7, 0.7));
            $this->drawCell($page, 'Ціна', 474, $pHeight, 50, 14, $font, 10, NULL, NULL, new Zend_Pdf_Color_Rgb(0.7, 0.7, 0.7));
            $this->drawCell($page, 'Сума', 524, $pHeight, 50, 14, $font, 10, NULL, NULL, new Zend_Pdf_Color_Rgb(0.7, 0.7, 0.7));
            $pHeight -= 14;

            $items = $this->getOrderItems($orderId);

            $i = 1;
            foreach ($items as $item) {
                $this->drawCell($page, $i, 54, $pHeight, 20, 14, $font, 10);
                $this->drawCell($page, $item['name'], 74, $pHeight, 350, 14, $font, 10);
                $this->drawCell($page, sprintf('%0.1f',  $item['quantity']), 424, $pHeight, 50, 14, $font, 10);
                $this->drawCell($page, sprintf('%0.2f', $item['price']), 474, $pHeight, 50, 14, $font, 10);
                $this->drawCell($page, sprintf('%0.2f', $item['total']), 524, $pHeight, 50, 14, $font, 10);
                $i++;
                $pHeight -= 14;
            }

            $this->drawCell($page, 'Всього', 474, $pHeight-1, 50, 14, $font, 10, new Zend_Pdf_Color_Rgb(1, 1, 1));
            $this->drawCell($page, sprintf('%0.2f', $orderData['total']), 524, $pHeight, 50, 14, $font, 10);

            $pHeight -= 40;
            $page->drawText('Всього на сумму   '.sprintf('%0.2f', $orderData['total']) . ' грн.', 54, $pHeight , 'utf-8');

            $page->setFont($font,8);
            $page->drawText('Дякуемо за те, що здійснили покупку в нашому магазині. Приемного дня.', 54, 54 , 'utf-8');

            $pdf->render();
            $fileName = $orderId . '.pdf';
            $pdf->save(DIR_BASE .'orders/' .  $fileName );

            return $fileName;
        }
        catch(Exception $e) {
            return false;
        }
    }

    function drawCell ($page, $text,  $x, $y, $dx, $dy, $font, $fontSize, $borderColor = null, $textColor = null, $backColor = null )
    {
        if ( !isset( $borderColor ) ) {
            $borderColor = new Zend_Pdf_Color_Rgb(0, 0, 0);
        }

        if ( !isset( $textColor ) ) {
            $textColor = new Zend_Pdf_Color_Rgb(0, 0, 0);
        }

        if ( !isset( $backColor ) ) {
            $backColor = new Zend_Pdf_Color_Rgb(1, 1, 1);
        }

        $style = new Zend_Pdf_Style();
        $style -> setFont($font, $fontSize);
        $page -> setStyle($style);

        $data = explode(' ', $text);
        $margDx = $dx - ( $this->horsOffset * 2 );
        $fullHeight = $fontSize + $this->vertOffset;

        $page -> setFillColor( $backColor )
            -> setLineColor( $borderColor )
            -> drawRectangle($x, $y, $x + $dx, $y - $dy)
            -> setFillColor( $textColor );
        $x += 3;

        $tmp = '';
        foreach ( $data as $item ) {
            if ( $this->widthForStringUsingFontSize( $tmp.' '.$item, $font, $fontSize) > $margDx ) {
                $page->drawText(trim($tmp), $x, $y - $fullHeight);
                $tmp = $item;
                $y -= $fullHeight;
            }
            else {
                $tmp .= ' ' . $item;
            }
        }
        $page->drawText($tmp, $x, $y - $fullHeight, 'utf-8');
    }

    function widthForStringUsingFontSize($string, $font, $fontSize)
    {
        $drawingString = iconv('UTF-8', 'UTF-16BE//IGNORE', $string);
        $characters = array();
        for ($i = 0; $i < strlen($drawingString); $i++) {
            $characters[] = (ord($drawingString[$i++]) << 8 ) | ord($drawingString[$i]);
        }
        $glyphs = $font->glyphNumbersForCharacters($characters);
        $widths = $font->widthsForGlyphs($glyphs);
        $stringWidth = (array_sum($widths) / $font->getUnitsPerEm()) * $fontSize;
        return $stringWidth;
    }
}
?>