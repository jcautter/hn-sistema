<?php
/*-----------------------------------------------------------------------------------*/  
/*------------------	            Criação de Role                    --------------*/
/*-----------------------------------------------------------------------------------*/
if(!function_exists("create_".RADICALFIN."_roles")){
    function create_hn_fin_roles()
    {
        /*------------------       xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx      --------------*/
        
        $caps_model = array(
            'read_post'             => null,
            'edit_post'             => null,
            'edit_posts'            => null,
            'delete_post'           => null,
            'delete_posts'          => null,
            'publish_posts'         => null,
            'edit_published_posts'  => null,
            'delete_published_posts'=> null,
            'read_private_posts'    => null,
            'edit_private_posts'    => null,
            'delete_private_posts'  => null,
            'edit_others_posts'     => null,
            'delete_others_posts'   => null,
        );
        
        
        /*------------------             Role Financeiro                   --------------*/
        $result = add_role(
            'hn_financeiro',
            'Financeiro',
            array(
                'read'         => true,  // true allows this capability
                'level_0' => true
            )
        );
        /*------------------             Role administrator                --------------*/
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_financeiro';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $taxonomy_name = RADICALFIN."_txy_cat_cliente";
        
        
        $caps[] = "manage_{$taxonomy_name}";
        $caps[] = "edit_{$taxonomy_name}";
        $caps[] = "delete_{$taxonomy_name}";
        $caps[] = "assign_{$taxonomy_name}";
        $caps[] = RADICALFIN.'_pg_controle_pagamento';
        $caps[] = RADICALFIN.'_pg_serv_cli';
        $caps[] = RADICALFIN.'_pg_invent_servicos';
        $caps[] = RADICALFIN.'_pg_lucro_despesa';
        $caps[] = RADICALFIN.'_pg_processar_lancamento';
        $caps[] = RADICALFIN.'_pg_rel_gerencial';
        $caps[] = RADICALFIN.'_pg_gera_boleto';
        $caps[] = RADICALFIN.'_pg_move_boletos';
        $caps[] = RADICALFIN.'_pg_temporario';
        $caps[] = 'level_0';
        $caps[] = 'read';
	
        
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        
        $role = get_role('hn_financeiro');
        if(is_object( $role ))
        {
            $role->add_cap(RADICALFIN.'_pg_controle_pagamento');
        }
        
        
        /* --------------------- Role Post type SERVICO ------------------- */
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_servicos';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $taxonomy_name = RADICALFIN."_txy_servico";
        
        $caps[] = "manage_{$taxonomy_name}";
        $caps[] = "edit_{$taxonomy_name}";
        $caps[] = "delete_{$taxonomy_name}";
        $caps[] = "assign_{$taxonomy_name}";
        
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        /* --------------------- Role Post type CENTROS ------------------- */
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_centros';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        /* --------------------- Role Post type CICLO ------------------- */
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_ciclo';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $taxonomy_name = RADICALFIN."_txy_tipo_ciclo";
        
        $caps[] = "manage_{$taxonomy_name}";
        $caps[] = "edit_{$taxonomy_name}";
        $caps[] = "delete_{$taxonomy_name}";
        $caps[] = "assign_{$taxonomy_name}";
		
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        /* --------------------- Role Post type INSTANCIA SERVICO ------------------- */
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_insta';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        
        $role = get_role('hn_financeiro');
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        /* --------------------- Role Post type LANCAMENTO ------------------- */
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_lanca';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        
        $role = get_role('hn_financeiro');
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        /* --------------------- Role Post type CONTA CONTABIL ------------------- */
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_conta';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
        /* --------------------- Role Post type TAXAS ------------------- */
        
        $caps = array();
        
        $post_type_name = RADICALFIN . '_taxas';
        
        foreach($caps_model as $capk => $capi)
        {
            $caps[] = str_replace('post', $post_type_name, $capk);
        }
        
        $role = get_role('administrator');
        
        if(is_object( $role ))
        {
            foreach($caps as $item)
            {
                $role->add_cap($item);
            }
        }
    }
    add_action( 'init', 'create_'.RADICALFIN.'_roles' );
} else {
    die("função create_".RADICALFIN."_roles já existe");
}
?>