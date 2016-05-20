<?php
if(!function_exists("hn_fin_pg_move_boletos")){
    function hn_fin_pg_move_boletos($content = null){
        $url = wp_upload_dir();
        /* Diretorio que deve ser lido */
        $dir = $url['basedir'] . "/boletos/";
        /* Abre o diretório */
        $pasta= opendir($dir);

        /* Loop para ler os arquivos do diretorio */
        while ($arquivo = readdir($pasta)){
            if ($arquivo != "." && $arquivo != ".."){
                if(substr($arquivo, -4) == ".pdf"){
                    $partes1 = explode(".", $arquivo);
                    $partes2 = explode("-", $partes1[0]);
                    $id = $partes2[1];
                    $caminho_arquivo = $dir . $arquivo;
                    $wp_upload_dir = $url['basedir'];
                    //echo $id;
                    $filetype = wp_check_filetype( basename( $caminho_arquivo ), null );
                    $attachment = array(
                        'guid'           => $url['basedir']. "/" . $arquivo, 
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => "boleto-" . $id,
                        'post_content'   => $id,
                        'post_status'    => 'inherit'
                    );
                    if(file_exists($caminho_arquivo)){
                        echo "arquivo encontrado: " . $arquivo . "<br>";
                        copy($caminho_arquivo,$url['basedir']. "/" . $arquivo);
                    }else{
                        echo "arquivo n encontrado <br>";
                    }
                    //error_get_last();
                    /*
                    if(copy("../../../uploads/boletos/" . $arquivo,"../../../uploads/" . $arquivo)){
                        echo "FOI!";   
                    }else{
                        echo "NAO FOI!";   
                    }
                    */
                    //echo "inicio do arquivo: <br /> source: " . $caminho_arquivo . "<br /> destino: " . $wp_upload_dir . "/" . $arquivo . "<br />";
                    add_action('add_attachment',"anexar_boleto");
                    $attach_id = wp_insert_attachment( $attachment, $url['basedir']. "/" . $arquivo, $id );
                    //echo $attach_id . "<br />";
                }else{
                    unlink($dir . "/" . $arquivo);  
                }
            }
        }
    }
}

if(!function_exists("anexar_boleto")){
    function anexar_boleto($id){
        $url = wp_upload_dir();
        $dir = $url['basedir'] . "/boletos/";
        $post = get_post($id);
        $id_post = $post->post_content;
        unlink($dir . "boleto-" . $id_post . ".pdf");
        update_post_meta($id_post, 'hn_fin_lanca_pdf', $id);
    }
}
if(!function_exists("hn_fin_pg_temporario")){
    function hn_fin_pg_temporario($content = null){
        $post = get_post_meta(867);
        echo "<pre>";
        print_r($post);
        echo "</pre>";
        
    }
}
if(!function_exists("hn_fin_pg_gera_boleto")){
    function hn_fin_pg_gera_boleto($content = null){
        ob_start();
?>
        <style>
            input{
               width: 500px; 
            }

        </style>
        <script>
            jQuery(document).ready(function(){
                jQuery('.rwmb-select-advanced').change(function(){
                    var id = jQuery( "select option:selected" ).val();
                    //alert(id)
                    jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                        ,{
                            action: 'hn_fin_info_cliente', 
                            id: id,
                            dataType: 'json',
                            contentType: "application/json",
                        }, function(data){
                            var response = jQuery.parseJSON(data);
                            jQuery(".sacado").val(response.nome);
                            jQuery(".endereco_1").val(response.endereco1);
                            jQuery(".endereco_2").val(response.endereco2);
                            jQuery(".instrucoes_1").val("- Receber somente até o vencimento");
                        }
                    );
                });
            });
        </script>
        <!--<form action="http://hospedanit.com.br/boleto/boleto_santander_banespa1.php" method="post" target="_blank">-->
        <form action="http://hngrupo.com.br/financeiro/wp-content/plugins/hn_financeiro/boleto/boleto_santander_banespa1.php" method="get" target="_blank">
            <div class="div-sacado">
                <!--Sacado-->
                <div class="rwmb-input" style="margin-top: 20px !important;">
            <div style="width: auto;" id="s2id_hn_fin_financeiro_conta_contabil" class="select2-container rwmb-select-advanced">
                <a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">
                    <span id="select2-chosen-1" class="select2-chosen">Selecione um favorecido</span>
                    <abbr class="select2-search-choice-close"></abbr>
                    <span class="select2-arrow" role="presentation">
                        <b role="presentation"></b>
                    </span>
                </a>
                <label for="s2id_autogen1" class="select2-offscreen">Conta Contábil</label>
                <input id="s2id_autogen1" aria-labelledby="select2-chosen-1" class="select2-focusser select2-offscreen" aria-haspopup="true" role="button" type="text">
            </div>
            <select style="display: none;" title="Cliente" tabindex="-1"  class="rwmb-select-advanced" name="hn_fin_financeiro_conta_contabil" id="hn_fin_financeiro_conta_contabil" size="0" data-options="{&quot;allowClear&quot;:true,&quot;width&quot;:&quot;resolve&quot;,&quot;placeholder&quot;:&quot;Selecione um favorecido&quot;}">
                <option></option>
                <?php
                // query
                $args = array(
                    'post_type' => 'hn_fin_financeiro',
                    'post_status' => 'publish',
                );
                $query = null;
                $query = new WP_Query($args);
                $lista = array();        
                foreach($query->posts as $item){
                    $lista[] = $item->ID;
                    echo "<option class='servicos-empresa' value='" . $item->ID . "'>" . $item->post_title . "</option>";
                }
                ?>
            </select><br />
            Sacado<input type="text" name="sacado" class="sacado" required/>
        </div>
            </div>
            <div class="div-endereco-1">
                Endereço 1<input type="text" name="endereco_1" class="endereco_1" required/>
            </div>
            <div class="div-endereco-2">
                Endereço 2<input type="text" name="endereco_2" class="endereco_2" required/>
            </div>
            <div class="div-demonstrativo-1">
                Demonstrativo 1<input type="text" name="demonstrativo_1" class="demonstrativo_1" required/>
            </div>
            <div class="div-demonstrativo-2">
                Demonstrativo 2<input type="text" name="demonstrativo_2" class="demonstrativo_2" />
            </div>
            <div class="div-demonstrativo-3">
                Demonstrativo 3<input type="text" name="demonstrativo_3" class="demonstrativo_3" />
            </div>
            <div class="div-instrucoes-1">
                Instruções 1<input type="text" name="instrucoes_1" class="instrucoes_1" />
            </div>
            <div class="div-instrucoes-2">
                Instruções 2<input type="text" name="instrucoes_2" class="instrucoes_2" />
            </div>
            <div class="div-instrucoes-3">
                Instruções 3<input type="text" name="instrucoes_3" class="instrucoes_3" />
            </div>
            <div class="div-instrucoes-4">
                Instruções 4<input type="text" name="instrucoes_4" class="instrucoes_4" />
            </div>
            <div class="div-instrucoes-4">
                Nosso número<input type="text" name="nosso_numero" class="nosso_numero" required/>
            </div>
            <div class="div-valor">
                Valor<input type="text" name="valor" class="valor" required/>
            </div>
            <div class="div-instrucoes-4">
                Vencimento<input type="text" name="vencimento" class="vencimento" required/>
            </div>
            <div class="div-instrucoes-4">
                <input type="submit" id="botao-gerar" class="botao-gerar" value="Gerar Boleto" />
            </div>
        </form>   
<?php
        // Now collect the output buffer into a variable
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}
function teste(){
    
    $parcela = "";
                // meta
                $item = 623;
                $metadata = get_post_meta($item);
                $insta_parcela = $metadata['hn_fin_insta_parcelas'][0];
                if(!empty($insta_parcela)){
                    $args = array(
                        'post_type' => 'hn_fin_lanca',
                        'post_status' => 'publish',
                        'nopaging' => true,
                        'orderby' => 'date',
                        'order'   => 'DESC',
                        'meta_query' => array(
                            array(
                                'key'     => 'hn_fin_lanca_item_servico',
                                'value'   => $item,
                                'compare' => '=',
                            ),
                            array(
                                'key'     => 'hn_fin_lanca_baixa',
                                'compare' => 'NOT EXISTS',
                            ),
                        ),
                    );
                    $query = null;
                    $query = new WP_Query($args);

                    $lista = array();        
                    foreach($query->posts as $item2){
                        $lista[] = $item2->ID;
                    }
                    echo "Lista: <br /><pre>";
                    print_array($lista);
                    echo "</pre>";
                    if(empty($lista)){
                        $lanca_parcela = 0;
                        echo "lancaparcela = 0";
                    }else{
                        $lanca_parcela = get_posta_meta($lista[0], 'hn_fin_lanca_parcela', 1);
                    }
                    if($lanca_parcela < $insta_parcela){
                        $parcela = $lanca_parcela+1;
                    }else{
                        $parcela = -1;
                    }
                }
                $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
                $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
                $servico = $metadata['hn_fin_insta_servico'][0];
                $servicodados = get_post_meta($servico);
                $meta = array(
                    'hn_fin_lanca_tipo_lancamento' => 'receita',
                    'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
                    'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
                    'hn_fin_lanca_item_servico' => $item,
                    'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
                    'hn_fin_lanca_data' => $datas[0],
                    'hn_fin_lanca_data_vencimento' => $datas[0],
                    'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
                    'hn_fin_lanca_contabil' => $conta_contabil,
                    'hn_fin_lanca_parcela' => $parcela,
                );
                $entrada = $metadata['hn_fin_insta_valor_entrada'][0];
                $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
                echo "passei1<br />";
                echo "Parcela: " . $parcela;
                if(!empty($parcela)){
                    if(empty($entrada)){
                        echo "entrada vazio";
                        $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0]/$insta_parcela;
                    }else{
                        if($parcela == 1){
                            $meta['hn_fin_lanca_valor'] = $entrada;
                            echo $meta['hn_fin_lanca_valor'];
                        }else{
                            $meta['hn_fin_lanca_valor'] = ($metadata['hn_fin_insta_valor'][0] - $entrada)/($insta_parcela - 1);
                        }
                    }
                }
                $taxas = 0;
                if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
                    if(count($metadata['hn_fin_insta_taxas']) > 0){
                        $meta['hn_fin_lanca_taxas'] = array();
                        foreach($metadata['hn_fin_insta_taxas'] as $item2){
                            $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                            $meta['hn_fin_lanca_taxas'][] = $item2;
                        }
                    }
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'receita'){
                    $meta['hn_fin_lanca_centro_lucro'] = $servicodados['hn_fin_servicos_centro_lucro'][0];
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'despesa'){
                    $meta['hn_fin_lanca_centro_custo'] = $servicodados['hn_fin_servicos_centro_custo'][0];
                }
                $meta['hn_fin_lanca_valor'] += $taxas;
                $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
                // post padrão
                $data = str_replace("-", "", substr($datas[0], -8));
                $nome_servico = get_post_meta($metadata['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1);
                $nome_cliente = get_the_title( $metadata['hn_fin_insta_cliente'][0] );
                $post = array(
                    'post_title'    => $data . " | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $meta['hn_fin_lanca_valor'] ,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'hn_fin_lanca',
                );
                if($parcela != -1){
                    //hn_fin_cria_lancamento($post, $meta);
                    echo "entrou";
                    echo $meta['hn_fin_lanca_valor'];
                }
    /*$metadata = get_post_meta(623);
    $insta_parcela = get_post_meta(623);
    if(!empty($insta_parcela)){
        echo "entrou";
    }
    $args = array(
        'post_type' => 'hn_fin_lanca',
        'post_status' => 'publish',
        'nopaging' => true,
        'orderby' => 'date',
        'order'   => 'DESC',
        'meta_query' => array(
            array(
                'key'     => 'hn_fin_lanca_item_servico',
                'value'   => 623,
                'compare' => '=',
            ),
            array(
                'key'     => 'hn_fin_lanca_baixa',
                'compare' => 'NOT EXISTS',
            ),
        ),
    );
    $query = null;
    $query = new WP_Query($args);

    $lista = array();        
    foreach($query->posts as $item){
        $lista[] = $item->ID;
    }
    print_array($lista);
    if(empty($lista)){
        $lanca_parcela = 0;
        echo "lista vazia";
    }else{
        $lanca_parcela = get_posta_meta($lista[0], 'hn_fin_lanca_parcela', 1);
        echo "lista cheia";
    }
    if($lanca_parcela < $insta_parcela){
        $parcela = $lanca_parcela+1;
        echo "lanca parcela menor que isnta parcela";
    }else{
        $parcela = -1;
        echo "lanca parcela maior que isnta parcela";
    }
    $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
    $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
    $servico = $metadata['hn_fin_insta_servico'][0];
    $servicodados = get_post_meta($servico);
    $meta = array(
        'hn_fin_lanca_tipo_lancamento' => 'receita',
        'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
        'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
        'hn_fin_lanca_item_servico' => $item,
        'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
        'hn_fin_lanca_data' => $datas[0],
        'hn_fin_lanca_data_vencimento' => $datas[0],
        'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
        'hn_fin_lanca_contabil' => $conta_contabil,
        'hn_fin_lanca_parcela' => $parcela,
    );
    $entrada = $metadata['hn_fin_insta_valor_entrada'][0];
    $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
    if(!empty($parcela)){
        if(empty($entrada)){
            $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0]/$insta_parcela;
        }else{
            if($parcela == 1){
                $meta['hn_fin_lanca_valor'] = $entrada;
                echo $meta['hn_fin_lanca_valor'];
            }
        }
    }
    $taxas = 0;
    if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
        if(count($metadata['hn_fin_insta_taxas']) > 0){
            $meta['hn_fin_lanca_taxas'] = array();
            foreach($metadata['hn_fin_insta_taxas'] as $item2){
                $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                $meta['hn_fin_lanca_taxas'][] = $item2;
            }
        }
    }
    $meta['hn_fin_lanca_valor'] += $taxas;
    $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
    echo $meta['hn_fin_lanca_valor'];
    if($parcela != -1){
        echo "entreou";
    }*/
}


function print_array($lista){
    echo '<pre>';
    print_r($lista);
    echo '</pre>';
}
if(!function_exists("hn_fin_array_match")){
    function hn_fin_array_match(ARRAY $array1 = null, ARRAY $array2 = null){
        if(is_null($array1) || is_null($array2)){
            $lista = null;
        }else{
            $lista = array();
            foreach($array1 as $item){
                if(in_array($item, $array2))
                    $lista[] = $item;
            }
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_mensal")){
    function hn_fin_consulta_ciclos_mensal(){
        $args = array(
            'nopaging' => true,
            'post_type' => 'hn_fin_ciclo',
            'post_status' => 'publish',
'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_nome',
                    'value'   => 'M',
                    'compare' => 'LIKE',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_bimestre")){
    function hn_fin_consulta_ciclos_bimestre(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_nome',
                    'value'   => 'B',
                    'compare' => 'LIKE',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_trimestre")){
    function hn_fin_consulta_ciclos_trimestre(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_nome',
                    'value'   => 'T',
                    'compare' => 'LIKE',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_quadrimestre")){
    function hn_fin_consulta_ciclos_quadrimestre(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_nome',
                    'value'   => 'Q',
                    'compare' => 'LIKE',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_semestre")){
    function hn_fin_consulta_ciclos_semestre(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_nome',
                    'value'   => 'S',
                    'compare' => 'LIKE',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_anual")){
    function hn_fin_consulta_ciclos_anual(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_nome',
                    'value'   => 'A',
                    'compare' => 'LIKE',
                ),
            ),
        );
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_01")){
    function hn_fin_consulta_ciclos_01(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_dia_emissao',
                    'value'   => '1',
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
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_05")){
    function hn_fin_consulta_ciclos_05(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_dia_emissao',
                    'value'   => '5',
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
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_10")){
    function hn_fin_consulta_ciclos_10(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_dia_emissao',
                    'value'   => '10',
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
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_15")){
    function hn_fin_consulta_ciclos_15(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_dia_emissao',
                    'value'   => '15',
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
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_20")){
    function hn_fin_consulta_ciclos_20(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_dia_emissao',
                    'value'   => '20',
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
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_25")){
    function hn_fin_consulta_ciclos_25(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_dia_emissao',
                    'value'   => '25',
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
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_ciclos_28")){
    function hn_fin_consulta_ciclos_28(){
        $args = array(
          'post_type' => 'hn_fin_ciclo',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_ciclo_dia_emissao',
                    'value'   => '28',
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
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_instancias_servico")){
    function hn_fin_consulta_instancias_servico($ciclo_p = null, $ciclo_d = null, $lancados = null){
        $args = array(
          'post_type' => 'hn_fin_insta',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_insta_data_fim',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        );
        $lista = hn_fin_array_match($ciclo_p, $ciclo_d);
        if(is_null($lista)){
            if(!is_null($ciclo_p)){
                $args['meta_query'][] = array(
                    'key'     => 'hn_fin_insta_ciclo',
                    'value'   => $ciclo_p,
                    'compare' => 'in',
                );
            }
            if(!is_null($ciclo_d)){
                $args['meta_query'][] = array(
                    'key'     => 'hn_fin_insta_ciclo',
                    'value'   => $ciclo_d,
                    'compare' => 'in',
                );
            }
        }else{
            $args['meta_query'][] = array(
                'key'     => 'hn_fin_insta_ciclo',
                'value'   => $lista,
                'compare' => 'in',
            );
        }
        if(!is_null($lancados)){
            $args['post__not_in'] = $lancados;
        }
        $query = null;
        $query = new WP_Query($args);
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_consulta_instancias_servico_lancados")){
    function hn_fin_consulta_instancias_servico_lancados($instancias_serv = null, $datas = null){
        $args = array(
          'post_type' => 'hn_fin_lanca',
          'post_status' => 'publish',
'posts_per_page' => -1,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_lanca_item_servico',
                    'value'   => $instancias_serv,
                    'compare' => 'in',
                ),
                array(
                    'key'     => 'hn_fin_lanca_data',
                    'value'   => $datas,
                    'compare' => 'in',
                ),
            ),
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();        
        foreach($query->posts as $item){
            $metadata = get_post_meta($item->ID);
            $lista[] = $metadata['hn_fin_lanca_item_servico'][0];
        }
        return $lista;
    }
}
if(!function_exists("hn_fin_processamento_fatura")){
    function hn_fin_processamento_fatura(){
        $dia = $_REQUEST['dia'];
        $mes = (date("m")*1);
        $ano = (date("Y")*1);
        if((date("d")*1) > $dia){
            $mes++;
        }
        $datas = array();
        for($i=0;$i<=12;$i++){
            $datas[] = date("Y-m-d", mktime (0, 0, 0, $mes-$i, $dia, $ano));
        }
        // lista de dias
        switch($dia){
            case 5:
                $listadias = hn_fin_consulta_ciclos_05();
                break;
            case 10:
                $listadias = hn_fin_consulta_ciclos_10();
                break;
            case 15:
                $listadias = hn_fin_consulta_ciclos_15();
                break;
            case 20:
                $listadias = hn_fin_consulta_ciclos_20();
                break;
            case 25:
                $listadias = hn_fin_consulta_ciclos_25();
                break;
            case 28:
                $listadias = hn_fin_consulta_ciclos_28();
                break;
        }
        // verifica lançamentos mensais
        $prelistamensal = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_mensal(), $listadias);
        if(count($prelistamensal) > 0){
            $lancamentosmensal = hn_fin_consulta_instancias_servico_lancados($prelistamensal, array($datas[0]));
            $listamensal = $prelistamensal;
            if(count($lancamentosmensal) > 0){
                $listamensal = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_mensal(), $listadias, $lancamentosmensal);
            }
        }
        // verifica lançamentos bimestrais
        /*$prelistabimestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_bimestre(), $listadias);
        if(count($prelistabimestre) > 0){
            $lancamentosbimestre = hn_fin_consulta_instancias_servico_lancados($prelistabimestre, array($datas[0], $datas[1]));
            $listabimestre = $prelistabimestre;
            if(count($lancamentosbimestre) > 0){
                $listabimestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_bimestre(), $listadias, $lancamentosbimestre);
            }
        }*/
        // verifica lançamentos trimestral
        $prelistatrimestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_trimestre(), $listadias);
        if(count($prelistatrimestre) > 0){
            $lancamentostrimestre = hn_fin_consulta_instancias_servico_lancados($prelistatrimestre, array($datas[0], $datas[1], $datas[2]));
            $listatrimestre = $prelistatrimestre;
            if(count($lancamentostrimestre) > 0){
                $listatrimestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_trimestre(), $listadias, $lancamentostrimestre);
            }
        }
        // verifica lançamentos quadrimestral
        /*$prelistaquadrimestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_quadrimestre(), $listadias);
        if(count($prelistaquadrimestre) > 0){
            $lancamentosquadrimestre = hn_fin_consulta_instancias_servico_lancados($prelistaquadrimestre, array($datas[0], $datas[1], $datas[2], $datas[3]));
            $listaquadrimestre = $prelistaquadrimestre;
            if(count($lancamentosquadrimestre) > 0){
                $listaquadrimestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_quadrimestre(), $listadias, $lancamentosquadrimestre);
            }
        }*/
        // verifica lançamentos semestral
        $prelistasemestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_semestre(), $listadias);
        if(count($prelistasemestre) > 0){
            $lancamentossemestre = hn_fin_consulta_instancias_servico_lancados($prelistasemestre, array($datas[0], $datas[1], $datas[2], $datas[3], $datas[4], $datas[5]));
            $listasemestre = $prelistasemestre;
            if(count($lancamentossemestre) > 0){
                $listasemestre = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_semestre(), $listadias, $lancamentossemestre);
            }
        }
        // verifica lançamentos anual
        $prelistaano = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_anual(), $listadias);
        if(count($prelistaano) > 0){
            $lancamentosano = hn_fin_consulta_instancias_servico_lancados($prelistaano, array($datas[0], $datas[1], $datas[2], $datas[3], $datas[4], $datas[5], $datas[6], $datas[7], $datas[8], $datas[9], $datas[10], $datas[11]));
            $listaano = $prelistaano;
            if(count($lancamentosano) > 0){
                $listaano = hn_fin_consulta_instancias_servico(hn_fin_consulta_ciclos_anual(), $listadias, $lancamentosano);
            }
        }
        //$listamensal
        //, $listabimestre
        //, $listatrimestre
        //, $listaquadrimestre
        //, $listasemestre
        //, $listaano
        if(count($listamensal) > 0){
            $lista = $listamensal;
            foreach($lista as $item){
                $parcela = "";
                // meta
                $metadata = get_post_meta($item);
                $insta_parcela = $metadata['hn_fin_insta_parcelas'][0];
                if(!empty($insta_parcela)){
                    $args = array(
                        'post_type' => 'hn_fin_lanca',
                        'post_status' => 'publish',
                        'nopaging' => true,
                        'orderby' => 'date',
                        'order'   => 'DESC',
                        'meta_query' => array(
                            array(
                                'key'     => 'hn_fin_lanca_item_servico',
                                'value'   => $item,
                                'compare' => '=',
                            ),
                            array(
                                'key'     => 'hn_fin_lanca_baixa',
                                'compare' => 'NOT EXISTS',
                            ),
                        ),
                    );
                    $query = null;
                    $query = new WP_Query($args);

                    $lista = array();        
                    foreach($query->posts as $item){
                        $lista[] = $item->ID;
                    }
                    print_array($lista);
                    if(empty($lista)){
                        $lanca_parcela = 0;
                    }else{
                        $lanca_parcela = get_posta_meta($lista[0], 'hn_fin_lanca_parcela', 1);
                    }
                    if($lanca_parcela < $insta_parcela){
                        $parcela = $lanca_parcela+1;
                    }else{
                        $parcela = -1;
                    }
                }
                $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
                $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
                $servico = $metadata['hn_fin_insta_servico'][0];
                $servicodados = get_post_meta($servico);
                $meta = array(
                    'hn_fin_lanca_tipo_lancamento' => 'receita',
                    'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
                    'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
                    'hn_fin_lanca_item_servico' => $item,
                    'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
                    'hn_fin_lanca_data' => $datas[0],
                    'hn_fin_lanca_data_vencimento' => $datas[0],
                    'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
                    'hn_fin_lanca_contabil' => $conta_contabil,
                    'hn_fin_lanca_parcela' => $parcela,
                );
                $entrada = $metadata['hn_fin_insta_valor_entrada'][0];
                $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
                if(!empty($parcela)){
                    if(empty($entrada)){
                        $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0]/$insta_parcela;
                    }else{
                        if($parcela == 1){
                            $meta['hn_fin_lanca_valor'] = $entrada;
                        }else{
                            $meta['hn_fin_lanca_valor'] = ($metadata['hn_fin_insta_valor'][0] - $entrada)/($insta_parcela - 1);
                        }
                    }
                }
                $taxas = 0;
                if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
                    if(count($metadata['hn_fin_insta_taxas']) > 0){
                        $meta['hn_fin_lanca_taxas'] = array();
                        foreach($metadata['hn_fin_insta_taxas'] as $item2){
                            $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                            $meta['hn_fin_lanca_taxas'][] = $item2;
                        }
                    }
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'receita'){
                    $meta['hn_fin_lanca_centro_lucro'] = $servicodados['hn_fin_servicos_centro_lucro'][0];
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'despesa'){
                    $meta['hn_fin_lanca_centro_custo'] = $servicodados['hn_fin_servicos_centro_custo'][0];
                }
                $meta['hn_fin_lanca_valor'] += $taxas;
                $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
                // post padrão
                $data = str_replace("-", "", substr($datas[0], -8));
                $nome_servico = get_post_meta($metadata['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1);
                $nome_cliente = get_the_title( $metadata['hn_fin_insta_cliente'][0] );
                $post = array(
                    'post_title'    => $data . " | M | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $meta['hn_fin_lanca_valor'] . " | IS " . $item,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'hn_fin_lanca',
                );
                if($parcela != -1){
                    hn_fin_cria_lancamento($post, $meta);
                }
            }
        }
        /*if(count($listabimestre) > 0){
            $lista = $listabimestre;
            foreach($lista as $item){
                // post padrão
                $metadata = get_post_meta($item);
                $data = str_replace("-", "", substr($datas[0], -8));
                $nome_servico = get_post_meta($metadata['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1);
                $nome_cliente = get_the_title( $metadata['hn_fin_insta_cliente'][0] );
                $post = array(
                    'post_title'    => $data . " | B | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $meta['hn_fin_lanca_valor'] . " | IS " . $item,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'hn_fin_lanca',
                );
                // meta
                //$metadata = get_post_meta($item);
                $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
                $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
                $meta = array(
                    'hn_fin_lanca_tipo_lancamento' => 'receita',
                    'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
                    'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
                    'hn_fin_lanca_item_servico' => $item,
                    'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
                    'hn_fin_lanca_data' => $datas[0],
                    'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
                    'hn_fin_lanca_contabil' => $conta_contabil,
                );
                $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
                $taxas = 0;
                if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
                    if(count($metadata['hn_fin_insta_taxas']) > 0){
                        $meta['hn_fin_lanca_taxas'] = array();
                        foreach($metadata['hn_fin_insta_taxas'] as $item2){
                            $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                            $meta['hn_fin_lanca_taxas'][] = $item2;
                        }
                    }
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'receita'){
                    $meta['hn_fin_lanca_centro_lucro'] = $servicodados['hn_fin_servicos_centro_lucro'][0];
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'despesa'){
                    $meta['hn_fin_lanca_centro_custo'] = $servicodados['hn_fin_servicos_centro_custo'][0];
                }
                $meta['hn_fin_lanca_valor'] += $taxas;
                $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
                hn_fin_cria_lancamento($post, $meta);
            }
        }*/
        if(count($listatrimestre) > 0){
            $lista = $listatrimestre;
            foreach($lista as $item){
                // post padrão
                $metadata = get_post_meta($item);
                $data = str_replace("-", "", substr($datas[0], -8));
                $nome_servico = get_post_meta($metadata['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1);
                $nome_cliente = get_the_title( $metadata['hn_fin_insta_cliente'][0] );
                $post = array(
                    'post_title'    => $data . " | T | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $meta['hn_fin_lanca_valor'] . " | IS " . $item,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'hn_fin_lanca',
                );
                // meta
                //$metadata = get_post_meta($item);
                $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
                $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
                $meta = array(
                    'hn_fin_lanca_tipo_lancamento' => 'receita',
                    'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
                    'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
                    'hn_fin_lanca_item_servico' => $item,
                    'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
                    'hn_fin_lanca_data' => $datas[0],
                    'hn_fin_lanca_data_vencimento' => $datas[0],
                    'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
                    'hn_fin_lanca_contabil' => $conta_contabil,
                );
                $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
                $taxas = 0;
                if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
                    if(count($metadata['hn_fin_insta_taxas']) > 0){
                        $meta['hn_fin_lanca_taxas'] = array();
                        foreach($metadata['hn_fin_insta_taxas'] as $item2){
                            $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                            $meta['hn_fin_lanca_taxas'][] = $item2;
                        }
                    }
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'receita'){
                    $meta['hn_fin_lanca_centro_lucro'] = $servicodados['hn_fin_servicos_centro_lucro'][0];
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'despesa'){
                    $meta['hn_fin_lanca_centro_custo'] = $servicodados['hn_fin_servicos_centro_custo'][0];
                }
                $meta['hn_fin_lanca_valor'] += $taxas;
                $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
                hn_fin_cria_lancamento($post, $meta);
            }
        }
        /*if(count($listaquadrimestre) > 0){
            $lista = $listaquadrimestre;
            foreach($lista as $item){
                // post padrão
                $metadata = get_post_meta($item);
                $data = str_replace("-", "", substr($datas[0], -8));
                $nome_servico = get_post_meta($metadata['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1);
                $nome_cliente = get_the_title( $metadata['hn_fin_insta_cliente'][0] );
                $post = array(
                    'post_title'    => $data . " | Q | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $meta['hn_fin_lanca_valor'] . " | IS " . $item,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'hn_fin_lanca',
                );
                // meta
                //$metadata = get_post_meta($item);
                $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
                $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
                $meta = array(
                    'hn_fin_lanca_tipo_lancamento' => 'receita',
                    'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
                    'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
                    'hn_fin_lanca_item_servico' => $item,
                    'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
                    'hn_fin_lanca_data' => $datas[0],
                    'hn_fin_lanca_data_vencimento' => $datas[0],
                    'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
                    'hn_fin_lanca_contabil' => $conta_contabil,
                );
                $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
                $taxas = 0;
                if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
                    if(count($metadata['hn_fin_insta_taxas']) > 0){
                        $meta['hn_fin_lanca_taxas'] = array();
                        foreach($metadata['hn_fin_insta_taxas'] as $item2){
                            $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                            $meta['hn_fin_lanca_taxas'][] = $item2;
                        }
                    }
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'receita'){
                    $meta['hn_fin_lanca_centro_lucro'] = $servicodados['hn_fin_servicos_centro_lucro'][0];
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'despesa'){
                    $meta['hn_fin_lanca_centro_custo'] = $servicodados['hn_fin_servicos_centro_custo'][0];
                }
                $meta['hn_fin_lanca_valor'] += $taxas;
                $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
                hn_fin_cria_lancamento($post, $meta);
            }
        }*/
        if(count($listasemestre) > 0){
            $lista = $listasemestre;
            foreach($lista as $item){
                // post padrão
                $metadata = get_post_meta($item);
                $data = str_replace("-", "", substr($datas[0], -8));
                $nome_servico = get_post_meta($metadata['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1);
                $nome_cliente = get_the_title( $metadata['hn_fin_insta_cliente'][0] );
                $post = array(
                    'post_title'    => $data . " | S | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $meta['hn_fin_lanca_valor'] . " | IS " . $item,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'hn_fin_lanca',
                );
                // meta
                //$metadata = get_post_meta($item);
                $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
                $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
                $meta = array(
                    'hn_fin_lanca_tipo_lancamento' => 'receita',
                    'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
                    'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
                    'hn_fin_lanca_item_servico' => $item,
                    'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
                    'hn_fin_lanca_data' => $datas[0],
                    'hn_fin_lanca_data_vencimento' => $datas[0],
                    'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
                    'hn_fin_lanca_contabil' => $conta_contabil,
                );
                $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
                $taxas = 0;
                if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
                    if(count($metadata['hn_fin_insta_taxas']) > 0){
                        $meta['hn_fin_lanca_taxas'] = array();
                        foreach($metadata['hn_fin_insta_taxas'] as $item2){
                            $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                            $meta['hn_fin_lanca_taxas'][] = $item2;
                        }
                    }
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'receita'){
                    $meta['hn_fin_lanca_centro_lucro'] = $servicodados['hn_fin_servicos_centro_lucro'][0];
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'despesa'){
                    $meta['hn_fin_lanca_centro_custo'] = $servicodados['hn_fin_servicos_centro_custo'][0];
                }
                $meta['hn_fin_lanca_valor'] += $taxas;
                $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
                hn_fin_cria_lancamento($post, $meta);
            }
        }
        if(count($listaano) > 0){
            $lista = $listaano;
            foreach($lista as $item){
                // post padrão
                $metadata = get_post_meta($item);
                $data = str_replace("-", "", substr($datas[0], -8));
                $nome_servico = get_post_meta($metadata['hn_fin_insta_servico'][0], 'hn_fin_servicos_nome', 1);
                $nome_cliente = get_the_title( $metadata['hn_fin_insta_cliente'][0] );
                $post = array(
                    'post_title'    => $data . " | A | " . $nome_servico . " | " . $nome_cliente . " | R$ " . $meta['hn_fin_lanca_valor'] . " | IS " . $item,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'hn_fin_lanca',
                );
                // meta
                //$metadata = get_post_meta($item);
                $cliente = get_post_meta($metadata['hn_fin_insta_cliente'][0]);
                $conta_contabil = get_post_meta($metadata['hn_fin_insta_cliente'][0], 'hn_fin_financeiro_conta_contabil', 0);
                $meta = array(
                    'hn_fin_lanca_tipo_lancamento' => 'receita',
                    'hn_fin_lanca_favorecido' => $metadata['hn_fin_insta_emissor_nota'][0],
                    'hn_fin_lanca_servico' => $metadata['hn_fin_insta_servico'][0],
                    'hn_fin_lanca_item_servico' => $item,
                    'hn_fin_lanca_empresa' => $metadata['hn_fin_insta_cliente'][0],
                    'hn_fin_lanca_data' => $datas[0],
                    'hn_fin_lanca_data_vencimento' => $datas[0],
                    'hn_fin_lanca_dominio' => $metadata['hn_fin_insta_dominio'][0],
                    'hn_fin_lanca_contabil' => $conta_contabil,
                );
                $meta['hn_fin_lanca_valor'] = $metadata['hn_fin_insta_valor'][0];
                $taxas = 0;
                if($metadata['hn_fin_insta_tipo_valor'][0] == 'liquido'){
                    if(count($metadata['hn_fin_insta_taxas']) > 0){
                        $meta['hn_fin_lanca_taxas'] = array();
                        foreach($metadata['hn_fin_insta_taxas'] as $item2){
                            $taxas += get_post_meta($item2, 'hn_fin_taxas_valor',1) * $metadata['hn_fin_insta_valor'][0];
                            $meta['hn_fin_lanca_taxas'][] = $item2;
                        }
                    }
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'receita'){
                    $meta['hn_fin_lanca_centro_lucro'] = $servicodados['hn_fin_servicos_centro_lucro'][0];
                }
                if($servicodados['hn_fin_servicos_receita_despesa'][0] == 'despesa'){
                    $meta['hn_fin_lanca_centro_custo'] = $servicodados['hn_fin_servicos_centro_custo'][0];
                }
                $meta['hn_fin_lanca_valor'] += $taxas;
                $meta['hn_fin_lanca_valor'] = round($meta['hn_fin_lanca_valor'], 2);
                hn_fin_cria_lancamento($post, $meta);
            }
        }
        wp_die();
    }
}
function geraTimestamp($data) {
    $partes = explode('/', $data);
    return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}

if(!function_exists("hn_fin_cria_lancamento")){
    function hn_fin_cria_lancamento($post, $meta){
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
        $valor = $meta['hn_fin_lanca_valor'];
        
        /*
        echo '<script>window.open("http://hngrupo.com.br/financeiro/wp-content/plugins/hn_financeiro/boleto/boleto_santander_banespa1.php?sacado='. $nome .'&endereco_1='. $endereco1 .'&endereco_2='. $endereco2 .'&demonstrativo_1='. $demonstrativo_1 .'&demonstrativo_2='. $demonstrativo_2 .'&demonstrativo_3='. $demonstrativo_3 .'&instrucoes_1='. $instrucoes_1 .'&instrucoes_2='. $instrucoes_2 .'&instrucoes_3='. $instrucoes_3 .'&instrucoes_4='. $instrucoes_4 .'&nosso_numero=' . $nosso_numero .'&vencimento=' . $vencimento .'&valor=' . $valor .'&post_id=' . $cod .'");</script>';
        */
        
        foreach($meta as $key => $item){
            if($key == "hn_fin_lanca_taxas"){
                foreach($item as $itemd){
                    add_post_meta($cod, 'hn_fin_lanca_taxas', $itemd);
                }
            }else{
                update_post_meta($cod, $key, $item);
            }
        }
    }
}

if(!function_exists("hn_fin_gerar_boleto")){
    function hn_fin_gerar_boleto(){
        
        
        $id = 655;
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
        $demonstrativo_1 = " ";
        $demonstrativo_2 = " ";
        $demonstrativo_3 = " ";
        $instrucoes_1 = " ";
        $instrucoes_2 = " ";
        $instrucoes_3 = " ";
        $instrucoes_4 = " ";
        
        echo '<script>window.open("http://hngrupo.com.br/financeiro/wp-content/plugins/hn_financeiro/boleto/boleto_santander_banespa1.php?sacado='. $nome .'&endereco_1='. $endereco1 .'&endereco_2='. $endereco2 .'&demonstrativo_1='. $demonstrativo_1 .'&demonstrativo_2='. $demonstrativo_2 .'&demonstrativo_3='. $demonstrativo_3 .'&instrucoes_1='. $instrucoes_1 .'&instrucoes_2='. $instrucoes_2 .'&instrucoes_3='. $instrucoes_3 .'&instrucoes_4='. $instrucoes_4 .'&");</script>';
    }
}

if(!function_exists("hn_fin_pg_controle_pagamento")){
    function hn_fin_pg_controle_pagamento(){
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <div class="rwmb-input">
            <input required="" class="rwmb-date hasDatepicker" name="data_venc" value="" id="dp1425416455197" size="30" data-options="{&quot;dateFormat&quot;:&quot;yy-mm-dd&quot;,&quot;showButtonPanel&quot;:true,&quot;appendText&quot;:&quot;(yyyy-mm-dd)&quot;,&quot;changeMonth&quot;:true,&quot;changeYear&quot;:true}" type="text">
            <span class="ui-datepicker-append">(yyyy-mm-dd)</span>
        </div>
        
            <!--Dia<input type="text" name="dia" /><br />
            Mes<input type="text" name="mes" /><br />
            Ano<input type="text" name="ano" /><br />-->
            <input type="hidden" value="controlepagamento" name="page" />
            <input type="submit" name="dados" id="botao" value="Gerar Relatório" />
        </form>
        <?php
        if(isset($_REQUEST['dados'])){
            $lista = hn_fin_relatorio_controle_pagamento($_REQUEST['data_venc']);
            
            /*echo "<pre>";
            print_r ($lista);
            echo "</pre>";*/
            
            echo "<table border='1'>";
            echo "<td > ID </td>";
            echo "<td> Data </td>";
            echo "<td> Nome/Empresa </td>";
            echo "<td> CPF/CNPJ </td>";
            echo "<td> Endereço Completo </td>";
            echo "<td> Serviço </td>";
            echo "<td> Ciclo </td>";
            echo "<td> Email </td>";
            echo "<td> Dominio </td>";
            echo "<td> Nome do Cliente </td>";
            echo "<td> Ação Pagar </td>";
            echo "<td> Ação Cancelar </td>";
            echo "<td> Ação Suspender </td>";
            echo "<td> Ação Cobrar </td>";
            echo "<td> Nota Fiscal </td>";
            echo "<td> Ação Emitir 2a via </td>";
            echo "<td> Acão Enviar nova fatura</td>";
            echo "<td> Valor </td>";
            $valor = 0;
            $count = 0;
            foreach($lista as $item){
                $count ++;
                ?>
                <tr style="<?php if($count%2 == 0){ echo 'par'; } ?>">
                <?php
                //echo "<tr>";
                    //ID LANCAMENTO
                    $id_lancamento = $item;
                    echo "<td>" . $id_lancamento . "</td>";
                    $datavenc = get_post_meta($item, 'hn_fin_lanca_data_vencimento', 1);
                    $id_empresa = get_post_meta($item, 'hn_fin_lanca_empresa', 1);
                    if(get_post_meta($id_empresa,'hn_fin_financeiro_tipo_pessoa', 1) == "fisica"){
                        $nome = get_post_meta($id_empresa,'hn_fin_financeiro_nome', 1);
                        $identificacao = get_post_meta($id_empresa,'hn_fin_financeiro_cpf', 1);
                    }else{
                        $nome = get_post_meta($id_empresa,'hn_fin_financeiro_razao_social', 1);
                        $identificacao = get_post_meta($id_empresa,'hn_fin_financeiro_cnpj', 1);
                    }
                    echo "<td>" . $datavenc . "</td>";
                    echo "<td>" . $nome . "</td>";
                    echo "<td>" . $identificacao . "</td>";
                    //ENDERECO
                    //endereco, numero, complemento, bairro, cidade, estado, cep
                    $endereco = get_post_meta($id_empresa,'hn_fin_financeiro_endereco', 1);
                    $numero = get_post_meta($id_empresa,'hn_fin_financeiro_numero', 1);
                    $complemento = get_post_meta($id_empresa,'hn_fin_financeiro_complemento', 1);
                    $bairro = get_post_meta($id_empresa,'hn_fin_financeiro_bairro', 1);
                    $cidade = get_post_meta($id_empresa,'hn_fin_financeiro_cidade', 1);
                    $cep = get_post_meta($id_empresa,'hn_fin_financeiro_cep', 1);
                    $nota = get_post_meta($id_lancamento,'hn_fin_lanca_nota_fiscal', 1);
                    $valor = get_post_meta($id_lancamento,'hn_fin_lanca_valor', 1);
                    /*echo "ENDERECO: " . $endereco . "<br />";
                    echo "NUMERO: " . $numero . "<br />";
                    echo "COMPLEMENTO: " . $complemento . "<br />";
                    echo "BAIRRO: " . $bairro . "<br />";
                    echo "CIDADE: " . $cidade . "<br />";
                    echo "CEP: " . $cep . "<br />";*/
                    echo "<td>" . $endereco . ", Número: " .$numero . ", Complemento: " .$complemento . ", " .$bairro . ", " . $cidade . ", " . $cep . "</td>";
                    //SERVICO
                    $id_servico = get_post_meta($item,'hn_fin_lanca_servico', 1);
                    $servico = get_post_meta($id_servico, 'hn_fin_servicos_nome', 1);
                    //echo "SERVICO: " . $servico . "<br />";
                    echo "<td>" . $servico . "</td>";
                    //CICLO
                    $id_insta = get_post_meta($item,'hn_fin_lanca_item_servico', 1);
                    $id_ciclo = get_post_meta($id_insta,'hn_fin_insta_ciclo', 1);
                    $ciclo = get_post_meta($id_ciclo,'hn_fin_ciclo_nome', 1);
                    //echo "CICLO: " . $ciclo . "<br />";
                    echo "<td>" . $ciclo . "</td>";
                    //EMAIL
                    $email = get_post_meta($id_empresa,'hn_fin_financeiro_email', 1);
                    //echo "EMAIL: " . $email . "<br />";
                    echo "<td>" . $email . "</td>";
                    //DOMINIO
                    $dominio = get_post_meta($id_insta,'hn_fin_insta_dominio', 1);
                    //echo "DOMINIO: " . $dominio . "<br />";
                    echo "<td>" . $dominio . "</td>";
                    //NOME DO CLIENTE
                    $nome_cliente = get_post_meta($id_empresa,'hn_fin_financeiro_nome_cliente', 1);
                    //echo "NOMECLIENTE: " . $nomecliente . "<br />";
                    echo "<td>" . $nome_cliente . "</td>";
                    echo "<td> <input class='ajax-controle' type='button' id='pago' name='pago' value='pago' acao='hn_fin_acao_pagar' cod='".$id_lancamento."'  /> </td>";
                    echo "<td> <input class='ajax-controle' type='button' id='cancelado' name='cancelado' value='cancelado' acao='hn_fin_acao_cancelar' cod='".$id_lancamento."'  /> </td>";
                    echo "<td> <input class='ajax-controle' type='button' id='suspenso' name='suspenso' value='suspenso' acao='hn_fin_acao_suspender' cod='".$id_lancamento."' /> </td>";
                    echo "<td> <input class='ajax-controle' type='button' id='cobranca' name='cobranca' value='cobranca' acao='hn_fin_acao_cobrar' cod='".$id_lancamento."' /> </td>";
                    echo "<td> <input class='nota-fiscal' type='text' id='".$id_lancamento."' value='".$nota."' /> <input cod='".$id_lancamento."' acao='hn_fin_acao_atualizar_nota' value='OK' class='ajax-controle' type='button' /> </td>";
                    echo "<td> <input class='ajax-controle' type='button' id='".$id_lancamento."' name='emitir-segunda-via' value='Emitir Segunda Via' acao='hn_fin_acao_emitir_segunda_via' cod='".$id_lancamento."' /> </td>";
                    echo "<td> <input value='5' class='valor_multa' type='text' id='multa-".$id_lancamento."' name='multa' /><input placeholder='Data Venc.: 2016-05-17' class='data_vencimento' type='text' id='nova-".$id_lancamento."' name='nova-data-vencimento' /><input class='ajax-controle-nova-fatura' type='button' id='".$id_lancamento."' name='nova_fatura' value='Nova Fatura' acao='hn_fin_acao_nova_fatura' cod='".$id_lancamento."' /> </td>";
                    echo "<td> R$ " . $valor . "</td>";
                echo "</tr>";
                //$valortotal .= $valor;
                //$total = $total + $count;
            }
            echo "<tr><td>" . $count; "</td></tr>";
            echo "</table>";
        }
    }
}

if(!function_exists("hn_fin_relatorio_controle_pagamento")){
    function hn_fin_relatorio_controle_pagamento($data_venc){
        $args = array(
          'post_type' => 'hn_fin_lanca',
          'post_status' => 'publish',
          'nopaging' => true,
          'meta_query' => array(
                array(
                    'key'     => 'hn_fin_lanca_data',
                    'value'   => $data_venc,
                    'compare' => '=',
                ),
                array(
                    'key'     => 'hn_fin_lanca_baixa',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        );
        
        $query = null;
        $query = new WP_Query($args);
        
        $lista = array();        
        foreach($query->posts as $item){
            $lista[] = $item->ID;
        }
        return $lista;
    }
}

if(!function_exists('create_hn_fin_controle')){
    function create_hn_fin_controle(){        
        $temp = explode('/', $_SERVER['REQUEST_URI']);
        $temp2 = explode('?', $temp[count($temp)-1]);
        if($temp2[0] == 'admin.php'){
            $temp3 = explode('&', $temp2[1]);
            $listavars = array();
            foreach ($temp3 as $item){
                $temp4 = explode('=', $item);
                $listavars[$temp4[0]] = $temp4[1];
            }
        }
        if(isset($listavars['page'])){
            if($listavars['page'] == 'controlepagamento'){
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery(".ajax-controle").on( "click", function(){
                            jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                ,{
                                    action: jQuery(this).attr('acao'), 
                                    id: jQuery(this).attr('cod'),
                                    nota: jQuery("#"+jQuery(this).attr('cod')).val()
                                }, function(data){
                                    //jQuery("#hn_fin_insta_valor").val(data)
                                    alert('Ação realizada')
                                }
                            );
                        });
                        jQuery(".ajax-controle-nova-fatura").on( "click", function(){
                            jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                ,{
                                    action: jQuery(this).attr('acao'), 
                                    id: jQuery(this).attr('cod'),
                                    valor_multa: jQuery("#multa-"+jQuery(this).attr('cod')).val(),
                                    nova_fatura: jQuery("#nova-"+jQuery(this).attr('cod')).val()
                                }, function(data){
                                    //jQuery("#hn_fin_insta_valor").val(data)
                                    alert('Ação realizada-2')
                                }
                            );
                        });
                    });
                </script>
                <?php
            }
        }if(isset($listavars['page'])){
            if($listavars['page'] == 'servicoscliente'){
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery("#hn_fin_financeiro_conta_contabil").change(function() {
                            //alert(jQuery(this).val())
                            jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                ,{
                                    action: 'hn_fin_servicos_cliente', 
                                    id: jQuery(this).val()
                                    //nota: jQuery("#"+jQuery(this).attr('cod')).val()
                                }, function(data){
                                    //jQuery("#hn_fin_insta_valor").val(data)
                                    //alert(data)
                                    jQuery('#resultado').html(data);
                                }
                            );
                        });
                    });
                </script>
                <?php
            }
        }if(isset($listavars['page'])){
            if($listavars['page'] == 'inventarioservicos'){
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery("input[name='inventario']").change(function() {
                            //alert(jQuery(this).val())
                            jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                ,{
                                    action: jQuery(this).attr('id'), 
                                    id: jQuery(this).val()
                                    //nota: jQuery("#"+jQuery(this).attr('cod')).val()
                                }, function(data){
                                    //jQuery("#hn_fin_insta_valor").val(data)
                                    //alert(data)
                                    jQuery('#resultado').html(data);
                                }
                            );
                        });
                    });
                </script>
                <?php
            }
        }if(isset($listavars['page'])){
            if($listavars['page'] == 'lucrodespesa'){
                ?>
                <script type="text/javascript">
                    /*jQuery(document).ready(function(){
                        jQuery("input[name='receitadespesa']").change(function() {
                            //alert(jQuery(this).val())
                            jQuery.post("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php"
                                ,{
                                    action: 'hn_fin_lucro_despesa', 
                                    tipo: jQuery(this).val()
                                    
                                    //nota: jQuery("#"+jQuery(this).attr('cod')).val()
                                }, function(data){
                                    //jQuery("#hn_fin_insta_valor").val(data)
                                    //alert(data)
                                    jQuery('#resultado').html(data);
                                }
                            );
                        });
                        jQuery(".reativar").on( "click", function(){
                            alert("ok")
                        });
                    });*/
                </script>
                <?php
            }
        }
    }
}
add_action( 'admin_footer', 'create_hn_fin_controle' );

if(!function_exists("hn_fin_pg_cabecalho")){
    function hn_fin_pg_cabecalho(){
        wp_enqueue_style( 'select2', RWMB_CSS_URL . 'select2/select2.css', array(), '3.2' );
        wp_enqueue_style( 'rwmb-select-advanced', RWMB_CSS_URL . 'select-advanced.css', array(), RWMB_VER );
        wp_register_script( 'select2', RWMB_JS_URL . 'select2/select2.min.js', array(), '3.2', true );
        wp_enqueue_script( 'rwmb-select-advanced', RWMB_JS_URL . 'select-advanced.js', array( 'select2' ), RWMB_VER, true );
        
        $url = RWMB_CSS_URL . 'jqueryui';
        wp_register_style( 'jquery-ui-core', "{$url}/jquery.ui.core.css", array(), '1.8.17' );
        wp_register_style( 'jquery-ui-theme', "{$url}/jquery.ui.theme.css", array(), '1.8.17' );
        wp_enqueue_style( 'jquery-ui-datepicker', "{$url}/jquery.ui.datepicker.css", array( 'jquery-ui-core', 'jquery-ui-theme' ), '1.8.17' );
        // Load localized scripts
        $locale     = str_replace( '_', '-', get_locale() );
        $file_paths = array( 'jqueryui/datepicker-i18n/jquery.ui.datepicker-' . $locale . '.js' );
        // Also check alternate i18n filename (e.g. jquery.ui.datepicker-de.js instead of jquery.ui.datepicker-de-DE.js)
        if ( strlen( $locale ) > 2 )
                $file_paths[] = 'jqueryui/datepicker-i18n/jquery.ui.datepicker-' . substr( $locale, 0, 2 ) . '.js';
        $deps = array( 'jquery-ui-datepicker' );
        foreach ( $file_paths as $file_path )
        {
            if ( file_exists( RWMB_DIR . 'js/' . $file_path ) )
            {
                wp_register_script( 'jquery-ui-datepicker-i18n', RWMB_JS_URL . $file_path, $deps, '1.8.17', true );
                $deps[] = 'jquery-ui-datepicker-i18n';
                break;
            }
        }
        wp_enqueue_script( 'highcharts', 'http://code.highcharts.com/highcharts.js', array());
        wp_enqueue_script( 'highcharts-drilldown', 'http://code.highcharts.com/modules/drilldown.js', array());
        wp_enqueue_script( 'highcharts-exporting', 'http://code.highcharts.com/modules/exporting.js', array());
    }
}
add_action( 'admin_enqueue_scripts', 'hn_fin_pg_cabecalho' );

if(!function_exists("hn_fin_pg_serv_cli")){
    function hn_fin_pg_serv_cli(){
        ?>
        <div class="rwmb-input" style="margin-top: 20px !important;">
            <div style="width: auto;" id="s2id_hn_fin_financeiro_conta_contabil" class="select2-container rwmb-select-advanced">
                <a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">
                    <span id="select2-chosen-1" class="select2-chosen">Selecione um favorecido</span>
                    <abbr class="select2-search-choice-close"></abbr>
                    <span class="select2-arrow" role="presentation">
                        <b role="presentation"></b>
                    </span>
                </a>
                <label for="s2id_autogen1" class="select2-offscreen">Conta Contábil</label>
                <input id="s2id_autogen1" aria-labelledby="select2-chosen-1" class="select2-focusser select2-offscreen" aria-haspopup="true" role="button" type="text">
            </div>
            <select style="display: none;" title="Conta Contábil" tabindex="-1" required="" class="rwmb-select-advanced" name="hn_fin_financeiro_conta_contabil" id="hn_fin_financeiro_conta_contabil" size="0" data-options="{&quot;allowClear&quot;:true,&quot;width&quot;:&quot;resolve&quot;,&quot;placeholder&quot;:&quot;Selecione um favorecido&quot;}">
                <option></option>
                <?php
                // query
                $args = array(
                    'post_type' => 'hn_fin_financeiro',
                    'post_status' => 'publish',
                );
                $query = null;
                $query = new WP_Query($args);
                $lista = array();        
                foreach($query->posts as $item){
                    $lista[] = $item->ID;
                    echo "<option class='servicos-empresa' value='" . $item->ID . "'>" . $item->post_title . "</option>";
                }
                ?>
            </select>
        </div>
            <div id="legenda" style="margin-top: 15px;">
                <span style="background-color: yellow; padding: 5px;">Suspensos</span>
                <span style="color: white; margin-left: 10px; padding: 5px; background-color: red;">Cancelados</span>
            </div>
        <div id="resultado" style="margin-top: 20px;"></div>
        <?php
    }
}

if(!function_exists("hn_fin_pg_invent_servicos")){
    function hn_fin_pg_invent_servicos(){
    ?>
        <div id="content" style="padding: 5px;">
            Tudo<input id="hn_fin_instancias_tudo" type="radio" name="inventario" value="tudo" />
            Ativos<input id="hn_fin_instancias_ativos" type="radio" name="inventario" value="ativos" />
            Suspensos<input id="hn_fin_instancias_suspensos" type="radio" name="inventario" value="suspensos" />
            Cancelados<input id="hn_fin_instancias_cancelados" type="radio" name="inventario" value="cancelados" />
            
            <div id="legenda" style="margin-top: 15px;">
                <span style="background-color: yellow; padding: 5px;">Suspensos</span>
                <span style="color: white; margin-left: 10px; padding: 5px; background-color: red;">Cancelados</span>
            </div>
            <div id="resultado" style="margin-top: 15px;"></div>
        
        </div>    
    <?php
    }
}
if(!function_exists("hn_fin_pg_lucro_despesa")){
    function hn_fin_pg_lucro_despesa(){
    ?>
        <div id="content" style="padding: 5px;">
            Tudo<input id="hn_fin_instancias_tudo" type="radio" name="receitadespesa" value="tudo" />
            Receita<input id="hn_fin_instancias_tudo" type="radio" name="receitadespesa" value="receita" />
            Despesas<input id="hn_fin_instancias_ativos" type="radio" name="receitadespesa" value="despesa" />
            
            <div id="resultado" style="margin-top: 15px;"></div>
        </div>
    <?php
    }
}
if(!function_exists("hn_fin_pg_processar_lancamento")){
    function hn_fin_pg_processar_lancamento(){
    ?>
        <div id="content" style="padding: 5px;">
            <form action="<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php">
                05<input type="radio" name="dia" value="5" required="true" />
                10<input type="radio" name="dia" value="10" />
                15<input type="radio" name="dia" value="15" />
                20<input type="radio" name="dia" value="20" />
                25<input type="radio" name="dia" value="25" />
                28<input type="radio" name="dia" value="28" />
                <input type="submit" name="enviar" value="Enviar"/>
                <input type="hidden" name="action" value="hn_fin_processamento_fatura"/>
            </form>
            
            <div id="resultado" style="margin-top: 15px;"></div>
        </div>
    <?php
    }
}
if(!function_exists("hn_fin_pg_rel_gerencial")){
    function hn_fin_pg_rel_gerencial(){
    ?>
        <div id="container" style="width:97%; height:400px;"></div>
        <script>
            jQuery(function () {
                jQuery('#container').highcharts({
                    chart: {
                        type: 'column',//'spline'
                        //zoomType: 'xy'
                    },
                    title: {
                        text: 'Evolução mensal do resultado'
                    },
                    subtitle: {
                        text: 'Fonte: Apenas um teste'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'top',
                        x: 100,
                        y: 0,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                    },
                    xAxis: {
                        categories: [
                            'Janeiro'
                            ,'Fevereiro'
                            ,'Março'
                            ,'Abril'
                            ,'Maio'
                            ,'Junho'
                            ,'Julho'
                            ,'Agosto'
                            ,'Setembro'
                            ,'Outubro'
                            ,'Novembro'
                            ,'Dezembro'
                        ],
                        /*
                        plotBands: [{ // visualize the weekend
                            from: 4.5,
                            to: 6.5,
                            color: 'rgba(68, 170, 213, .2)'
                        }]
                        */
                    },
                    yAxis: {
                        title: {
                            text: 'R$ k'
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true,
                        valuePrefix: 'R$ ',
                        valueSuffix: ' k',
                        /*
                        formatter: function() {
                            return 'The value for <b>' + this.x + '</b> is <b>' + this.y + '</b>, in series '+ this.series.name;
                        }
                        */
                    },
                    credits: {
                        enabled: false
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                radius: 4,
                                lineColor: 'rgba(68, 170, 213, .2)',
                                lineWidth: 1
                            }
                        },
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    series: [{
                        name: 'Receita',
                        data: [{
                            name: 'Receita Janeiro',
                            y: 10,
                            drilldown: 'rec_jan',
                        },{
                            name: 'Receita Fevereiro',
                            y: 10,
                            drilldown: 'rec_fev',
                        },
                        11,
                        10,
                        13,
                        15,
                        16,
                        17,
                        16,
                        18,
                        17,
                        15],
                        stack: 'resultado'
                    }, {
                        name: 'Despesa',
                        data: [{
                            y: -13,
                            drilldown: 'desp_jan',
                        },{
                            name: 'Despesa Fevereiro',
                            y: -12,
                            drilldown: 'desp_fev',
                        },
                        -15,
                        -13,
                        -14,
                        -12,
                        -11,
                        -11,
                        -10,
                        -10,
                        -9,
                        -10],
                        stack: 'resultado'
                    }],
                    drilldown: {
                        activeDataLabelStyle: {
                            textDecoration: 'none',
                            color: '#fff',
                            fontWeight: 'bold',
                        },
                        series: [{
                            id: 'rec_jan',
                            name: 'Receita Janeiro',
                            data: [
                                2,
                                2,
                                2,
                                2,
                                2
                            ],
                        }, {
                            id: 'desp_jan',
                            data: [
                                3,
                                3,
                                1,
                                3,
                                3,
                            ],
                        }, {
                            id: 'rec_fev',
                            data: [
                                ['Cats', 3],
                                ['Dogs', 4],
                                ['Cows', 3],
                            ],
                        }, {
                            id: 'desp_fev',
                            data: [
                                ['Cats', -3],
                                ['Dogs', -3],
                                ['Cows', -3],
                                ['Sheep', -3],
                            ],
                        }]
                    },
                });
            });
            Highcharts.theme = {
                colors: ['#50B432', '#ED561B', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
            };
            
            // Apply the theme
            Highcharts.setOptions(Highcharts.theme);
        </script>
    <?php
    }
}

?>