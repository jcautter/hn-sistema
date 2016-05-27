<?php

/*-----------------------------------------------------------------------------------*/  
/*------------------	          Criação de Meta Boxe                 --------------*/
/*-----------------------------------------------------------------------------------*/
if(!function_exists("create_".RADICALFIN."_meta_boxes")){
    function create_hn_fin_meta_boxes(){
		if ( ! class_exists( 'RW_Meta_Box' ) )
			return;
		global $ckurlt;
		global $ckurl;
		$ckurlt = explode('/', $_SERVER['REQUEST_URI']);
		$ckurl = explode('?', $ckurlt[count($ckurlt)-1]);
		$urlvarst = explode('&', $ckurl[1]);
		if(count($urlvarst) > 0){
			foreach($urlvarst as $item){
			$var = explode('=', $item);
			$urlvars[$var[0]] = $var[1];
			}
		}
		global $meta_boxes;
		$meta_boxes = array();
		
		/*------------ Meta Box - DADOS PESSOAIS do post type FINANCEIRO ------------*/
		$prefix = RADICALFIN . '_financeiro_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_dados',
			'title' => 'Dados do Cliente',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                
                // RADIO BUTTONS
                array(
                    'name' => 'Tipo de Pessoa',
                    'id' => "{$prefix}tipo_pessoa",
                    'type' => 'radio',
                    // Array of 'value' => 'Label' pairs for radio options.
                    // Note: the 'value' is stored in meta field, not the 'Label'
                    'options' => array(
                        'fisica' => 'Fisica',
                        'juridica' => 'Juridica',
                    ),
                ),
                // POST
                array(
                    'name' => __( 'Conta Contábil', 'meta-box' ),
                    'id' => "{$prefix}conta_contabil",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_conta',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um favorecido', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // TEXT
				array(
					'name' => 'Nome',
					'id' => "{$prefix}nome",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'CPF',
					'id' => "{$prefix}cpf",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Razão Social',
					'id' => "{$prefix}razao_social",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'CNPJ',
					'id' => "{$prefix}cnpj",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Nome Fantasia',
					'id' => "{$prefix}nome_fantasia",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'CEP',
					'id' => "{$prefix}cep",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Estado',
					'id' => "{$prefix}estado",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Cidade',
					'id' => "{$prefix}cidade",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Bairro',
					'id' => "{$prefix}bairro",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Endereço',
					'id' => "{$prefix}endereco",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Numero',
					'id' => "{$prefix}numero",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Complemento',
					'id' => "{$prefix}complemento",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Responsável',
					'id' => "{$prefix}nome_cliente",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Telefone',
					'id' => "{$prefix}telefone",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Celular',
					'id' => "{$prefix}celular",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Email',
					'id' => "{$prefix}email",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                
			),
		);
        /*------------ Meta Box - INFORMACOES DE SERVICO do post type SERVICOS ------------*/
		$prefix = RADICALFIN . '_servicos_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_inf',
			'title' => 'Informacoes de Serviços',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                // TEXT
				array(
					'name' => 'Nome',
					'id' => "{$prefix}nome",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // RADIO BUTTONS
                array(
                    'name' => __( 'Receita/Despesa', 'meta-box' ),
                    'id' => "{$prefix}receita_despesa",
                    'type' => 'radio',
                    // Array of 'value' => 'Label' pairs for radio options.
                    // Note: the 'value' is stored in meta field, not the 'Label'
                    'options' => array(
                        'receita' => __( 'Receita', 'meta-box' ),
                        'despesa' => __( 'Despesa', 'meta-box' ),
                    ),
                ),
                // TAXONOMY
               /* array(
                    'name' => __( 'Categoria de Serviços - Lucro', 'meta-box' ),
                    'id' => "{$prefix}cat_servicos_lucro",
                    'type' => 'taxonomy',
                    'options' => array(
                        // Taxonomy name
                        'taxonomy' => 'hn_fin_txy_servico',
                        // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
                        'type' => 'select_advanced',

                        // Additional arguments for get_terms() function. Optional
                        'args' => array(
                            'child_of'  =>  2,
                        )
                    ),
                ),*/
                // TAXONOMY
                array(
                    'name' => __( 'Categoria de Serviços', 'meta-box' ),
                    'id' => "{$prefix}cat_servicos_custo",
                    'type' => 'taxonomy',
                    'options' => array(
                        // Taxonomy name
                        'taxonomy' => 'hn_fin_txy_servico',
                        // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
                        'type' => 'select_advanced',

                        // Additional arguments for get_terms() function. Optional
                        'args' => array()
                    ),
                ),
                // TEXT
				array(
					'name' => 'Valor',
					'id' => "{$prefix}valor",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TAXONOMY
                /*array(
                    'name' => __( 'Tipo Ciclo', 'meta-box' ),
                    'id' => "{$prefix}categoria",
                    'type' => 'taxonomy',
                    'options' => array(
                    // Taxonomy name
                    'taxonomy' => 'hn_fin_txy_tipo_ciclo',
                    // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
                    'type' => 'checkbox_tree',
                        
                    // Additional arguments for get_terms() function. Optional
                    'args' => array()
                    ),
                ),*/
                // POST
                array(
                    'name' => __( 'Centro de lucro', 'meta-box' ),
                    'id' => "{$prefix}centro_lucro",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_centros',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um serviço', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'meta_query' => array(
                            array(
                                'key'     => 'hn_fin_centros_tipo_pessoa',
                                'value'   => 'lucro',
                                'compare' => '=',
                            ),
                        ),
                    )
                ),
                // POST
                array(
                    'name' => __( 'Centro de custo', 'meta-box' ),
                    'id' => "{$prefix}centro_custo",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_centros',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um serviço', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'meta_query' => array(
                            array(
                                'key'     => 'hn_fin_centros_tipo_pessoa',
                                'value'   => 'custo',
                                'compare' => '=',
                            ),
                        ),
                    )
                ),
			),
		);
        /*------------ Meta Box - INFORMACOES DE CUSTO do post type CENTROS ------------*/
		$prefix = RADICALFIN . '_centros_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_inf',
			'title' => 'Informacoes de Custo',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                // RADIO BUTTONS
                array(
                    'name' => 'Tipo de Pessoa',
                    'id' => "{$prefix}tipo_pessoa",
                    'type' => 'radio',
                    // Array of 'value' => 'Label' pairs for radio options.
                    // Note: the 'value' is stored in meta field, not the 'Label'
                    'options' => array(
                        'lucro' => 'Lucro',
                        'custo' => 'Custo',
                    ),
                ),
                // TEXT
				array(
					'name' => 'Nome',
					'id' => "{$prefix}nome",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXTAREA
                array(
                    'name' => __( 'Descriçao', 'meta-box' ),
                    'desc' => __( 'descricao', 'meta-box' ),
                    'id' => "{$prefix}descricao",
                    'type' => 'textarea',
                    'cols' => 20,
                    'rows' => 3,
                ),
                
			),
		);
        /*------------ Meta Box - INFORMACOES DE CICLOS do post type CILOS ------------*/
		$prefix = RADICALFIN . '_ciclo_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_inf',
			'title' => 'Informacoes de Ciclos',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                // TEXT
				array(
					'name' => 'Nome',
					'id' => "{$prefix}nome",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TAXONOMY
                array(
                    'name' => __( 'Tipo Ciclo', 'meta-box' ),
                    'id' => "{$prefix}categoria",
                    'type' => 'taxonomy',
                    'options' => array(
                    // Taxonomy name
                    'taxonomy' => 'hn_fin_txy_tipo_ciclo',
                    // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
                    'type' => 'checkbox_tree',
                    // Additional arguments for get_terms() function. Optional
                    'args' => array()
                    ),
                ),
                // TEXT
				array(
					'name' => 'Dia Emissao',
					'id' => "{$prefix}dia_emissao",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // SELECT BOX
                array(
                    'name' => __( 'Recorrencia em Meses', 'meta-box' ),
                    'id' => "{$prefix}recorrencia_meses",
                    'type' => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options' => array(
                        '1' => __( '1', 'meta-box' ),
                        '2' => __( '2', 'meta-box' ),
                        '3' => __( '3', 'meta-box' ),
                        '4' => __( '4', 'meta-box' ),
                        '6' => __( '6', 'meta-box' ),
                        '12' => __( '12', 'meta-box' ),  
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple' => false,
                    'std' => 'value2',
                    'placeholder' => __( 'Selecione uma data', 'meta-box' ),
                ),
			),
		);
        /*------------ Meta Box - INFORMACOES DE INSTANCIA DE SERVICO do post type INSTANCIA DE SERVICO ------------*/
		$prefix = RADICALFIN . '_insta_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_inf',
			'title' => 'Informacoes de Instancia de servicos',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                // POST
                array(
                    'name' => __( 'Emissor de Nota', 'meta-box' ),
                    'id' => "{$prefix}emissor_nota",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_financeiro',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um serviço', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'hn_fin_txy_cat_cliente',
                                'field' => 'slug',
                                'terms' => 'emissor-de-nota' //excluding the term you dont want.
                            )
                        )
                    )
                ),
                // POST
                array(
                    'name' => __( 'Cliente', 'meta-box' ),
                    'id' => "{$prefix}cliente",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_financeiro',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione uma entidade', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'hn_fin_txy_cat_cliente',
                                'field' => 'slug',
                                'terms' => 'cliente' //excluding the term you dont want.
                            )
                        )
                        
                    )
                ),
                // RADIO BUTTONS
                array(
                    'name' => __( 'Receita/Despesa', 'meta-box' ),
                    'id' => "{$prefix}receita_despesa",
                    'type' => 'radio',
                    // Array of 'value' => 'Label' pairs for radio options.
                    // Note: the 'value' is stored in meta field, not the 'Label'
                    'options' => array(
                        'receita' => __( 'Receita', 'meta-box' ),
                        'despesa' => __( 'Despesa', 'meta-box' ),
                    ),
                ),
                // POST
                array(
                    'name' => __( 'Serviço', 'meta-box' ),
                    'id' => "{$prefix}servico",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_servicos',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um serviço', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // TEXT
				array(
					'name' => 'Valor Total',
					'id' => "{$prefix}valor",
					'desc' => 'Digite o valor total do serviço',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Parcelas',
					'id' => "{$prefix}parcelas",
					'desc' => 'Digite a quantidade de parcelas',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Entrada',
					'id' => "{$prefix}valor_entrada",
					'desc' => '<span style="color:red;">SOMENTE PARA VALOR PARCELADO.</span> Digite o valor da entrada. O valor cobrado na primeira parcela.',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // POST
                array(
                    'name' => __( 'Ciclo', 'meta-box' ),
                    'id' => "{$prefix}ciclo",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_ciclo',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um ciclo', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // TEXT
				array(
					'name' => 'Data Inicio',
					'id' => "{$prefix}data_inicio",
					'type' => 'date',
					'js_options' => array(
                        'appendText' => '(yyyy-mm-dd)',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    ),
				),
                // TEXT
				array(
					'name' => 'Data Fim',
					'id' => "{$prefix}data_fim",
					'type' => 'date',
					'js_options' => array(
                        'appendText' => '(yyyy-mm-dd)',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    ),
				),
                
                // RADIO BUTTONS
                array(
                    'name' => __( 'Tipo de Valor', 'meta-box' ),
                    'id' => "{$prefix}tipo_valor",
                    'type' => 'radio',
                    // Array of 'value' => 'Label' pairs for radio options.
                    // Note: the 'value' is stored in meta field, not the 'Label'
                    'options' => array(
                        'bruto' => __( 'Bruto', 'meta-box' ),
                        'liquido' => __( 'Liquido', 'meta-box' ),
                    ),
                ),
                // POST
                array(
                    'name' => __( 'Taxas', 'meta-box' ),
                    'id' => "{$prefix}taxas",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_taxas',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'checkbox_list',
                    'placeholder' => __( 'Selecione uma taxa', 'meta-box' ),
                    'multiple' => true,
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // TEXT
				array(
					'name' => 'Dominio',
					'id' => "{$prefix}dominio",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // CHECKBOX
                array(
                    'name' => __( 'Suspenso', 'meta-box' ),
                    'id' => "{$prefix}suspenso",
                    'type' => 'checkbox',
                    // Value can be 0 or 1
                    'std' => 0,
                ),
			),
		);
        /*------------ Meta Box - INFORMACOES DE LANCAMENTOS do post type LANCAMENTOS ------------*/
		$prefix = RADICALFIN . '_lanca_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_inf',
			'title' => 'Informacoes de Lançamentos',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                // RADIO BUTTONS
                array(
                    'name' => 'Tipo de Lancamento',
                    'id' => "{$prefix}tipo_lancamento",
                    'type' => 'radio',
                    // Array of 'value' => 'Label' pairs for radio options.
                    // Note: the 'value' is stored in meta field, not the 'Label'
                    'options' => array(
                        'receita' => 'Receita',
                        'despesa' => 'Despesa',
                    ),
                ),
                // POST
                array(
                    'name' => __( 'Favorecido', 'meta-box' ),
                    'id' => "{$prefix}favorecido",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_financeiro',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um favorecido', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'hn_fin_txy_cat_cliente',
                                'field' => 'slug',
                                'terms' => 'emissor-de-nota' //excluding the term you dont want.
                            )
                        )
                    )
                ),
                // POST
                array(
                    'name' => __( 'Item de Serviço', 'meta-box' ),
                    'id' => "{$prefix}item_servico",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_insta',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione uma Instância de serviço', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // POST
                array(
                    'name' => __( 'Serviço', 'meta-box' ),
                    'id' => "{$prefix}servico",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_servicos',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um serviço', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // POST
                array(
                    'name' => __( 'Empresa', 'meta-box' ),
                    'id' => "{$prefix}empresa",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_financeiro',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione uma empresa', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'hn_fin_txy_cat_cliente',
                                'field' => 'slug',
                                'terms' => 'emissor-de-nota', //excluding the term you dont want.
                                'operator'  => 'NOT IN'
                            )
                        )
                    )
                ),
                // DATE
				array(
					'name' => 'Data',
					'id' => "{$prefix}data",
					'type' => 'date',
					'js_options' => array(
                        'appendText' => '(yyyy-mm-dd)',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    ),
				),
                // DATE
				array(
					'name' => 'Data de Vencimento',
					'id' => "{$prefix}data_vencimento",
					'type' => 'date',
					'js_options' => array(
                        'appendText' => '(yyyy-mm-dd)',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    ),
				),
                // DATE
				array(
					'name' => 'Data de Arrecadação',
					'id' => "{$prefix}data_arrecadacao",
					'type' => 'date',
					'js_options' => array(
                        'appendText' => '(yyyy-mm-dd)',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    ),
				),
                // FILE UPLOAD
                array(
                    'name' => __( 'PDF', 'your-prefix' ),
                    'id'   => "{$prefix}pdf",
                    'type' => 'file',
                ),
                // TEXT
				array(
					'name' => 'Valor',
					'id' => "{$prefix}valor",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Parcela',
					'id' => "{$prefix}parcela",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Nota Fiscal',
					'id' => "{$prefix}nota_fiscal",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Valor Multa',
					'id' => "{$prefix}valor_multa",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // RADIO BUTTONS
                array(
                    'name' => __( 'Baixa', 'meta-box' ),
                    'id' => "{$prefix}baixa",
                    'type' => 'radio',
                    // Array of 'value' => 'Label' pairs for radio options.
                    // Note: the 'value' is stored in meta field, not the 'Label'
                    'options' => array(
                        'pago' => __( 'Pago', 'meta-box' ),
                        'servico_cancelado' => __( 'Serviço Cancelado', 'meta-box' ),
                        'suspenso' => __( 'Suspenso', 'meta-box' ),
                        'lancamento_cancelado' => __( 'Lançamento Cancelado', 'meta-box' ),
                    ),
                ),
                // DATE
				array(
					'name' => 'Data de Cobrança',
					'id' => "{$prefix}data_cobranca",
					'type' => 'date',
					'js_options' => array(
                        'appendText' => '(yyyy-mm-dd)',
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    ),
				),
                // POST
                array(
                    'name' => __( 'Conta Contábil', 'meta-box' ),
                    'id' => "{$prefix}contabil",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_conta',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione uma conta contábil', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // POST
                array(
                    'name' => __( 'Taxas', 'meta-box' ),
                    'id' => "{$prefix}taxas",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_taxas',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'checkbox_list',
                    'placeholder' => __( 'Selecione uma taxa', 'meta-box' ),
                    'multiple' => true,
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                    )
                ),
                // POST
                array(
                    'name' => __( 'Centro de Lucro', 'meta-box' ),
                    'id' => "{$prefix}centro_lucro",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_centros',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um centro', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'meta_query' => array(
                            array(
                                'key'     => 'hn_fin_centros_tipo_pessoa',
                                'value'   => 'lucro',
                                'compare' => '=',
                            ),
                        ),
                    )
                ),
                // POST
                array(
                    'name' => __( 'Centro de Custo', 'meta-box' ),
                    'id' => "{$prefix}centro_custo",
                    'type' => 'post',
                    // Post type
                    'post_type' => 'hn_fin_centros',
                    // Field type, either 'select' or 'select_advanced' (default)
                    'field_type' => 'select_advanced',
                    'placeholder' => __( 'Selecione um centro', 'meta-box' ),
                    // Query arguments (optional). No settings means get all published posts
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => - 1,
                        'meta_query' => array(
                            array(
                                'key'     => 'hn_fin_centros_tipo_pessoa',
                                'value'   => 'custo',
                                'compare' => '=',
                            ),
                        ),
                    )
                ),			
                // TEXTAREA
                array(
                    'name' => esc_html__( 'Observação', 'your-prefix' ),
                    'desc' => esc_html__( 'Digite a observação', 'your-prefix' ),
                    'id'   => "{$prefix}obs",
                    'type' => 'textarea',
                    'cols' => 20,
                    'rows' => 3,
                ),
                // TEXT
				array(
					'name' => 'Dominio',
					'id' => "{$prefix}dominio",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
			),
		);
        /*------------ Meta Box - INFORMACOES DE CONTA CONTABIL do post type CONTA CONTABIL ------------*/
		$prefix = RADICALFIN . '_conta_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_inf',
			'title' => 'Informacoes de Conta Contábil',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                // TEXT
				array(
					'name' => 'Nome',
					'id' => "{$prefix}nome",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXTAREA
                array(
                    'name' => __( 'Descriçao', 'meta-box' ),
                    'desc' => __( 'Descriçao', 'meta-box' ),
                    'id' => "{$prefix}descricao",
                    'type' => 'textarea',
                    'cols' => 20,
                    'rows' => 3,
                ),
            ),
		);
        /*------------ Meta Box - INFORMACOES DE TAXAS do post type TAXAS ------------*/
		$prefix = RADICALFIN . '_taxas_';
		
		$meta_boxes[] = array(
			'id' => $prefix . '_inf',
			'title' => 'Informacoes de Taxas',
			'pages' => array( substr($prefix, 0, -1) ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
                // TEXT
				array(
					'name' => 'Nome',
					'id' => "{$prefix}nome",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
                // TEXT
				array(
					'name' => 'Valor',
					'id' => "{$prefix}valor",
					'desc' => '',
					'clone' => false,
					'type' => 'text',
					'std'=> ''
				),
            ),
		);
    
    }
    add_action( 'init', 'create_'.RADICALFIN.'_meta_boxes' );
    
	if(!function_exists('create_'.RADICALFIN.'_validation')){
		function create_hn_fin_validation(){
			$temp = explode('/', $_SERVER['REQUEST_URI']);
			$temp2 = explode('?', $temp[count($temp)-1]);
			if($temp2[0] == 'post-new.php' || $temp2[0] == 'post.php'){
				if(isset($_REQUEST['post_type'])){
					$T_post_type = $_REQUEST['post_type'];
				}
				else if(isset($_REQUEST['post'])){
					$T_post_type = get_post_type($_REQUEST['post']);
				}
				else{
					$T_post_type = null;
				}
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery("#publish").prop('value', 'Salvar');
                        jQuery("#minor-publishing").hide();
                    });
                </script>
                <?php
                //VALICAÇAO PARA POST TYPE FINANCEIRO
				if(!is_null($T_post_type) && $T_post_type == RADICALFIN.'_financeiro'){
					?>
                    <script type="text/javascript">
                    jQuery(function($){
                       $("#hn_fin_financeiro_cep").change(function(){
                          var cep_code = $(this).val();
                          if( cep_code.length <= 0 ) return;
                          $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
                             function(result){
                                if( result.status!=1 ){
                                   alert(result.message || "Houve um erro desconhecido");
                                   return;
                                }
                                $("input#hn_fin_financeiro_cep").val( result.code );
                                $("input#hn_fin_financeiro_estado").val( result.state );
                                $("input#hn_fin_financeiro_cidade").val( result.city );
                                $("input#hn_fin_financeiro_bairro").val( result.district );
                                $("input#hn_fin_financeiro_endereco").val( result.address );
                                $("input#hn_fin_financeiro_estado").val( result.state );
                             });
                       });
                    });
                    </script>
					<script type="text/javascript">
						jQuery(document).ready(function(){
                            
                            //CEP AUTOMATICO
                            jQuery(function($){
                               $("#hn_fin_financeiro_cep").change(function(){
                                  var cep_code = $(this).val();
                                  if( cep_code.length <= 0 ) return;
                                  $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
                                     function(result){
                                        if( result.status!=1 ){
                                           alert(result.message || "Houve um erro desconhecido");
                                           return;
                                        }
                                        $("input#hn_fin_financeiro_cep").val( result.code );
                                        $("input#hn_fin_financeiro_estado").val( result.state );
                                        $("input#hn_fin_financeiro_cidade").val( result.city );
                                        $("input#hn_fin_financeiro_bairro").val( result.district );
                                        $("input#hn_fin_financeiro_endereco").val( result.address );
                                        $("input#hn_fin_financeiro_estado").val( result.state );
                                     });
                               });
                            });
                            //FIM CEP AUTOMATICO
                            
                            //SE CPF PREENCHER NOME DO CLIENTE AUTO
                            /*jQuery("#hn_fin_financeiro_nome" ).change(function() {
                                nome = jQuery("#hn_fin_financeiro_nome" ).val()
                                jQuery("#hn_fin_financeiro_nome_cliente").val(nome);
                            });*/
                            //FIM SE CPF PREENCHER NOME DO CLIETNE AUTO
                            
                            // MÁSCARAS DOS CAMPOS
                                //MASCARA CEP
                                jQuery("#hn_fin_financeiro_cep").keypress(function (e) {
                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                        return false;
                                    }else if(e.which != 8 && e.which != 0){
                                        if (jQuery("#hn_fin_financeiro_cep").val().length == 5){
                                            jQuery("#hn_fin_financeiro_cep").val(jQuery("#hn_fin_financeiro_cep").val()+"-")
                                        }
                                        if (jQuery("#hn_fin_financeiro_cep").val().length >= 9){
                                            return false;
                                        }
                                    }
                                });	
                                //FIM MASCARA CEP
                                //MASCARA TELEFONE/CELULAR
                                jQuery("#hn_fin_financeiro_telefone").keypress(function (e) {
                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_financeiro_telefone").val().length > 30)){
                                        return false;
                                    }
                                });
                                jQuery("#hn_fin_financeiro_celular").keypress(function (e) {
                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_financeiro_celular").val().length > 30)){
                                        return false;
                                    }
                                });
                                //FIM MASCARA TELEFONE/CELULAR
                                //MASCARA CNPJ
                                jQuery("#hn_fin_financeiro_cnpj").keypress(function (e) {
                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_financeiro_cnpj").val().length > 17)){
                                        return false;
                                    }else if (e.which != 8 && e.which != 0){
                                        if (jQuery("#hn_fin_financeiro_cnpj").val().length == 2){
                                            jQuery("#hn_fin_financeiro_cnpj").val(jQuery("#hn_fin_financeiro_cnpj").val()+".")
                                        }
                                        if (jQuery("#hn_fin_financeiro_cnpj").val().length == 6){
                                            jQuery("#hn_fin_financeiro_cnpj").val(jQuery("#hn_fin_financeiro_cnpj").val()+".")
                                        }
                                        if (jQuery("#hn_fin_financeiro_cnpj").val().length == 10){
                                            jQuery("#hn_fin_financeiro_cnpj").val(jQuery("#hn_fin_financeiro_cnpj").val()+"/")
                                        }
                                        if (jQuery("#hn_fin_financeiro_cnpj").val().length == 15){
                                            jQuery("#hn_fin_financeiro_cnpj").val(jQuery("#hn_fin_financeiro_cnpj").val()+"-")
                                        }
                                    }
                                });	
                                //FIM MASCARA CNPJ
                                //MASCARA CNPJ
                                jQuery("#hn_fin_financeiro_cpf").keypress(function (e) {
                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_financeiro_cpf").val().length > 13)){
                                        return false;
                                    }else if (e.which != 8 && e.which != 0){
                                        if (jQuery("#hn_fin_financeiro_cpf").val().length == 3){
                                            jQuery("#hn_fin_financeiro_cpf").val(jQuery("#hn_fin_financeiro_cpf").val()+".")
                                        }
                                        if (jQuery("#hn_fin_financeiro_cpf").val().length == 7){
                                            jQuery("#hn_fin_financeiro_cpf").val(jQuery("#hn_fin_financeiro_cpf").val()+".")
                                        }
                                        if (jQuery("#hn_fin_financeiro_cpf").val().length == 11){
                                            jQuery("#hn_fin_financeiro_cpf").val(jQuery("#hn_fin_financeiro_cpf").val()+"-")
                                        }
                                    }
                                });	
                                //FIM MASCARA CNPJ
                            // FIM MASCARA DOS CAMPOS
                            
                            //CAMPOS OBRIGATORIOS
                            jQuery("#hn_fin_financeiro_endereco").prop('required',true);
                            jQuery("#hn_fin_financeiro_cep").prop('required',true);
                            //jQuery("#hn_fin_financeiro_nome_cliente").prop('required',true);
                            jQuery("#hn_fin_financeiro_numero").prop('required',true);
                            //jQuery("#hn_fin_financeiro_telefone").prop('required',true);
                            //jQuery("#hn_fin_financeiro_celular").prop('required',true);
                            //jQuery("#hn_fin_financeiro_email").prop('required',true);
                            jQuery("#hn_fin_financeiro_conta_contabil").prop('required',true);
                            //jQuery("#hn_fin_financeiro_conta_contabil").prop('required',true);
                            
                            //FIM CAPOS OBRIGATORIOS
                            
                            jQuery("#hn_fin_financeiro_cpf").focusout(function() {
                                 var cpf = jQuery("#hn_fin_financeiro_cpf").val();
                                 jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                    ,{
                                        action: "hn_fin_consulta_cliente_cpf", 
                                        cpf: cpf
                                    }, function(data){
                                        var data2 = data;
                                        //jQuery("#hn_fin_insta_valor").val(data)
                                        if(data2 == "10"){
                                            alert("Cliente já cadastrado! Favor cadastrar outro cliente.")
                                            jQuery("#hn_fin_financeiro_cpf").val("");
                                        }
                                    }
                                );
                            });
                            jQuery("#hn_fin_financeiro_cnpj").focusout(function() {
                                 var cnpj = jQuery("#hn_fin_financeiro_cnpj").val();
                                 jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                    ,{
                                        action: "hn_fin_consulta_cliente_cnpj", 
                                        cnpj: cnpj
                                    }, function(data){
                                        var data2 = data;
                                        //jQuery("#hn_fin_insta_valor").val(data)
                                        if(data2 == "10"){
                                            alert("Cliente já cadastrado! Favor cadastrar outro cliente.")
                                            jQuery("#hn_fin_financeiro_cnpj").val("");
                                        }
                                    }
                                );
                            });
                            
                            
                            jQuery("#mymetabox_revslider_0").hide();
                            if(jQuery("input[name='hn_fin_financeiro_tipo_pessoa']").is(':checked')) { 
                               if(jQuery("input:radio[name='hn_fin_financeiro_tipo_pessoa']:checked").val() == "fisica"){
                                    jQuery("#hn_fin_financeiro_cpf").parent().parent().show();
                                    jQuery("#hn_fin_financeiro_nome").parent().parent().show();
                                    jQuery("#hn_fin_financeiro_cpf").prop('required',true);
                                    jQuery("#hn_fin_financeiro_nome").prop('required',true);
                                   
                                    jQuery("#hn_fin_financeiro_cnpj").parent().parent().hide();  
                                    jQuery("#hn_fin_financeiro_razao_social").parent().parent().hide();
                                    jQuery("#hn_fin_financeiro_nome_fantasia").parent().parent().hide();
                                    jQuery("#hn_fin_financeiro_cpf").prop('required',false);
                                    jQuery("#hn_fin_financeiro_nome").prop('required',false);
                                }
                                if (jQuery("input:radio[name='hn_fin_financeiro_tipo_pessoa']:checked").val() == "juridica"){
                                    jQuery("#hn_fin_financeiro_cpf").parent().parent().hide();
                                    jQuery("#hn_fin_financeiro_nome").parent().parent().hide();
                                    jQuery("#hn_fin_financeiro_cnpj").prop('required',false);
                                    jQuery("#hn_fin_financeiro_razao_social").prop('required',false);
                                    jQuery("#hn_fin_financeiro_nome_fantasia").prop('required',false);
                                    
                                    jQuery("#hn_fin_financeiro_cnpj").parent().parent().show();  
                                    jQuery("#hn_fin_financeiro_razao_social").parent().parent().show();
                                    jQuery("#hn_fin_financeiro_nome_fantasia").parent().parent().show();
                                    jQuery("#hn_fin_financeiro_cnpj").prop('required',true);
                                    jQuery("#hn_fin_financeiro_razao_social").prop('required',true);
                                    jQuery("#hn_fin_financeiro_nome_fantasia").prop('required',true);
                                }
                            }else{
                                //alert('naoselecionado')
                                jQuery("input:radio[name='hn_fin_financeiro_tipo_pessoa']").prop('required',true);
                                jQuery("#hn_fin_financeiro_email").parent().parent().hide();
                                //jQuery("#hn_fin_financeiro_email").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_cpf").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_nome").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_razao_social").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_nome_fantasia").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_cnpj").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_email").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_dominio").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_estado").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_cidade").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_bairro").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_endereco").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_cep").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_numero").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_complemento").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_nome_cliente").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_telefone").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_celular").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_conta_contabil").parent().parent().hide();
                                jQuery("label[for='hn_fin_financeiro_cat_cliente']").parent().parent().hide();
                                
                            }
                            /*if(jQuery("input:radio[name='hn_fin_financeiro_tipo_pessoa']:checked").val() == "fisica"){
                                jQuery("#hn_fin_financeiro_cpf").parent().parent().show();
                                jQuery("#hn_fin_financeiro_cnpj").parent().parent().hide();  
                                jQuery("#hn_fin_financeiro_razao_social").parent().parent().hide();
                            }
                            if (jQuery("input:radio[name='hn_fin_financeiro_tipo_pessoa']:checked").val() == "juridica"){
                                jQuery("#hn_fin_financeiro_cpf").parent().parent().hide();
                                jQuery("#hn_fin_financeiro_cnpj").parent().parent().show();  
                                jQuery("#hn_fin_financeiro_razao_social").parent().parent().show();
                            }
                            if(!jQuery("input[name='hn_fin_financeiro_tipo_pessoa']").is(':checked')) { 
                                jQuery("#hn_fin_financeiro_cnpj").parent().parent().hide();  
                                jQuery("#hn_fin_financeiro_razao_social").parent().parent().hide();  
                                jQuery("#hn_fin_financeiro_cpf").parent().parent().hide();  
                            }*/
                            jQuery("input[name='hn_fin_financeiro_tipo_pessoa']").on( "click", function(){
                                jQuery("#hn_fin_financeiro_email").parent().parent().show();
                                jQuery("#hn_fin_financeiro_dominio").parent().parent().show();
                                //jQuery("#hn_fin_financeiro_endereco").parent().parent().show();
                                jQuery("#hn_fin_financeiro_cep").parent().parent().show();
                                jQuery("#hn_fin_financeiro_numero").parent().parent().show();
                                jQuery("#hn_fin_financeiro_complemento").parent().parent().show();
                                jQuery("#hn_fin_financeiro_nome_cliente").parent().parent().show();
                                jQuery("#hn_fin_financeiro_telefone").parent().parent().show();
                                jQuery("#hn_fin_financeiro_celular").parent().parent().show();
                                jQuery("#hn_fin_financeiro_email").parent().parent().show();
                                jQuery("#hn_fin_financeiro_cat_cliente").parent().parent().show();
                                jQuery("#hn_fin_financeiro_estado").parent().parent().show();
                                jQuery("#hn_fin_financeiro_cidade").parent().parent().show();
                                jQuery("#hn_fin_financeiro_bairro").parent().parent().show();
                                jQuery("#hn_fin_financeiro_endereco").parent().parent().show();
                                jQuery("#hn_fin_financeiro_conta_contabil").parent().parent().show();
                                jQuery("label[for='hn_fin_financeiro_cat_cliente']").parent().parent().show();
                                
                                if(jQuery(this).val() == "fisica"){
                                    jQuery("#hn_fin_financeiro_cpf").parent().parent().show();
                                    jQuery("#hn_fin_financeiro_nome").parent().parent().show();
                                    jQuery("#hn_fin_financeiro_cpf").prop('required',true);
                                    jQuery("#hn_fin_financeiro_nome").prop('required',true);
                                    jQuery("#hn_fin_financeiro_cnpj").val(''); 
                                    jQuery("#hn_fin_financeiro_razao_social").val(''); 
                                    jQuery("#hn_fin_financeiro_nome_fantasia").val(''); 
                                    jQuery("#hn_fin_financeiro_cnpj").parent().parent().hide();  
                                    jQuery("#hn_fin_financeiro_razao_social").parent().parent().hide(); 
                                    jQuery("#hn_fin_financeiro_nome_fantasia").parent().parent().hide(); 
                                    jQuery("#hn_fin_financeiro_cnpj").prop('required',false);
                                    jQuery("#hn_fin_financeiro_razao_social").prop('required',false);
                                    jQuery("#hn_fin_financeiro_nome_fantasia").prop('required',false);
                                }
                                if(jQuery(this).val() == "juridica"){
                                    jQuery("#hn_fin_financeiro_cnpj").parent().parent().show();  
                                    jQuery("#hn_fin_financeiro_razao_social").parent().parent().show(); 
                                    jQuery("#hn_fin_financeiro_nome_fantasia").parent().parent().show(); 
                                    jQuery("#hn_fin_financeiro_cnpj").prop('required',true);
                                    jQuery("#hn_fin_financeiro_razao_social").prop('required',true);
                                    jQuery("#hn_fin_financeiro_nome_fantasia").prop('required',true);
                                    jQuery("#hn_fin_financeiro_cpf").val(''); 
                                    jQuery("#hn_fin_financeiro_nome").val('');
                                    jQuery("#hn_fin_financeiro_cpf").parent().parent().hide();   
                                    jQuery("#hn_fin_financeiro_nome").parent().parent().hide();
                                    jQuery("#hn_fin_financeiro_cpf").prop('required',false);
                                    jQuery("#hn_fin_financeiro_nome").prop('required',false);
                                }
                            });
						});
					</script>
					<?php
				}// FIM VALICAÇAO PARA POST TYPE FINANCEIRO/ENTIDADE
                // VALICAÇAO PARA POST TYPE SERVICOS
                if(!is_null($T_post_type) && $T_post_type == RADICALFIN . '_servicos'){
				?>
                    <script type="text/javascript" src="jquery.js"></script>
                    <script type="text/javascript" src="jprice.js"></script>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('#sbg_box').remove();
                            jQuery("#hn_fin_servicos_nome").prop('required',true);
                            jQuery("#hn_fin_servicos_categoria").prop('required',true);
                            //jQuery("#hn_fin_servicos_centro_lucro").prop('required',true);
                            //jQuery("#hn_fin_servicos_centro_custo").prop('required',true);
                            jQuery("#hn_fin_servicos_valor").prop('required',true);
                            jQuery("#hn_fin_servicos_categoria").prop('required',true);
                            jQuery("#hn_fin_servicos_valor").keypress(function (e) {
                                if (e.which != 8 && e.which != 0 && (e.which < 45 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_servicos_valor").val().length > 17)){
                                    return false;
                                }
                            });	
                            jQuery("input[name='hn_fin_servicos_receita_despesa']").on( "click", function(){
                                if(jQuery(this).val() == "receita"){
                                    //jQuery("#hn_fin_servicos_cat_servicos_lucro").parent().parent().show();
                                    //jQuery("#hn_fin_servicos_cat_servicos_custo").parent().parent().hide();
                                    jQuery("#hn_fin_servicos_centro_lucro").parent().parent().show();
                                    jQuery("#hn_fin_servicos_centro_custo").parent().parent().hide();
                                    jQuery("#hn_fin_servicos_centro_lucro").prop('required',true);
                                }else if(jQuery(this).val() == "despesa"){
                                    //jQuery("#hn_fin_servicos_cat_servicos_lucro").parent().parent().hide();
                                    //jQuery("#hn_fin_servicos_cat_servicos_custo").parent().parent().show();
                                    jQuery("#hn_fin_servicos_centro_lucro").parent().parent().hide();
                                    jQuery("#hn_fin_servicos_centro_custo").parent().parent().show();
                                    jQuery("#hn_fin_servicos_centro_custo").prop('required',true);
                                }
                            });
                            if(!jQuery("input[name='hn_fin_servicos_receita_despesa']").is(':checked')) { 
                                //jQuery("#hn_fin_servicos_cat_servicos_lucro").parent().parent().hide();
                                //jQuery("#hn_fin_servicos_cat_servicos_custo").parent().parent().hide();
                                    jQuery("#hn_fin_servicos_centro_lucro").parent().parent().hide();
                                    jQuery("#hn_fin_servicos_centro_custo").parent().parent().hide();
                            }else{
                                if(jQuery("input:radio[name='hn_fin_servicos_receita_despesa']:checked").val() == "receita"){
                                    //jQuery("#hn_fin_servicos_cat_servicos_lucro").parent().parent().show();
                                    //jQuery("#hn_fin_servicos_cat_servicos_custo").parent().parent().hide();
                                    jQuery("#hn_fin_servicos_centro_lucro").parent().parent().show();
                                    jQuery("#hn_fin_servicos_centro_custo").parent().parent().hide();
                                }
                                if(jQuery("input:radio[name='hn_fin_servicos_receita_despesa']:checked").val() == "despesa"){
                                    //jQuery("#hn_fin_servicos_cat_servicos_lucro").parent().parent().hide();
                                    //jQuery("#hn_fin_servicos_cat_servicos_custo").parent().parent().show();
                                    jQuery("#hn_fin_servicos_centro_lucro").parent().parent().hide();
                                    jQuery("#hn_fin_servicos_centro_custo").parent().parent().show();
                                }
                            }
						});
					</script>
				<?php
				}// FIM VALICAÇAO PARA POST TYPE SERVICOS
                // VALICAÇAO PARA POST TYPE CENTROS
                if(!is_null($T_post_type) && $T_post_type == RADICALFIN . '_centros'){
				?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('#sbg_box').remove();
                            jQuery("#hn_fin_centros_tipo_pessoa").prop('required',true);
                            jQuery("#hn_fin_centros_nome").prop('required',true);
                            jQuery("#hn_fin_centros_descricao").prop('required',true);
						});
					</script>
				<?php
				}// FIM VALICAÇAO PARA POST TYPE CENTROS
                // VALICAÇAO PARA POST TYPE CICLO
                if(!is_null($T_post_type) && $T_post_type == RADICALFIN . '_ciclo'){
				?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
                            //MASCARAS
                                //MASCARA DIA EMISSAO
                                jQuery("#hn_fin_ciclo_dia_emissao").keypress(function (e) {
                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_ciclo_dia_emissao").val().length > 27)){
                                        return false;
                                    }
                                });
                                //FIM MASCARA DIA EMISSAO
                                //MASCARA RECORRENCIA EM MESES
                                 jQuery("#hn_fin_ciclo_recorrencia_meses").keypress(function (e) {
                                    //alert(jQuery("#hn_fin_ciclo_recorrencia_meses").val())
                                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
                                        return false;
                                    }
                                });
                                //FIM MASCARA RECORRENCIA EM MESES
                            //FIM MASCARAS
							jQuery('#sbg_box').remove();
                            jQuery("#hn_fin_ciclo_nome").prop('required',true);
                            jQuery("#hn_fin_ciclo_dia_emissao").prop('required',true);
                            jQuery("#hn_fin_ciclo_recorrencia_meses").prop('required',true);
						});
					</script>
				<?php
				}// FIM VALICAÇAO PARA POST TYPE CICLO
                // VALICAÇAO PARA POST TYPE INSTANCIA SERVICO
                if(!is_null($T_post_type) && $T_post_type == RADICALFIN . '_insta'){
				?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('#sbg_box').remove();
                            jQuery("#hn_fin_insta_cliente").prop('required',true);
                            jQuery("#hn_fin_insta_servico").prop('required',true);
                            jQuery("#hn_fin_insta_dominio").prop('required',true);
                            jQuery("#hn_fin_insta_valor").prop('required',true);
                            jQuery("#hn_fin_insta_ciclo").prop('required',true);
                            jQuery("#hn_fin_insta_data_inicio").prop('required',true);
                            jQuery("#hn_fin_insta_valor").keypress(function (e) {
                                if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_insta_valor").val().length > 27)){
                                    return false;
                                }
                            });
                            jQuery("#hn_fin_insta_valor_entrada").keypress(function (e) {
                                if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_insta_valor_entrada").val().length > 27)){
                                    return false;
                                }
                            });
                            jQuery("input[name='hn_fin_insta_receita_despesa']").prop('required', true);
                            //jQuery("#hn_fin_insta_data_fim").prop('required',true);
                            jQuery("#hn_fin_insta_servico" ).change(function() {
                                var id = jQuery("#hn_fin_insta_servico" ).val();
                                jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                    ,{
                                        action: "hn_fin_valor_servico", 
                                        id: id
                                    }, function(data){
                                        jQuery("#hn_fin_insta_valor").val(data)
                                    }
                                );
                            });
						});
					</script>
				<?php
				}// FIM VALICAÇAO PARA POST TYPE INSTANCIA SERVICO
                // VALICAÇAO PARA POST TYPE LANCAMENTOS
                if(!is_null($T_post_type) && $T_post_type == RADICALFIN . '_lanca'){
				?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('#sbg_box').remove();
                            //jQuery("#hn_fin_lanca_favorecido").prop('required',true);
                            //jQuery("#hn_fin_lanca_servico").prop('required',true);
                            //jQuery("#hn_fin_lanca_empresa").prop('required',true);
                            //jQuery("#hn_fin_lanca_valor").prop('required',true);
                            //jQuery("#hn_fin_lanca_data").prop('required',true);
                            //jQuery("#hn_fin_lanca_nota_fiscal").prop('required',true);
                            //jQuery("#hn_fin_lanca_valor").prop('required',true);
                            //jQuery("#hn_fin_lanca_baixa").prop('required',true);
                            //jQuery("#hn_fin_lanca_parcela").prop('required',true);
                            //alert('a')
                            if(jQuery("input[name='hn_fin_lanca_tipo_lancamento']").is(':checked')) { 
                                if(jQuery("input:radio[name='hn_fin_lanca_tipo_lancamento']:checked").val() == "receita"){
                                    jQuery("#hn_fin_lanca_centro_lucro").parent().parent().show();
                                    jQuery("#hn_fin_lanca_centro_custo").parent().parent().hide();
                                    //jQuery("#hn_fin_lanca_centro_lucro").prop('required',true);
                                    //jQuery("#hn_fin_lanca_centro_custo").prop('required',false);
                                    
                                    
                                    jQuery("#hn_fin_lanca_favorecido").parent().parent().show();
                                    jQuery("#hn_fin_lanca_servico").parent().parent().show();
                                    jQuery("#hn_fin_lanca_empresa").parent().parent().show();
                                    jQuery("#hn_fin_lanca_data").parent().parent().show();
                                    jQuery("#hn_fin_lanca_valor").parent().parent().show();
                                    jQuery("#hn_fin_lanca_nota_fiscal").parent().parent().show();
                                    jQuery("#hn_fin_lanca_baixa").parent().parent().show();
                                    jQuery("#hn_fin_lanca_parcela").parent().parent().show();
                                    jQuery("#hn_fin_lanca_data_cobranca").parent().parent().show();
                                    jQuery("#hn_fin_lanca_contabil").parent().parent().show();
                                    jQuery("#hn_fin_lanca_taxas").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_item_servico']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_baixa']").parent().parent().show();
                                    jQuery("#hn_fin_lanca_dominio").parent().parent().show();
                                    jQuery("#hn_fin_lanca_centro_lucro").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_obs']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_data_vencimento']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_data_arrecadacao']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_pdf']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_valor_multa']").parent().parent().show();
                                    
                                    jQuery("label[for='hn_fin_lanca_obs']").parent().parent().hide();
                                    jQuery("#hn_fin_lanca_centro_custo").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_favorecido']").html("Favorecido");
                                    jQuery("label[for='hn_fin_lanca_empresa']").html("Empresa");
                                    jQuery("label[for='hn_fin_lanca_data_arrecadacao']").html("Data Arrecadação");
                                }
                                if(jQuery("input:radio[name='hn_fin_lanca_tipo_lancamento']:checked").val() == "despesa"){
                                    jQuery("#hn_fin_lanca_favorecido").parent().parent().show();
                                    jQuery("#hn_fin_lanca_servico").parent().parent().show();
                                    jQuery("#hn_fin_lanca_empresa").parent().parent().show();
                                    //jQuery("#hn_fin_lanca_item_sevico").parent().parent().show();
                                    jQuery("#hn_fin_lanca_data").parent().parent().show();
                                    jQuery("#hn_fin_lanca_valor").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_servico']").parent().parent().show();
                                    //jQuery("#hn_fin_lanca_nota_fiscal").parent().parent().show();
                                    //jQuery("#hn_fin_lanca_baixa").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_item_servico']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_baixa']").parent().parent().show();
                                    jQuery("#hn_fin_lanca_centro_lucro").parent().parent().hide();
                                    jQuery("#hn_fin_lanca_centro_custo").parent().parent().show();
                                    //jQuery("#hn_fin_lanca_centro_lucro").prop('required',false);
                                    //jQuery("#hn_fin_lanca_centro_custo").prop('required',true);
                                    jQuery("#hn_fin_lanca_centro_lucro").parent().parent().hide();
                                    
                                    
                                    
                                    jQuery("label[for='hn_fin_lanca_item_servico']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_parcela']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_nota_fiscal']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_data_cobranca']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_taxas']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_dominio']").parent().parent().hide();
                                    
                                    jQuery("label[for='hn_fin_lanca_obs']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_favorecido']").html("Empresa");
                                    jQuery("label[for='hn_fin_lanca_empresa']").html("Fornecedor");
                                    jQuery("label[for='hn_fin_lanca_data_arrecadacao']").html("Data Pagamento");
                                }
                            }else{
                                jQuery("#hn_fin_lanca_favorecido").parent().parent().hide();
                                jQuery("#hn_fin_lanca_servico").parent().parent().hide();
                                jQuery("#hn_fin_lanca_empresa").parent().parent().hide();
                                jQuery("#hn_fin_lanca_data").parent().parent().hide();
                                jQuery("#hn_fin_lanca_valor").parent().parent().hide();
                                jQuery("#hn_fin_lanca_nota_fiscal").parent().parent().hide();
                                jQuery("#hn_fin_lanca_baixa").parent().parent().hide();
                                jQuery("#hn_fin_lanca_parcela").parent().parent().hide();
                                jQuery("#hn_fin_lanca_data_cobranca").parent().parent().hide();
                                jQuery("#hn_fin_lanca_contabil").parent().parent().hide();
                                jQuery("#hn_fin_lanca_taxas").parent().parent().hide();
                                jQuery("label[for='hn_fin_lanca_item_servico']").parent().parent().hide();
                                jQuery("label[for='hn_fin_lanca_baixa']").parent().parent().hide();
                                jQuery("#hn_fin_lanca_dominio").parent().parent().hide();
                                jQuery("#hn_fin_lanca_centro_lucro").parent().parent().hide();
                                jQuery("#hn_fin_lanca_centro_custo").parent().parent().hide();
                                jQuery("label[for='hn_fin_lanca_obs']").parent().parent().hide();
                                //jQuery("#hn_fin_lanca_centro_lucro").prop('required',false);
                                //jQuery("#hn_fin_lanca_centro_custo").prop('required',false);
                                jQuery("label[for='hn_fin_lanca_data_vencimento']").parent().parent().hide();
                                jQuery("label[for='hn_fin_lanca_data_arrecadacao']").parent().parent().hide();
                                jQuery("label[for='hn_fin_lanca_pdf']").parent().parent().hide();
                                jQuery("label[for='hn_fin_lanca_valor_multa']").parent().parent().hide();
                            }
                            jQuery("input[name='hn_fin_lanca_tipo_lancamento']").on( "click", function(){
                                if(jQuery(this).val() == "receita"){
                                    jQuery("#hn_fin_lanca_centro_lucro").parent().parent().show();
                                    jQuery("#hn_fin_lanca_centro_custo").parent().parent().hide();
                                    //jQuery("#hn_fin_lanca_centro_lucro").prop('required',true);
                                    //jQuery("#hn_fin_lanca_centro_custo").prop('required',false);
                                    
                                    
                                    jQuery("#hn_fin_lanca_favorecido").parent().parent().show();
                                    jQuery("#hn_fin_lanca_servico").parent().parent().show();
                                    jQuery("#hn_fin_lanca_empresa").parent().parent().show();
                                    jQuery("#hn_fin_lanca_data").parent().parent().show();
                                    jQuery("#hn_fin_lanca_valor").parent().parent().show();
                                    jQuery("#hn_fin_lanca_nota_fiscal").parent().parent().show();
                                    jQuery("#hn_fin_lanca_baixa").parent().parent().show();
                                    jQuery("#hn_fin_lanca_parcela").parent().parent().show();
                                    jQuery("#hn_fin_lanca_data_cobranca").parent().parent().show();
                                    jQuery("#hn_fin_lanca_contabil").parent().parent().show();
                                    jQuery("#hn_fin_lanca_taxas").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_item_servico']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_baixa']").parent().parent().show();
                                    jQuery("#hn_fin_lanca_dominio").parent().parent().show();
                                    jQuery("#hn_fin_lanca_centro_lucro").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_obs']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_data_vencimento']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_data_arrecadacao']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_pdf']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_valor_multa']").parent().parent().show();
                                    
                                    jQuery("label[for='hn_fin_lanca_obs']").parent().parent().hide();
                                    jQuery("#hn_fin_lanca_centro_custo").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_favorecido']").html("Favorecido");
                                    jQuery("label[for='hn_fin_lanca_empresa']").html("Empresa");
                                    jQuery("label[for='hn_fin_lanca_data_arrecadacao']").html("Data Arrecadação");
                                }if(jQuery(this).val() == "despesa"){
                                    jQuery("#hn_fin_lanca_favorecido").parent().parent().show();
                                    jQuery("#hn_fin_lanca_servico").parent().parent().show();
                                    jQuery("#hn_fin_lanca_empresa").parent().parent().show();
                                    jQuery("#hn_fin_lanca_data").parent().parent().show();
                                    jQuery("#hn_fin_lanca_valor").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_item_servico']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_baixa']").parent().parent().show();
                                    jQuery("#hn_fin_lanca_centro_lucro").parent().parent().hide();
                                    jQuery("#hn_fin_lanca_centro_custo").parent().parent().show();
                                    //jQuery("#hn_fin_lanca_centro_lucro").prop('required',false);
                                    //jQuery("#hn_fin_lanca_centro_custo").prop('required',true);
                                    
                                    jQuery("label[for='hn_fin_lanca_data_vencimento']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_data_arrecadacao']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_pdf']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_data']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_valor_multa']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_contabil']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_servico']").parent().parent().show();
                                    
                                    
                                    
                                    jQuery("label[for='hn_fin_lanca_item_servico']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_parcela']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_nota_fiscal']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_data_cobranca']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_taxas']").parent().parent().hide();
                                    jQuery("label[for='hn_fin_lanca_dominio']").parent().parent().hide();
                                    
                                    jQuery("label[for='hn_fin_lanca_obs']").parent().parent().show();
                                    jQuery("label[for='hn_fin_lanca_favorecido']").html("Empresa");
                                    jQuery("label[for='hn_fin_lanca_empresa']").html("Fornecedor");
                                    jQuery("label[for='hn_fin_lanca_data_arrecadacao']").html("Data Pagamento");
                                }
                            });
                            jQuery("#hn_fin_lanca_valor").keypress(function (e) {
                                if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57) || (e.which != 8 && e.which != 0 && jQuery("#hn_fin_lanca_valor").val().length > 27)){
                                    return false;
                                }
                            });
						});
					</script>
				<?php
				}// FIM VALICAÇAO PARA POST TYPE LANCAMENTOS
			}
		}
	}
	add_action( 'admin_footer', 'create_'.RADICALFIN.'_validation' );
    if(!function_exists('register_'.RADICALFIN.'_meta_boxes')){
		function register_hn_fin_meta_boxes(){
			global $meta_boxes;
			global $ckurlt;
			global $ckurl;
			$ckurlt = explode('/', $_SERVER['REQUEST_URI']);
			$ckurl = explode('?', $ckurlt[count($ckurlt)-1]);
			if ( class_exists( 'RW_Meta_Box' ) ){
				foreach( $meta_boxes as $meta_box ){
					new RW_Meta_Box( $meta_box );
				}
			}
		}
		add_action( 'admin_init', 'register_'.RADICALFIN.'_meta_boxes' );
    }
}else{
    die("função create_".RADICALFIN."_meta_boxes já existe");
}
?>
