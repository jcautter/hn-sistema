<?php
if(!function_exists("add_new_".RADICALFIN."_insta_columns")){
    function add_new_hn_fin_insta_columns($columns)
    {
        $columns_new['cb'] = "<input type=\"checkbox\" />";
        $columns_new['title'] = $columns['title'];
        $columns_new['id'] = 'ID';
        $columns_new['emissor'] = 'Emissor da Nota';
        $columns_new['cliente'] = 'Cliente';
        $columns_new['dominio'] = 'Dominio';
        $columns_new['servico'] = 'Serviço';
        $columns_new['ciclo'] = 'Ciclo';
        $columns_new['valor'] = 'Valor';
        $columns_new['status'] = 'Status';
        return $columns_new;
    }
}
if(!function_exists("manage_".RADICALFIN."_insta_columns")){
    function manage_hn_fin_insta_columns($column_name, $id)
    {
        global $wpdb;
        $prefix = 'hn_fin_insta_';
        switch ($column_name)
        {     
            case 'id':
                echo $id;
                break;
            case 'emissor':
                $id_emissor = get_post_meta( $id,'hn_fin_insta_emissor_nota', true);
                echo get_the_title($id_emissor);
                break;
            case 'cliente':
                $id_cliente = get_post_meta( $id,'hn_fin_insta_cliente', true);
                echo get_the_title($id_cliente);
                break;
            case 'dominio':
                $dominio = get_post_meta( $id,'hn_fin_insta_dominio', true);
                echo $dominio;
                break;
            case 'servico':
                $id_servico = get_post_meta( $id,'hn_fin_insta_servico', true);
                echo get_the_title($id_servico);
                break;
            case 'ciclo':
                $id_ciclo = get_post_meta( $id,'hn_fin_insta_ciclo', true);
                echo get_the_title($id_ciclo);
                break;
            case 'valor':
                echo  get_post_meta($id, 'hn_fin_insta_valor', true);
                break;
            case 'status':
                $data = get_post_meta($id, 'hn_fin_insta_data_fim', true);
                $suspenso = get_post_meta($id, 'hn_fin_insta_suspenso', true);
                if($suspenso == "1"){
                    echo "<span style='color: yellow;'>Suspenso</span>";
                }else if($data != ""){
                    echo "<span style='color: red;'>Cancelado</span>";
                }else {
                    echo "<span style='color: green;'>Ativo</span>";   
                }
                break;
            default:
                break;
            
        } // end switch
    }
}

if(!function_exists("load_custom_columns")){
    function load_custom_columns()
    {
        add_filter('manage_edit-'.RADICALFIN.'_insta_columns', 'add_new_'.RADICALFIN.'_insta_columns');
        add_action('manage_'.RADICALFIN.'_insta_posts_custom_column', 'manage_'.RADICALFIN.'_insta_columns', 10, 2);
        //add_filter('manage_edit-'.RADICALFIN.'_produto_columns', 'add_new_'.RADICALFIN.'_produto_columns');
        //add_action('manage_'.RADICALFIN.'_produto_posts_custom_column', 'manage_'.RADICALFIN.'_produto_columns', 10, 2);
    }
}
add_action('admin_init', 'load_custom_columns');
?>