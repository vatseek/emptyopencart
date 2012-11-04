SELECT * FROM `category` AS _c
 INNER JOIN `category_description` AS _cd ON _cd.category_id = _c.category_id AND _cd.language_id = '2'
WHERE _c.parent_id = 0 AND _c.status = 1
ORDER BY _c.sort_order;