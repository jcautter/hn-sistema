<?php
$arr = $_POST; //you need to grab the data via the POST (or request) global.
//this is just a check to show that the SQL statement is correct. Replace with your mysql connection/quer
if(!function_exists("hn_fin_relatorio_conta_contabil")){
    function hn_fin_relatorio_conta_contabil(){
        $batata = $_REQUEST['batata'];
        if($batata == "frita"){
            $args = array(
                'post_type' => 'hn_fin_conta',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $query = null;
            $query = new WP_Query($args);
            $lista = array();        
            foreach($query->posts as $item){
                $id = $item->ID;
                $meta = get_post_meta($id);
                
                $lista[] = $meta;
            }
            //$array = array_unique (array_merge ($array1, $array2));
            $cabecalho = array();
            $cabecalho_pre = array();
            foreach($lista as $linha){
                $cabecalho_pre = array();
                foreach($linha as $header => $coluna){
                    $cabecalho_pre[] = $header;
                }
                $cabecalho = array_unique (array_merge ($cabecalho, $cabecalho_pre));
            }
            echo "<table>";
            echo "<tr>";
            foreach($cabecalho as $cabeca){
                echo "<td>";
                echo $cabeca;
                echo "</td>";
            }
            
            echo "</tr>";
            foreach($lista as $linha){
                echo "<tr>";
                foreach($cabecalho as $cabeca){
                    echo "<td>";
                    if( isset($linha[$cabeca]) ){
                        echo $linha[$cabeca][0];
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            die();
        }
     }
}
add_action('wp_ajax_hn_fin_relatorio_conta_contabil', 'hn_fin_relatorio_conta_contabil', 1);
add_action('wp_ajax_nopriv_hn_fin_relatorio_conta_contabil', 'hn_fin_relatorio_conta_contabil', 1);

if(!function_exists("hn_fin_relatorio_centros")){
    function hn_fin_relatorio_centros(){
        $naosei = $_REQUEST['naosei'];
        if($naosei == "seisim"){
            $args = array(
                'post_type' => 'hn_fin_centros',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $query = null;
            $query = new WP_Query($args);
            $lista = array();        
            foreach($query->posts as $item){
                $id = $item->ID;
                $meta = get_post_meta($id);
                
                $lista[] = $meta;
            }
            //$array = array_unique (array_merge ($array1, $array2));
            $cabecalho = array();
            $cabecalho_pre = array();
            foreach($lista as $linha){
                $cabecalho_pre = array();
                foreach($linha as $header => $coluna){
                    $cabecalho_pre[] = $header;
                }
                $cabecalho = array_unique (array_merge ($cabecalho, $cabecalho_pre));
            }
            echo "<table>";
            echo "<tr>";
            foreach($cabecalho as $cabeca){
                echo "<td>";
                echo $cabeca;
                echo "</td>";
            }
            
            echo "</tr>";
            foreach($lista as $linha){
                echo "<tr>";
                foreach($cabecalho as $cabeca){
                    echo "<td>";
                    if( isset($linha[$cabeca]) ){
                        echo $linha[$cabeca][0];
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            die();
        }
     }
}
add_action('wp_ajax_hn_fin_relatorio_centros', 'hn_fin_relatorio_centros', 1);
add_action('wp_ajax_nopriv_hn_fin_relatorio_centros', 'hn_fin_relatorio_centros', 1);

if(!function_exists("hn_fin_relatorio_lancamento")){
    function hn_fin_relatorio_lancamento(){
        $leoburro = $_REQUEST['leoburro'];
        if($leoburro == "caochupandomanga"){
            $args = array(
                'post_type' => 'hn_fin_lanca',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $query = null;
            $query = new WP_Query($args);
            $lista = array();        
            foreach($query->posts as $item){
                $id = $item->ID;
                $meta = get_post_meta($id);
                if(get_post_meta($meta['hn_fin_lanca_favorecido'][0], 'hn_fin_financeiro_tipo_pessoa', 1) == "fisica" ){
                    $meta['hn_fin_lanca_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_lanca_favorecido'][0], 'hn_fin_financeiro_cpf', 1) );
                    $meta['hn_fin_lanca_favorecido_nome'] = array( get_post_meta($meta['hn_fin_lanca_favorecido'][0], 'hn_fin_financeiro_nome', 1) );
                }else{
                    $meta['hn_fin_lanca_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_lanca_favorecido'][0], 'hn_fin_financeiro_cnpj', 1) );
                    $meta['hn_fin_lanca_favorecido_nome'] = array( get_post_meta($meta['hn_fin_lanca_favorecido'][0], 'hn_fin_financeiro_razao_social', 1) );
                }
                $meta['hn_fin_lanca_servico_nome'] = array( get_post_meta($meta['hn_fin_lanca_servico'][0], 'hn_fin_servicos_nome', 1) );
                $id_ciclo = get_post_meta($meta['hn_fin_lanca_item_servico'][0], 'hn_fin_insta_ciclo', 1);
                $meta['hn_fin_lanca_ciclo'] = array( get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1) );
                if(get_post_meta($meta['hn_fin_lanca_empresa'][0], 'hn_fin_financeiro_tipo_pessoa', 1) == "fisica" ){
                     $meta['hn_fin_lanca_empresa_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_lanca_empresa'][0], 'hn_fin_financeiro_cpf', 1) );
                    $meta['hn_fin_lanca_empresa_nome'] = array( get_post_meta($meta['hn_fin_lanca_empresa'][0], 'hn_fin_financeiro_nome', 1) );      
                }else{
                    $meta['hn_fin_lanca_empresa_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_lanca_empresa'][0], 'hn_fin_financeiro_cnpj', 1) );
                    $meta['hn_fin_lanca_empresa_nome'] = array( get_post_meta($meta['hn_fin_lanca_empresa'][0], 'hn_fin_financeiro_razao_social', 1) );
                }
                $conta_contabil = explode('"', $meta['hn_fin_lanca_contabil'][0]);
                $conta_contabil = $conta_contabil[1];
                $meta['hn_fin_conta_contabil_nome'] = array( get_post_meta($conta_contabil, 'hn_fin_conta_nome', 1) );
                $meta['hn_fin_conta_contabil_desc'] = array( get_post_meta($conta_contabil, 'hn_fin_conta_descricao', 1) );
                if( isset($meta['hn_fin_lanca_centro_lucro']) ){
                    $meta['hn_fin_lanca_centro_lucro_nome'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_nome', 1) );
                    $meta['hn_fin_lanca_centro_lucro_descricao'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_descricao', 1) );
                }
                if( isset($meta['hn_fin_lanca_centro_custo']) ){
                    $meta['hn_fin_lanca_centro_custo_nome'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_nome', 1) );
                    $meta['hn_fin_lanca_centro_custo_descricao'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_descricao', 1) );
                }
                //$conta_contabil = explode('"', $meta['hn_fin_lanca_contabil'][0]);
                $emissao_mes_ano = explode("-", $meta['hn_fin_lanca_data'][0]);
                $meta['hn_fin_emissao_mes'] = array( $emissao_mes_ano[1] );
                $meta['hn_fin_emissao_ano'] = array( $emissao_mes_ano[0] );
                $vencimento_mes_ano = explode("-", $meta['hn_fin_lanca_data_vencimento'][0]);
                $meta['hn_fin_vencimento_mes'] = array( $vencimento_mes_ano[1] );
                $meta['hn_fin_vencimento_ano'] = array( $vencimento_mes_ano[0] );
                $lista[] = $meta;
            }
            //$array = array_unique (array_merge ($array1, $array2));
            $cabecalho = array();
            $cabecalho_pre = array();
            foreach($lista as $linha){
                $cabecalho_pre = array();
                foreach($linha as $header => $coluna){
                    $cabecalho_pre[] = $header;
                }
                $cabecalho = array_unique (array_merge ($cabecalho, $cabecalho_pre));
            }
            echo "<table>";
            echo "<tr>";
            foreach($cabecalho as $cabeca){
                echo "<td>";
                echo $cabeca;
                echo "</td>";
            }
            
            echo "</tr>";
            foreach($lista as $linha){
                echo "<tr>";
                foreach($cabecalho as $cabeca){
                    echo "<td>";
                    if( isset($linha[$cabeca]) ){
                        echo $linha[$cabeca][0];
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            die();
        }
     }
}
add_action('wp_ajax_hn_fin_relatorio_lancamento', 'hn_fin_relatorio_lancamento', 1);
add_action('wp_ajax_nopriv_hn_fin_relatorio_lancamento', 'hn_fin_relatorio_lancamento', 1);

if(!function_exists("hn_fin_relatorio_instancia")){
    function hn_fin_relatorio_instancia(){
        $danielburro = $_REQUEST['danielburro'];
        if($danielburro == "gostodemcdonalds"){
            $args = array(
                'post_type' => 'hn_fin_insta',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $query = null;
            $query = new WP_Query($args);
            $lista = array();        
            foreach($query->posts as $item){
                $id = $item->ID;
                $meta = get_post_meta($id);
                
                if(get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_tipo_pessoa', 1) == "fisica" ){
                    $meta['hn_fin_insta_emissor_nota_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_cpf', 1) );
                    $meta['hn_fin_insta_emissor_nota_nome'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_nome', 1) );
                }else{
                    $meta['hn_fin_insta_emissor_nota_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_cnpj', 1) );
                    $meta['hn_fin_insta_emissor_nota_nome'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_razao_social', 1) );
                }
                $meta['hn_fin_insta_servico_nome'] = array( get_post_meta($meta['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1) );
                $id_ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 1);
                $meta['hn_fin_insta_ciclo_nome'] = array( get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1) );
                if(get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_tipo_pessoa', 1) == "fisica" ){
                     $meta['hn_fin_insta_cliente_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_cpf', 1) );
                    $meta['hn_fin_insta_cliente_nome'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_nome', 1) );      
                }else{
                    $meta['hn_fin_insta_cliente_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_cnpj', 1) );
                    $meta['hn_fin_insta_cliente_nome'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_razao_social', 1) );
                }
                $conta_contabil = explode('"', $meta['hn_fin_lanca_contabil'][0]);
                $conta_contabil = $conta_contabil[1];
                $meta['hn_fin_conta_contabil_nome'] = array( get_post_meta($conta_contabil, 'hn_fin_conta_nome', 1) );
                $meta['hn_fin_conta_contabil_desc'] = array( get_post_meta($conta_contabil, 'hn_fin_conta_descricao', 1) );
                if( isset($meta['hn_fin_lanca_centro_lucro']) ){
                    $meta['hn_fin_lanca_centro_lucro_nome'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_nome', 1) );
                    $meta['hn_fin_lanca_centro_lucro_descricao'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_descricao', 1) );
                }
                if( isset($meta['hn_fin_lanca_centro_custo']) ){
                    $meta['hn_fin_lanca_centro_custo_nome'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_nome', 1) );
                    $meta['hn_fin_lanca_centro_custo_descricao'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_descricao', 1) );
                }
                $lista[] = $meta;
            }
            //$array = array_unique (array_merge ($array1, $array2));
            $cabecalho = array();
            $cabecalho_pre = array();
            foreach($lista as $linha){
                $cabecalho_pre = array();
                foreach($linha as $header => $coluna){
                    $cabecalho_pre[] = $header;
                }
                $cabecalho = array_unique (array_merge ($cabecalho, $cabecalho_pre));
            }
            echo "<table>";
            echo "<tr>";
            foreach($cabecalho as $cabeca){
                echo "<td>";
                echo $cabeca;
                echo "</td>";
            }
            
            echo "</tr>";
            foreach($lista as $linha){
                echo "<tr>";
                foreach($cabecalho as $cabeca){
                    echo "<td>";
                    if( isset($linha[$cabeca]) ){
                        echo $linha[$cabeca][0];
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            die();
        }
     }
}
add_action('wp_ajax_hn_fin_relatorio_instancia', 'hn_fin_relatorio_instancia', 1);
add_action('wp_ajax_nopriv_hn_fin_relatorio_instancia', 'hn_fin_relatorio_instancia', 1);


if(!function_exists("hn_fin_relatorio_clientes")){
    function hn_fin_relatorio_clientes(){
        $juburro = $_REQUEST['juburro'];
        if($juburro == "jura"){
            $args = array(
                'post_type' => 'hn_fin_financeiro',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
            $query = null;
            $query = new WP_Query($args);
            $lista = array();        
            foreach($query->posts as $item){
                $id = $item->ID;
                $meta = get_post_meta($id);
                $meta['hn_fin_conta_contabil_nome'] = array( get_post_meta($meta['hn_fin_financeiro_conta_contabil'][0], 'hn_fin_conta_nome', 1) );
                $meta['hn_fin_conta_contabil_descricao'] = array( get_post_meta($meta['hn_fin_financeiro_conta_contabil'][0], 'hn_fin_conta_descricao', 1) );
                
                $terms = get_the_terms( $id, 'hn_fin_txy_cat_cliente' );
                         
                if ( $terms && ! is_wp_error( $terms ) ) { 

                    $draught_links = array();

                    foreach ( $terms as $term ) {
                        $draught_links[] = $term->name;
                    }

                    $on_draught = join( ", ", $draught_links );
                    $categoria = $on_draught;
                }
                $meta['hn_fin_financeiro_categoria'] = array ( $categoria );
                
                /*if(get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_tipo_pessoa', 1) == "fisica" ){
                    $meta['hn_fin_insta_emissor_nota_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_cpf', 1) );
                    $meta['hn_fin_insta_emissor_nota_nome'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_nome', 1) );
                }else{
                    $meta['hn_fin_insta_emissor_nota_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_cnpj', 1) );
                    $meta['hn_fin_insta_emissor_nota_nome'] = array( get_post_meta($meta['hn_fin_insta_emissor_nota'][0], 'hn_fin_financeiro_razao_social', 1) );
                }
                $meta['hn_fin_insta_servico_nome'] = array( get_post_meta($meta['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1) );
                $id_ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 1);
                $meta['hn_fin_insta_ciclo_nome'] = array( get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1) );
                if(get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_tipo_pessoa', 1) == "fisica" ){
                     $meta['hn_fin_insta_cliente_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_cpf', 1) );
                    $meta['hn_fin_insta_cliente_nome'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_nome', 1) );      
                }else{
                    $meta['hn_fin_insta_cliente_cnpj_cpf'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_cnpj', 1) );
                    $meta['hn_fin_insta_cliente_nome'] = array( get_post_meta($meta['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_razao_social', 1) );
                }
                $conta_contabil = explode('"', $meta['hn_fin_lanca_contabil'][0]);
                $conta_contabil = $conta_contabil[1];
                $meta['hn_fin_conta_contabil_nome'] = array( get_post_meta($conta_contabil, 'hn_fin_conta_nome', 1) );
                $meta['hn_fin_conta_contabil_desc'] = array( get_post_meta($conta_contabil, 'hn_fin_conta_descricao', 1) );
                if( isset($meta['hn_fin_lanca_centro_lucro']) ){
                    $meta['hn_fin_lanca_centro_lucro_nome'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_nome', 1) );
                    $meta['hn_fin_lanca_centro_lucro_descricao'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_descricao', 1) );
                }
                if( isset($meta['hn_fin_lanca_centro_custo']) ){
                    $meta['hn_fin_lanca_centro_custo_nome'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_nome', 1) );
                    $meta['hn_fin_lanca_centro_custo_descricao'] = array( get_post_meta($meta['hn_fin_lanca_centro_lucro'][0], 'hn_fin_centros_descricao', 1) );
                }*/
                $lista[] = $meta;
            }
            //$array = array_unique (array_merge ($array1, $array2));
            $cabecalho = array();
            $cabecalho_pre = array();
            foreach($lista as $linha){
                $cabecalho_pre = array();
                foreach($linha as $header => $coluna){
                    $cabecalho_pre[] = $header;
                }
                $cabecalho = array_unique (array_merge ($cabecalho, $cabecalho_pre));
            }
            echo "<table>";
            echo "<tr>";
            foreach($cabecalho as $cabeca){
                echo "<td>";
                echo $cabeca;
                echo "</td>";
            }
            
            echo "</tr>";
            foreach($lista as $linha){
                echo "<tr>";
                foreach($cabecalho as $cabeca){
                    echo "<td>";
                    if( isset($linha[$cabeca]) ){
                        echo $linha[$cabeca][0];
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            die();
        }
     }
}
add_action('wp_ajax_hn_fin_relatorio_clientes', 'hn_fin_relatorio_clientes', 1);
add_action('wp_ajax_nopriv_hn_fin_relatorio_clientes', 'hn_fin_relatorio_clientes', 1);


if(!function_exists("hn_fin_info_cliente")){
    function hn_fin_info_cliente(){
        $id = $_REQUEST['id'];
        $nome = get_post_meta($id, 'hn_fin_financeiro_nome', 1);
        if(empty($nome)){
            $nome = get_post_meta($id, 'hn_fin_financeiro_razao_social', 1);
        }
        $identificador = get_post_meta($id, 'hn_fin_financeiro_cpf', 1);
        if(empty($identificador)){
            $identificador = get_post_meta($id, 'hn_fin_financeiro_cnpj', 1);
        }
        $rua = get_post_meta($id, 'hn_fin_financeiro_endereco', 1);
        $numero_endereco = get_post_meta($id, 'hn_fin_financeiro_numero', 1);
        $bairro = get_post_meta($id, 'hn_fin_financeiro_bairro', 1);
        $cidade = get_post_meta($id, 'hn_fin_financeiro_cidade', 1);
        $estado = get_post_meta($id, 'hn_fin_financeiro_estado', 1);
        $cep = get_post_meta($id, 'hn_fin_financeiro_cep', 1);
        $nome = $nome . " - " . $identificador;
        $endereco1 = $rua . " - " . $numero_endereco;
        $endereco2 = $bairro . " - " . $cidade . " - " . $estado . " - " . $cep;
        $dados = array();
        $dados['nome'] = (string) $nome;
        //$dados['identificador'] = (string) $identificador;
        $dados['endereco1'] = (string) $endereco1;
        $dados['endereco2'] = (string) $endereco2;
        //print_r($dados);
        echo json_encode($dados);
        
        die();
     }
}
add_action('wp_ajax_hn_fin_info_cliente', 'hn_fin_info_cliente', 1);
add_action('wp_ajax_nopriv_hn_fin_info_cliente', 'hn_fin_info_cliente', 1);
if(!function_exists("hn_fin_consulta_cliente_cpf")){
    function hn_fin_consulta_cliente_cpf(){
        $cpf = $_REQUEST["cpf"];
        $args = array(
            'nopaging' => true,
            'post_type' => 'hn_fin_financeiro',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key'     => 'hn_fin_financeiro_cpf',
                    'value'   => $cpf,
                    'compare' => '=',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        if(count($lista) > "0"){
            $flag = "1";
        }else{
            $flag = "0";   
        }
        echo $flag;
    }
}
add_action('wp_ajax_hn_fin_consulta_cliente_cpf', 'hn_fin_consulta_cliente_cpf', 1);
add_action('wp_ajax_nopriv_hn_fin_consulta_cliente_cpf', 'hn_fin_consulta_cliente_cpf', 1);

if(!function_exists("hn_fin_consulta_cliente_cnpj")){
    function hn_fin_consulta_cliente_cnpj(){
        $cnpj = $_REQUEST["cnpj"];
        $args = array(
            'nopaging' => true,
            'post_type' => 'hn_fin_financeiro',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key'     => 'hn_fin_financeiro_cnpj',
                    'value'   => $cnpj,
                    'compare' => '=',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        if(count($lista) > "0"){
            $flag = "1";
        }else{
            $flag = "0";   
        }
        echo $flag;
    }
}
add_action('wp_ajax_hn_fin_consulta_cliente_cnpj', 'hn_fin_consulta_cliente_cnpj', 1);
add_action('wp_ajax_nopriv_hn_fin_consulta_cliente_cnpj', 'hn_fin_consulta_cliente_cnpj', 1);

if(!function_exists("hn_fin_valor_servico")){
    function hn_fin_valor_servico(){
        $id = $_REQUEST['id'];
        $id2 = get_post_meta( $id, 'hn_fin_servicos_valor', true );
        echo $id2;
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_valor_servico', 'hn_fin_valor_servico', 1);
add_action('wp_ajax_nopriv_hn_fin_valor_servico', 'hn_fin_valor_servico', 1);

add_action('wp_ajax_hn_fin_processamento_fatura', 'hn_fin_processamento_fatura', 1);
add_action('wp_ajax_nopriv_hn_fin_processamento_fatura', 'hn_fin_processamento_fatura', 1);

if(!function_exists("hn_fin_acao_pagar")){
    function hn_fin_acao_pagar(){
        $id = $_REQUEST['id'];
        update_post_meta($id, 'hn_fin_lanca_baixa', 'pago');
        update_post_meta($id, 'hn_fin_lanca_data_arrecadacao', date('Y-m-d'));
        wp_die();
    }
}

add_action('wp_ajax_hn_fin_acao_pagar', 'hn_fin_acao_pagar', 1);
add_action('wp_ajax_nopriv_hn_fin_acao_pagar', 'hn_fin_acao_pagar', 1);

if(!function_exists("hn_fin_acao_cobrar")){
    function hn_fin_acao_cobrar(){
        $id = $_REQUEST['id'];
        update_post_meta($id, 'hn_fin_lanca_data_cobranca', date('Y-m-d'));
        wp_die();
    }
}

add_action('wp_ajax_hn_fin_acao_cobrar', 'hn_fin_acao_cobrar', 1);
add_action('wp_ajax_nopriv_hn_fin_acao_cobrar', 'hn_fin_acao_cobrar', 1);

if(!function_exists("hn_fin_acao_cancelar")){
    function hn_fin_acao_cancelar(){
        $id = $_REQUEST['id'];
        update_post_meta($id, 'hn_fin_lanca_baixa', 'servico_cancelado');
        $idserv = get_post_meta($id,'hn_fin_lanca_item_servico', 1);
        update_post_meta($idserv, 'hn_fin_insta_data_fim', date('Y-m-d'));
        wp_die();
    }
}

add_action('wp_ajax_hn_fin_acao_cancelar', 'hn_fin_acao_cancelar', 1);
add_action('wp_ajax_nopriv_hn_fin_acao_cancelar', 'hn_fin_acao_cancelar', 1);

if(!function_exists("hn_fin_acao_suspender")){
    function hn_fin_acao_suspender(){
        $id = $_REQUEST['id'];
        update_post_meta($id, 'hn_fin_lanca_baixa', 'suspenso');
        $idserv = get_post_meta($id,'hn_fin_lanca_item_servico', 1);
        update_post_meta($idserv, 'hn_fin_insta_data_fim', date('Y-m-d'));
        update_post_meta($idserv, 'hn_fin_insta_suspenso', '1');
        wp_die();
    }
}

add_action('wp_ajax_hn_fin_acao_suspender', 'hn_fin_acao_suspender', 1);
add_action('wp_ajax_nopriv_hn_fin_acao_suspender', 'hn_fin_acao_suspender', 1);

if(!function_exists("hn_fin_acao_atualizar_nota")){
    function hn_fin_acao_atualizar_nota(){
        $id = $_REQUEST['id'];
        $nota = $_REQUEST['nota'];
        update_post_meta($id, 'hn_fin_lanca_nota_fiscal', $nota);
        /*$idserv = get_post_meta($id,'hn_fin_lanca_item_servico', 1);
        update_post_meta($idserv, 'hn_fin_insta_data_fim', date('Y-m-d'));
        update_post_meta($idserv, 'hn_fin_insta_suspenso', '1');*/
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_acao_atualizar_nota', 'hn_fin_acao_atualizar_nota', 1);
add_action('wp_ajax_nopriv_hn_fin_acao_atualizar_nota', 'hn_fin_acao_atualizar_nota', 1);

if(!function_exists("hn_fin_acao_nova_fatura")){
    function hn_fin_acao_nova_fatura(){
        $id = $_REQUEST['id'];
        $nova_data = $_REQUEST['nova_fatura'];
        $multa = $_REQUEST['valor_multa'];
        $meta = get_post_meta($id);
        echo "Titulo post antigo <br /><pre>";
        print_r($meta);
        echo "</pre>";
        update_post_meta($id, 'hn_fin_lanca_baixa', 'lancamento_cancelado');
        
        
        // post padrão
        $post = array(
            'post_title'    => '',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'hn_fin_lanca',
        );
        
        
        $novo_id = wp_insert_post($post, $meta);
        update_post_meta($id, 'hn_fin_estorno_por', $novo_id);
        
        
        foreach($meta as $key => $item){
            if($key == "hn_fin_lanca_taxas"){
                foreach($item as $itemd){
                    add_post_meta($novo_id, 'hn_fin_lanca_taxas', $itemd);
                }
            }else{
                update_post_meta($novo_id, $key, $item);
            }
        }
        
        update_post_meta($novo_id, 'hn_fin_lanca_data_vencimento', $nova_data);
        update_post_meta($novo_id, 'hn_fin_estornando', $id);
        update_post_meta($novo_id, 'hn_fin_lanca_valor_multa', $multa);
        
        
        $post_meta_novo = get_post_meta($novo_id);
        echo "Titulo post novo <br /><pre>";
        print_r($post_meta_novo);
        echo "</pre>";
        
        
        
        $meta = get_post_meta($novo_id);
        
        $id_item_servico = $meta['hn_fin_lanca_item_servico'];
        $id_entidade = get_post_meta($id_item_servico, 'hn_fin_insta_cliente', 1);
        
        
        $nome = get_post_meta($id_entidade, 'hn_fin_financeiro_nome', 1);
        if(empty($nome)){
            $nome = get_post_meta($id_entidade, 'hn_fin_financeiro_razao_social', 1);
        }
        $identificador = get_post_meta($id_entidade, 'hn_fin_financeiro_cpf', 1);
        if(empty($identificador)){
            $identificador = get_post_meta($id_entidade, 'hn_fin_financeiro_cnpj', 1);
        }
        $rua = get_post_meta($id_entidade, 'hn_fin_financeiro_endereco', 1);
        $numero_endereco = get_post_meta($id_entidade, 'hn_fin_financeiro_numero', 1);
        $bairro = get_post_meta($id_entidade, 'hn_fin_financeiro_bairro', 1);
        $cidade = get_post_meta($id_entidade, 'hn_fin_financeiro_cidade', 1);
        $estado = get_post_meta($id_entidade, 'hn_fin_financeiro_estado', 1);
        $cep = get_post_meta($id_entidade, 'hn_fin_financeiro_cep', 1);
        $nome = $nome . " - " . $identificador;
        $endereco1 = $rua . " - " . $numero_endereco;
        $endereco2 = $bairro . " - " . $cidade . " - " . $estado . " - " . $cep;
        
        $id_servico = $meta['hn_fin_lanca_servico'];
        $nome_servico = get_post_meta($meta['hn_fin_lanca_servico'], 'hn_fin_servicos_nome', 1);
        
        $data_vencimento = $meta['hn_fin_lanca_data_vencimento'];
        $date = date('Y/m/d');
        $vencimento_total = $data_vencimento - $date;
        
        // Usa a função strtotime() e pega o timestamp das duas datas:
        $time_inicial = strtotime($date);
        $time_final = strtotime($data_vencimento);
        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
        // Calcula a diferença de dias
        $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
        
        $demonstrativo_1 = $nome_servico;
        $demonstrativo_2 = $meta['hn_fin_lanca_dominio'];
        $demonstrativo_3 = "Suspenção dos serviços 5 dias após o vencimento";
        $instrucoes_1 = " ";
        $instrucoes_2 = " ";
        $instrucoes_3 = " ";
        $instrucoes_4 = " ";
        $nosso_numero = " ";
        
        $cod = wp_insert_post($post);
        
        $nosso_numero = $cod;
        $vencimento = $dias;
        $valor = $meta['hn_fin_lanca_valor'] + $meta['hn_fin_lanca_valor_multa'];
        
        
        echo '<script>window.open("http://hngrupo.com.br/financeiro/wp-content/plugins/hn_financeiro/boleto/boleto_santander_banespa1.php?sacado='. $nome .'&endereco_1='. $endereco1 .'&endereco_2='. $endereco2 .'&demonstrativo_1='. $demonstrativo_1 .'&demonstrativo_2='. $demonstrativo_2 .'&demonstrativo_3='. $demonstrativo_3 .'&instrucoes_1='. $instrucoes_1 .'&instrucoes_2='. $instrucoes_2 .'&instrucoes_3='. $instrucoes_3 .'&instrucoes_4='. $instrucoes_4 .'&nosso_numero=' . $nosso_numero .'&vencimento=' . $vencimento .'&valor=' . $valor .'&post_id=' . $cod .'");</script>';
        
        
        
        
        
        
        
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_acao_nova_fatura', 'hn_fin_acao_nova_fatura', 1);
add_action('wp_ajax_nopriv_hn_fin_acao_nova_fatura', 'hn_fin_acao_nova_fatura', 1);

if(!function_exists("hn_fin_servicos_cliente")){
    function hn_fin_servicos_cliente(){
        $id = $_REQUEST['id'];
        
        $args = array(
          'post_type' => 'hn_fin_insta',
          'post_status' => 'publish',
          'nopaging' => true,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_insta_cliente',
                    'value'   => $id,
                    'compare' => '=',
                ),
            ),
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();   
        echo "<table border='1'>";
        echo "<td>Serviço</td>";
        echo "<td>Dominio</td>";
        echo "<td>Data inicio</td>";
        echo "<td>Data fim</td>";
        foreach($query->posts as $item){
            $lista[] = $item->ID;
            $id = $item->ID;
            $id_servico = get_post_meta($id, 'hn_fin_insta_servico', 1);
            $servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
            $dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
            $datainicio = get_post_meta($id, 'hn_fin_insta_data_inicio', 1);
            $datafim = get_post_meta($id, 'hn_fin_insta_data_fim', 1);
            
            $suspenso = get_post_meta($id, 'hn_fin_insta_suspenso', 1);
            if(($suspenso == "0") && ($datafim == "") ){
                //$suspenso = "Não";
                $cor = "";
            }else if(($suspenso == "1")){
                //$suspenso = "Sim";
                $cor = "yellow";
                $cor_font = "black";
            }else if($datafim != ""){
                $cor = "red";
                $cor_font = "white";
            }
            
            
            if($suspenso == "0"){
                $suspenso = "Não";
            }else if($suspenso == "1"){
                $suspenso = "Sim";
            }
            echo "<tr style='background-color:". $cor ."; color:". $cor_font .";'>";
            echo "<td>" . $servico . "</td>";
            echo "<td>" . $dominio . "</td>";
            echo "<td>" . $datainicio . "</td>";
            echo "<td>" . $datafim . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_servicos_cliente', 'hn_fin_servicos_cliente', 1);
add_action('wp_ajax_nopriv_hn_fin_servicos_cliente', 'hn_fin_servicos_cliente', 1);

if(!function_exists("hn_fin_instancias_tudo")){
    function hn_fin_instancias_tudo(){
        $id = $_REQUEST['id'];
        
        $args = array(
          'post_type' => 'hn_fin_insta',
          'post_status' => 'publish',
          'nopaging' => true,
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();   
        echo "<table border='1'>";
        echo "<td>Cliente</td>";
        echo "<td>Serviço</td>";
        echo "<td>Valor</td>";
        echo "<td>Ciclo</td>";
        echo "<td>Data inicio</td>";
        echo "<td>Data fim</td>";
        echo "<td>Dominio</td>";
        echo "<td>Suspenso</td>";
        foreach($query->posts as $item){
            $lista[] = $item->ID;
            $id = $item->ID;
            
            $id_cliente = get_post_meta($id, 'hn_fin_insta_cliente', 1);
            $cliente = get_the_title( $id_cliente );
            
            $id_servico = get_post_meta($id, 'hn_fin_insta_servico', 1);
            $servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
            
            $valor = get_post_meta($id, 'hn_fin_insta_valor', 1);
            
            $id_ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 1);
            $ciclo = get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1);
            
            $dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
            $datainicio = get_post_meta($id, 'hn_fin_insta_data_inicio', 1);
            $datafim = get_post_meta($id, 'hn_fin_insta_data_fim', 1);
            
            $suspenso = get_post_meta($id, 'hn_fin_insta_suspenso', 1);
            if(($suspenso == "0") && ($datafim == "") ){
                //$suspenso = "Não";
                $cor = "";
            }else if(($suspenso == "1")){
                //$suspenso = "Sim";
                $cor = "yellow";
                $cor_font = "black";
            }else if($datafim != ""){
                $cor = "red";
                $cor_font = "white";
            }
            
            
            if($suspenso == "0"){
                $suspenso = "Não";
            }else if($suspenso == "1"){
                $suspenso = "Sim";
            }
            
            echo "<tr style='background-color:". $cor ."; color:". $cor_font .";'>";
            echo "<td>" . $cliente . "</td>";
            echo "<td>" . $servico . "</td>";
            echo "<td>" . $valor . "</td>";
            echo "<td>" . $ciclo . "</td>";
            echo "<td>" . $datainicio . "</td>";
            echo "<td>" . $datafim . "</td>";
            echo "<td>" . $dominio . "</td>";
            echo "<td>" . $suspenso . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_instancias_tudo', 'hn_fin_instancias_tudo', 1);
add_action('wp_ajax_nopriv_hn_fin_instancias_tudo', 'hn_fin_instancias_tudo', 1);

if(!function_exists("hn_fin_instancias_ativos")){
    function hn_fin_instancias_ativos(){
        $id = $_REQUEST['id'];
        
        $args = array(
            'post_type' => 'hn_fin_insta',
            'post_status' => 'publish',
            'nopaging' => true,
            'meta_query' => array(
                array(
                    'key'     => 'hn_fin_insta_data_fim',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();   
        echo "<table border='1'>";
        echo "<td>Cliente</td>";
        echo "<td>Serviço</td>";
        echo "<td>Valor</td>";
        echo "<td>Ciclo</td>";
        echo "<td>Data inicio</td>";
        echo "<td>Data fim</td>";
        echo "<td>Dominio</td>";
        echo "<td>Suspenso</td>";
        foreach($query->posts as $item){
            $lista[] = $item->ID;
            $id = $item->ID;
            
            $id_cliente = get_post_meta($id, 'hn_fin_insta_cliente', 1);
            $cliente = get_the_title( $id_cliente );
            
            $id_servico = get_post_meta($id, 'hn_fin_insta_servico', 1);
            $servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
            
            $valor = get_post_meta($id, 'hn_fin_insta_valor', 1);
            
            $id_ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 1);
            $ciclo = get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1);
            
            $dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
            $datainicio = get_post_meta($id, 'hn_fin_insta_data_inicio', 1);
            $datafim = get_post_meta($id, 'hn_fin_insta_data_fim', 1);
            
            $suspenso = get_post_meta($id, 'hn_fin_insta_suspenso', 1);
            if($suspenso == "0"){
                $suspenso = "Não";
            }else if($suspenso == "1"){
                $suspenso = "Sim";
            }
            
            echo "<tr>";
            echo "<td>" . $cliente . "</td>";
            echo "<td>" . $servico . "</td>";
            echo "<td>" . $valor . "</td>";
            echo "<td>" . $ciclo . "</td>";
            echo "<td>" . $datainicio . "</td>";
            echo "<td>" . $datafim . "</td>";
            echo "<td>" . $dominio . "</td>";
            echo "<td>" . $suspenso . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_instancias_ativos', 'hn_fin_instancias_ativos', 1);
add_action('wp_ajax_nopriv_hn_fin_instancias_ativos', 'hn_fin_instancias_ativos', 1);


if(!function_exists("hn_fin_instancias_suspensos")){
    function hn_fin_instancias_suspensos(){
        $id = $_REQUEST['id'];
        
        $args = array(
            'post_type' => 'hn_fin_insta',
            'post_status' => 'publish',
            'nopaging' => true,
            'meta_query' => array(
                array(
                    'key'     => 'hn_fin_insta_suspenso',
                    'value'   => 1,
                    'compare' => '=',
                ),
            ),
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();   
        echo "<table border='1'>";
        echo "<td>Cliente</td>";
        echo "<td>Serviço</td>";
        echo "<td>Valor</td>";
        echo "<td>Ciclo</td>";
        echo "<td>Data inicio</td>";
        echo "<td>Data fim</td>";
        echo "<td>Dominio</td>";
        echo "<td>Suspenso</td>";
        echo "<td>Reativar</td>";
        foreach($query->posts as $item){
            $lista[] = $item->ID;
            $id = $item->ID;
            
            $id_cliente = get_post_meta($id, 'hn_fin_insta_cliente', 1);
            $cliente = get_the_title( $id_cliente );
            
            $id_servico = get_post_meta($id, 'hn_fin_insta_servico', 1);
            $servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
            
            $valor = get_post_meta($id, 'hn_fin_insta_valor', 1);
            
            $id_ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 1);
            $ciclo = get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1);
            
            $dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
            $datainicio = get_post_meta($id, 'hn_fin_insta_data_inicio', 1);
            $datafim = get_post_meta($id, 'hn_fin_insta_data_fim', 1);
            
            $suspenso = get_post_meta($id, 'hn_fin_insta_suspenso', 1);
            if($suspenso == "0"){
                $suspenso = "Não";
            }else if($suspenso == "1"){
                $suspenso = "Sim";   
            }
            
            echo "<tr>";
            echo "<td>" . $cliente . "</td>";
            echo "<td>" . $servico . "</td>";
            echo "<td>" . $valor . "</td>";
            echo "<td>" . $ciclo . "</td>";
            echo "<td>" . $datainicio . "</td>";
            echo "<td>" . $datafim . "</td>";
            echo "<td>" . $dominio . "</td>";
            echo "<td>" . $suspenso . "</td>";
            echo "<td> <input type='button' name='reativar' value='Reativar' class='reativar' ident='$id' /> </td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
            <script>
            jQuery(".reativar").on( "click", function(){
                //alert(jQuery(this).attr('ident'))
                //alert("<?php echo get_bloginfo('wpurl'); ?>" + "/wp-admin/post.php?post="+<?php echo $id; ?>+"&action=edit")
                jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                    ,{
                        action: 'hn_fin_reativar', 
                        id: jQuery(this).attr('ident'),
                    }, function(data){
                        //jQuery("#hn_fin_insta_valor").val(data)
                        
                        window.location.href="<?php echo get_bloginfo('wpurl'); ?>" + "/wp-admin/post.php?post="+ data +"&action=edit";
                    
                        //window.location.href = response.redirect;
                        alert('Ação realizada')
                    }
                );
                
            });
            </script>
        <?php
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_instancias_suspensos', 'hn_fin_instancias_suspensos', 1);
add_action('wp_ajax_nopriv_hn_fin_instancias_suspensos', 'hn_fin_instancias_suspensos', 1);


if(!function_exists("hn_fin_instancias_cancelados")){
    function hn_fin_instancias_cancelados(){
        $id = $_REQUEST['id'];
        
        $args = array(
            'post_type' => 'hn_fin_insta',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key'     => 'hn_fin_insta_data_fim',
                    'compare' => 'EXISTS',
                ),
                array(
                    'key'     => 'hn_fin_insta_suspenso',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();   
        echo "<table border='1'>";
        echo "<td>Cliente</td>";
        echo "<td>Serviço</td>";
        echo "<td>Valor</td>";
        echo "<td>Ciclo</td>";
        echo "<td>Data inicio</td>";
        echo "<td>Data fim</td>";
        echo "<td>Dominio</td>";
        echo "<td>Suspenso</td>";
        foreach($query->posts as $item){
            $lista[] = $item->ID;
            $id = $item->ID;
            
            $id_cliente = get_post_meta($id, 'hn_fin_insta_cliente', 1);
            $cliente = get_the_title( $id_cliente );
            
            $id_servico = get_post_meta($id, 'hn_fin_insta_servico', 1);
            $servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
            
            $valor = get_post_meta($id, 'hn_fin_insta_valor', 1);
            
            $id_ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 1);
            $ciclo = get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1);
            
            $dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
            $datainicio = get_post_meta($id, 'hn_fin_insta_data_inicio', 1);
            $datafim = get_post_meta($id, 'hn_fin_insta_data_fim', 1);
            
            $suspenso = get_post_meta($id, 'hn_fin_insta_suspenso', 1);
            if($suspenso == "0"){
                $suspenso = "Não";
            }else if($suspenso == "1"){
                $suspenso = "Sim";
            }
            
            echo "<tr>";
            echo "<td>" . $cliente . "</td>";
            echo "<td>" . $servico . "</td>";
            echo "<td>" . $valor . "</td>";
            echo "<td>" . $ciclo . "</td>";
            echo "<td>" . $datainicio . "</td>";
            echo "<td>" . $datafim . "</td>";
            echo "<td>" . $dominio . "</td>";
            echo "<td>" . $suspenso . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_instancias_cancelados', 'hn_fin_instancias_cancelados', 1);
add_action('wp_ajax_nopriv_hn_fin_instancias_cancelados', 'hn_fin_instancias_cancelados', 1);

if(!function_exists("hn_fin_lucro_despesa")){
    function hn_fin_lucro_despesa(){
        $tipo = $_REQUEST['tipo'];
        
        $args = array(
            'post_type' => 'hn_fin_lanca',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key'     => 'hn_fin_lanca_tipo_lancamento',
                    'value'   => $tipo,
                    'compare' => '=',
                ),
            ),
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();   
        echo "<table border='1'>";
        echo "<td>Favorecido</td>";
        echo "<td>Item de Serviço</td>";
        echo "<td>Valor</td>";
        echo "<td>Ciclo</td>";
        echo "<td>Data inicio</td>";
        echo "<td>Data fim</td>";
        echo "<td>Dominio</td>";
        echo "<td>Suspenso</td>";
        foreach($query->posts as $item){
            $lista[] = $item->ID;
            $id = $item->ID;
            
            $id_favorecido = get_post_meta($id, 'hn_fin_lanca_favorecido', 1);
            $favorecido = get_the_title( $id_favorecido );
            
            $id_servico = get_post_meta($id, 'hn_fin_lanca_servico', 1);
            $servico = get_the_title( $id_item_servico );
            
            $valor = get_post_meta($id, 'hn_fin_insta_valor', 1);
            
            $id_ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 1);
            $ciclo = get_post_meta($id_ciclo, 'hn_fin_ciclo_nome', 1);
            
            $dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
            $datainicio = get_post_meta($id, 'hn_fin_insta_data_inicio', 1);
            $datafim = get_post_meta($id, 'hn_fin_insta_data_fim', 1);
            
            $suspenso = get_post_meta($id, 'hn_fin_insta_suspenso', 1);
            if($suspenso == "0"){
                $suspenso = "Não";
            }else if($suspenso == "1"){
                $suspenso = "Sim";
            }
            
            echo "<tr>";
            echo "<td>" . $favorecido . "</td>";
            echo "<td>" . $servico . "</td>";
            echo "<td>" . $valor . "</td>";
            echo "<td>" . $ciclo . "</td>";
            echo "<td>" . $datainicio . "</td>";
            echo "<td>" . $datafim . "</td>";
            echo "<td>" . $dominio . "</td>";
            echo "<td>" . $suspenso . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_lucro_despesa', 'hn_fin_lucro_despesa', 1);
add_action('wp_ajax_nopriv_hn_fin_lucro_despesa', 'hn_fin_lucro_despesa', 1);


if(!function_exists("hn_fin_reativar")){
    function hn_fin_reativar(){
        $id = $_REQUEST['id'];
        delete_post_meta( $id, 'hn_fin_insta_suspenso', 0 );
        
        $emissor = get_post_meta($id, 'hn_fin_insta_emissor_nota', 0);
        $cliente = get_post_meta($id, 'hn_fin_insta_cliente', 0);
        $receita_despesa = get_post_meta($id, 'hn_fin_insta_receita_despesa', 1);
        $servico = get_post_meta($id, 'hn_fin_insta_servico', 0);
        $valor = get_post_meta($id, 'hn_fin_insta_valor', 1);
        $ciclo = get_post_meta($id, 'hn_fin_insta_ciclo', 0);
        $data = get_post_meta($id, 'hn_fin_insta_data_inicio', 1);
        $tipo_valor = get_post_meta($id, 'hn_fin_insta_tipo_valor', 1);
        $taxas = get_post_meta($id, 'hn_fin_insta_taxas');
        $dominio = get_post_meta($id, 'hn_fin_insta_dominio', 1);
        $lista_taxas = array();
        if(count ($taxas) > 0){
            foreach($taxas as $item){
                $lista_taxas[] = $item;
            }
        }
        
        $post = array(
            'post_title'    => 'Nova Instancia',
            'post_status'   => 'publish',
            'post_type'		=> 'hn_fin_insta',
            'post_author'   => get_current_user_id(),
        );
        
        $id_new_post = wp_insert_post($post);
        
        update_post_meta($id_new_post, 'hn_fin_insta_emissor_nota', $emissor);
        update_post_meta($id_new_post, 'hn_fin_insta_cliente', $cliente);
        update_post_meta($id_new_post, 'hn_fin_insta_receita_despesa', $receita_despesa);
        update_post_meta($id_new_post, 'hn_fin_insta_servico', $servico);
        update_post_meta($id_new_post, 'hn_fin_insta_valor', $valor);
        update_post_meta($id_new_post, 'hn_fin_insta_ciclo', $ciclo);
        update_post_meta($id_new_post, 'hn_fin_insta_data_inicio', date('Y-m-d'));
        update_post_meta($id_new_post, 'hn_fin_insta_tipo_valor', $tipo_valor);
        
        //update_post_meta($id_new_post, 'hn_fin_insta_taxas', $lista_taxas);
        foreach($lista_taxas as $item){
            add_post_meta($id_new_post, 'hn_fin_insta_taxas', $item);
        }
        update_post_meta($id_new_post, 'hn_fin_insta_dominio', $dominio);
        
        echo $id_new_post;
        //update_post_meta($id_new_post, 'hn_ef_vaga_status', "Disponivel");
        
        wp_die();
    }
}
add_action('wp_ajax_hn_fin_reativar', 'hn_fin_reativar', 1);
add_action('wp_ajax_nopriv_hn_fin_reativar', 'hn_fin_reativar', 1);

?>
