<?php
/*-----------------------------------------------------------------------------------*/  
/*------------------	          Criação de Post type                 --------------*/
/*-----------------------------------------------------------------------------------*/
if(!function_exists("create_".RADICALFIN."_post_types")){
    function create_hn_fin_post_types()
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
    }
    add_action( 'init', 'create_' . RADICALFIN . '_post_types' );
}
/*------------------       Post type FINANCEIRO    --------------*/

    add_action('init', 'create_financeiro');
	function create_financeiro() {
	    $fin_args = array(
		    'label' => __('Entidade'),
		    'singular_label' => __('Entidade'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_financeiro',$fin_args);
	}
    /*------------------       Post type SERVICO    --------------*/
    add_action('init', 'create_servicos');
	function create_servicos() {
	    $servicos_args = array(
		    'label' => __('Servicos'),
		    'singular_label' => __('Servicos'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_servicos',$servicos_args);
	}
    /*------------------       Post type CENTROS    --------------*/
    add_action('init', 'create_centros');
	function create_centros() {
	    $centros_args = array(
		    'label' => __('Centros'),
		    'singular_label' => __('Centros'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_centros',$centros_args);
	}
    /*------------------       Post type CICLO    --------------*/
    add_action('init', 'create_ciclo');
	function create_ciclo() {
	    $ciclo_args = array(
		    'label' => __('Ciclos'),
		    'singular_label' => __('Ciclo'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_ciclo',$ciclo_args);
	}
    /*------------------       Post type INSTANCIA SERVICO    --------------*/
    add_action('init', 'create_insta');
	function create_insta() {
	    $insta_args = array(
		    'label' => __('Instancia Servico'),
		    'singular_label' => __('Instancia Servico'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_insta',$insta_args);
	}
    /*------------------       Post type LANCAMENTOS    --------------*/
    add_action('init', 'create_lanca');
	function create_lanca() {
	    $lanca_args = array(
		    'label' => __('Lançamentos'),
		    'singular_label' => __('Lançamentos'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_lanca',$lanca_args);
	}
    /*------------------       Post type LANCAMENTOS    --------------*/
    add_action('init', 'create_conta');
	function create_conta() {
	    $conta_args = array(
		    'label' => __('Conta Contábil'),
		    'singular_label' => __('Conta Contábil'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_conta',$conta_args);
	}
    /*------------------       Post type TAXAS    --------------*/
    add_action('init', 'create_taxas');
	function create_taxas() {
	    $taxas_args = array(
		    'label' => __('Taxas'),
		    'singular_label' => __('Taxas'),
		    'public' => true,
		    'show_ui' => true,
		    'capability_type' => 'post',
		    'exclude_from_search' => false,
		    'hierarchical' => false,
		    'rewrite' => true,
		    'supports' => array('none')
	    );
    	register_post_type(RADICALFIN.'_taxas',$taxas_args);
	}

	if(!function_exists("resolvetitle_".RADICALFIN."_post_types")){
		function resolvetitle_hn_fin_post_types($id){
			$post = get_post($id,ARRAY_A);
            //POST TYPE ENTIDADE
			if($post["post_type"] == RADICALFIN.'_financeiro'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
				$tipo_pessoa = get_post_meta($id, 'hn_fin_financeiro_tipo_pessoa', 1);
                
                if($tipo_pessoa == "juridica"){
                    $nome = get_post_meta($id, 'hn_fin_financeiro_razao_social', 1);
                    $cnpj = get_post_meta($id, 'hn_fin_financeiro_cpf', 1);
                    $nometotal = $nome . " - CNPJ - " . $cnpj;
                }else{
                    $nome = get_post_meta($id, 'hn_fin_financeiro_nome', 1);
                    $cpf = get_post_meta($id, 'hn_fin_financeiro_cnpj', 1);
                    $nometotal = $nome . " - CPF - " . $cpf;
                }
				$post["post_title"] = $nome;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
            //POST TYPE SERVICOS
            if($post["post_type"] == RADICALFIN.'_servicos'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
				$nome = get_post_meta($id, 'hn_fin_servicos_nome', 1);
				$post["post_title"] = $nome;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
            //POST TYPE INSTA SERVICOS
            if($post["post_type"] == RADICALFIN.'_insta'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
                
				$id_cliente = get_post_meta($id, 'hn_fin_insta_cliente', 1);
				$cliente = get_the_title($id_cliente);
                
				$dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
                
				$id_servico = get_post_meta($id, 'hn_fin_insta_servico', 1);
				$servico = get_the_title($id_servico);
                
                $post["post_title"] = $id;
                $post["post_title"] .= " - ";
                $post["post_title"] .= $cliente;
                $post["post_title"] .= " - ";
                $post["post_title"] .= $dominio;
                $post["post_title"] .= " - ";
                $post["post_title"] .= $servico;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
            //POST TYPE CENTROS
            if($post["post_type"] == RADICALFIN.'_centros'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
				$nome = get_post_meta($id, 'hn_fin_centros_nome', 1);
                $nome2 = get_post_meta($id, 'hn_fin_centros_descricao', 1);
				$post["post_title"] = $nome;
                $post["post_title"] .= " | ";
                $post["post_title"] .= $nome2;;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
            //POST TYPE CICLOS
            if($post["post_type"] == RADICALFIN.'_ciclo'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
				$nome = get_post_meta($id, 'hn_fin_ciclo_nome', 1);
				$post["post_title"] = $nome;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
            //POST TYPE CONTA CONTABIL
            if($post["post_type"] == RADICALFIN.'_conta'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
				$nome = get_post_meta($id, 'hn_fin_conta_nome', 1);
				$desc = get_post_meta($id, 'hn_fin_conta_descricao', 1);
                $nomefim = $nome . " - " . $desc;
				$post["post_title"] = $nomefim;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
            //POST TYPE TAXAS
            if($post["post_type"] == RADICALFIN.'_taxas'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
				$nome = get_post_meta($id, 'hn_fin_taxas_nome', 1);
                $taxa = get_post_meta($id, 'hn_fin_taxas_valor', 1);
                $taxa_real = $taxa * 100;
                $nome_fim = $nome . " | " . $taxa_real . "%";
				$post["post_title"] = $nome_fim;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
            //POST LANCAMENTOS
            if($post["post_type"] == RADICALFIN.'_lanca'){
				remove_action('wp_insert_post', "resolvetitle_".RADICALFIN."_post_types");
				$tipo = get_post_meta($id, 'hn_fin_lanca_tipo_lancamento', 1);
                
                $datas = get_post_meta($id, 'hn_fin_lanca_data', 1);
                $data = str_replace("-", "", substr($datas, -8));
                
                $id_servico = get_post_meta($id, 'hn_fin_lanca_servico', 1);
                $nome_servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
                
                
                $id_item_serv = get_post_meta($id, 'hn_fin_lanca_item_servico', 1);
                $id_ciclo = get_post_meta($id_item_serv, 'hn_fin_insta_ciclo', 1);
                $recorrencia = get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1);
                $recorrencia = substr($recorrencia,0,1);
                
                $id_cliente = get_post_meta($id, 'hn_fin_lanca_empresa', 1);
                $nome_cliente = get_post_meta($id_cliente, 'hn_fin_financeiro_nome', 1);
                
                $valor = get_post_meta($id, 'hn_fin_lanca_valor', 1);
                
                $id_centro_custo = get_post_meta($id, 'hn_fin_lanca_centro_custo', 1);
                $nome_centro_custo = get_post_meta($id_centro_custo, 'hn_fin_centros_nome', 1);
                $desc_centro_custo = get_post_meta($id_centro_custo, 'hn_fin_centros_descricao', 1);
                $centro_custo = $nome_centro_custo . " " . $desc_centro_custo;
                
                $id_servico = get_post_meta($id, 'hn_fin_lanca_servico', 1);
                $servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
                
                if($tipo == "receita"){
                    $nome_fim = $data . " | " . $recorrencia . " | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $valor . " | " . "IS " . $id_item_serv;
                }if($tipo == "despesa"){
                    $nome_fim = $data . " | " . $centro_custo . " | " . $nome_cliente . " | R$ " . $valor . " | " . $servico;
                }
				$post["post_title"] = $nome_fim;
				wp_update_post($post);
				add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
			}
		}
		add_action('wp_insert_post',"resolvetitle_".RADICALFIN."_post_types");
	}
?>
