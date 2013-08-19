<?php

	$query = '
		SELECT 
		posts.id as post_id, 
		DATEDIFF(NOW(), posts.post_date)+1 as factor_date, 
		(
			select meta_value 
				from foryouandyourcustomers.wp_postmeta as meta_priority 
			WHERE meta_priority.post_id = posts.id AND meta_priority.meta_key = "postPriority"
		) as factor_priority_name,
		(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = factor_priority_name) as factor_priority_value,
		posts.post_type as factor_type_name,
		(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = posts.post_type) as factor_type_value,
		posts.post_type
		
		FROM foryouandyourcustomers.wp_posts as posts
		
		WHERE posts.id IN (
			SELECT id as frontpage_id
				FROM foryouandyourcustomers.wp_posts as posts
				WHERE posts.id in (
					SELECT meta.post_id
					FROM foryouandyourcustomers.wp_postmeta as meta
					WHERE meta.meta_key = "postOnFrontpage" AND meta.meta_value ="yes"
				)
			)
			AND posts.post_status = "publish"
		
		ORDER BY (factor_date * factor_priority_value * factor_type_value) ASC
		LIMIT 20
	';
	
?>