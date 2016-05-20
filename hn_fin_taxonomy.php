<?php
/*-----------------------------------------------------------------------------------*/  
/*------------------	          Criação de Taxonomy                  --------------*/
/*-----------------------------------------------------------------------------------*/
if(!function_exists("create_".RADICALFIN."_taxonomies")){
    function create_hn_fin_taxonomies(){
        // Taxonomia de CATEGORIA DE CLIENTE
        $labels = array(
            'name' => 'Categorias de Cliente',
            'singular_name' => 'Categoria de Cliente',
            'search_items' =>  'Buscar Categoria de Cliente',
            'popular_items' => 'Categoria de Cliente populares',
            'all_items' => 'Todos Categoria de Cliente',
            'parent_item' => 'Categoria de Cliente pai',
            'parent_item_colon' => 'Categoria de Cliente pai',
            'edit_item' => 'Editar Categoria de Cliente', 
            'update_item' => 'Atualizar Categoria de Cliente',
            'add_new_item' => 'Adicionar nova Categoria de Cliente',
            'new_item_name' => 'Novo Categoria de Cliente',
            'separate_items_with_commas' => 'Separe as Categorias de Clientes com virgula(,)',
            'add_or_remove_items' => 'Adicione ou remova uma Categoria de Cliente',
            'choose_from_most_used' => 'Escolha entre as Categoria de Cliente mais populares',
            'menu_name' => 'Categoria de Cliente',
        );
        $taxonomy_name = RADICALFIN."_txy_cat_cliente";
        $capabilities = array(
            'manage_terms'          => "manage_{$taxonomy_name}",
            'edit_terms'            => "edit_{$taxonomy_name}",
            'delete_terms'          => "delete_{$taxonomy_name}",
            'assign_terms'          => "assign_{$taxonomy_name}",
        );
        $args = array(
            'public' => true,
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'servico' ),
            'capabilities' => $capabilities,
        );
        register_taxonomy(
            $taxonomy_name,
            array(RADICALFIN."_financeiro"),
            $args
        );
        // Taxonomia de SERVICO
        $labels = array(
            'name' => 'Categoria Serviços',
            'singular_name' => 'Categoria Serviço',
            'search_items' =>  'Buscar Serviço',
            'popular_items' => 'Serviço populares',
            'all_items' => 'Todos Serviço',
            'parent_item' => 'Serviço pai',
            'parent_item_colon' => 'Serviço pai',
            'edit_item' => 'Editar Serviço', 
            'update_item' => 'Atualizar Serviço',
            'add_new_item' => 'Adicionar Serviço',
            'new_item_name' => 'Novo Serviço',
            'separate_items_with_commas' => 'Separe os Serviço com virgula(,)',
            'add_or_remove_items' => 'Adicione ou remova um Serviço',
            'choose_from_most_used' => 'Escolha entre os Serviço mais populares',
            'menu_name' => 'Categoria Serviço',
        );
        $taxonomy_name = RADICALFIN."_txy_servico";
        $capabilities = array(
            'manage_terms'          => "manage_{$taxonomy_name}",
            'edit_terms'            => "edit_{$taxonomy_name}",
            'delete_terms'          => "delete_{$taxonomy_name}",
            'assign_terms'          => "assign_{$taxonomy_name}",
        );
        $args = array(
            'public' => true,
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'servico' ),
            'capabilities' => $capabilities,
        );
        register_taxonomy(
            $taxonomy_name,
            array(RADICALFIN."_servicos"),
            $args
        );
        // Taxonomia de TIPO CICLO
        $labels = array(
            'name' => 'Categoria Tipo de Ciclos',
            'singular_name' => 'Categoria Tipo de Ciclo',
            'search_items' =>  'Buscar Tipo de Ciclo',
            'popular_items' => 'Tipos de Ciclos populares',
            'all_items' => 'Todos os Tipos de Ciclos',
            'parent_item' => 'Tipos de Ciclos pai',
            'parent_item_colon' => 'Tipos de Ciclos pai',
            'edit_item' => 'Editar Tipo de Ciclo', 
            'update_item' => 'Atualizar Tipo de Ciclo',
            'add_new_item' => 'Adicionar Tipo de Ciclo',
            'new_item_name' => 'Novo Tipo de Ciclo',
            'separate_items_with_commas' => 'Separe os Tipo de Ciclo com virgula(,)',
            'add_or_remove_items' => 'Adicione ou remova um Tipo de Ciclo',
            'choose_from_most_used' => 'Escolha entre os Tipo de Ciclo mais populares',
            'menu_name' => 'Tipo de Ciclo',
        );
        $taxonomy_name = RADICALFIN."_txy_tipo_ciclo";
        $capabilities = array(
            'manage_terms'          => "manage_{$taxonomy_name}",
            'edit_terms'            => "edit_{$taxonomy_name}",
            'delete_terms'          => "delete_{$taxonomy_name}",
            'assign_terms'          => "assign_{$taxonomy_name}",
        );
        $args = array(
            'public' => true,
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'tipo_ciclo' ),
            'capabilities' => $capabilities,
        );
        register_taxonomy(
            $taxonomy_name,
            array(RADICALFIN."_ciclo"),
            $args
        );
    }
	add_action( 'init', "create_".RADICALFIN."_taxonomies", 0 );
	}
	else{
        die("função create_".RADICALFIN."_taxonomies já existe");
	}
	if(!function_exists("remove_".RADICALFIN."_taxonomies_boxes")){
		function remove_hn_fin_taxonomies_boxes() {
		remove_meta_box( "tagsdiv-".RADICALFIN."_txy_servico", RADICALFIN."_financeiro", 'side' );
        remove_meta_box( "tagsdiv-".RADICALFIN."_txy_tipo_ciclo", RADICALFIN."_ciclo", 'side' );
	}
    add_action( 'admin_menu' , "remove_".RADICALFIN."_taxonomies_boxes" );

}
?>