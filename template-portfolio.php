<?php
function post_type_work() {
register_post_type(
	'work', 
	array( 'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => false,
		'labels'=>array(
			'name' => _x('作品', 'post type general name'),
			'singular_name' => _x('作品', 'post type singular name'),
			'add_new' => _x('添加新作品', '作品'),
			'add_new_item' => __('添加新作品'),
			'edit_item' => __('编辑作品'),
			'new_item' => __('新的作品'),
			'view_item' => __('预览作品'),
			'search_items' => __('搜索作品'),
			'not_found' =>  __('您还没有发布作品'),
			'not_found_in_trash' => __('回收站中没有作品'), 
			'parent_item_colon' => ''
			),
		 'show_ui' => true,
		 'menu_position'=>5,
			'supports' => array(
			'title',
			'author', 
			'excerpt',
			'thumbnail',
			'trackbacks',
			'editor', 
			'comments',
			'custom-fields',
			'revisions'	) ,
		'show_in_nav_menus'	=> true ,
		'taxonomies' => array(	
		    'menutype')
			) 
	); 
} 
add_action('init', 'post_type_work');

function create_genre_taxonomy() {
  $labels = array(
		 'name' => _x( '作品分类', 'taxonomy general name' ),
		 'singular_name' => _x( 'genre', 'taxonomy singular name' ),
		 'search_items' =>  __( '搜索分类' ),
		 'all_items' => __( '全部分类' ),
		 'parent_item' => __( '父级分类目录' ),
		 'parent_item_colon' => __( '父级分类目录:' ),
		 'edit_item' => __( '编辑作品分类' ), 
		 'update_item' => __( '更新' ),
		 'add_new_item' => __( '添加新作品分类' ),
		 'new_item_name' => __( 'New Genre Name' ),
  ); 
  register_taxonomy('genre',array('work'), array(
         'hierarchical' => true,
         'labels' => $labels,
         'show_ui' => true,
         'query_var' => true,
         'rewrite' => array( 'slug' => 'genre' ),
  ));
}
add_action( 'init', 'create_genre_taxonomy', 0 );
?>