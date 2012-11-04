<?php
/**
 * User: vatseek
 * Date: 04.11.12
 * Time: 14:35
 * To change this template use File | Settings | File Templates.
 */
    class ModelModuleCategorylist extends Model {
        public function getCategories(){

            $categorylistData = $this->cache->get('categorylist');

            if (!$categorylistData) {
                $languageId = (int)$this->config->get('config_language_id');

                $query = "SELECT _c.*, _cd.name FROM `" . DB_PREFIX . "category` AS _c
                    INNER JOIN `" . DB_PREFIX . "category_description` AS _cd ON _cd.category_id = _c.category_id AND _cd.language_id = '{$languageId}'
                    WHERE _c.parent_id = 0 AND _c.status = '1' AND _c.image <> ''
                    ORDER BY _c.sort_order;";
                $result = $this->db->query($query);
                $data = $result->rows;

                $this->cache->set('categorylist', $data);
                return $data;
            }
            else {
                return $categorylistData;
            }
        }
    }

?>
