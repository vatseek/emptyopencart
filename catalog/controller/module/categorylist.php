<?php  
class ControllerModuleCategorylist extends Controller {
    public function index() {
        static $module = 0;

        $this->load->model('module/categorylist');
        $this->load->model('tool/image');

        $categories = $this->model_module_categorylist->getCategories();

        $picHeight = 120;
        $picWidth = 120;

        foreach ($categories as $key => $category) {
            $categories[$key]['href'] = $this->url->link('product/category', 'path=' . $category['category_id']);
            $categories[$key]['image'] = $this->model_tool_image->resize($categories[$key]['image'], $picWidth, $picHeight);
        }

        $this->data['categories'] = $categories;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/categorylist.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/categorylist.tpl';
        } else {
            $this->template = 'default/template/module/categorylist.tpl';
        }

        $this->render();
    }
}
?>