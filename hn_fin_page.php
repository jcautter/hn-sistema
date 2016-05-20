<?php

if(!function_exists('create_'.RADICALFIN.'_pages')){
    function create_hn_fin_pages(){
        add_menu_page(
            'Controle de Pagamento',
            'Controle de Pagamento',
            RADICALFIN.'_pg_controle_pagamento',
            'controlepagamento',
            RADICALFIN.'_pg_controle_pagamento',
            plugins_url('myplugin/images/icon.png'),
            2
            
        );
        add_menu_page(
            'Serviços de um Cliente',
            'Serviços de um Cliente',
            RADICALFIN.'_pg_serv_cli',
            'servicoscliente',
            RADICALFIN.'_pg_serv_cli',
            plugins_url('myplugin/images/icon.png'),
            3
            
        );
        add_menu_page(
            'Inventário de Serviços',
            'Inventário de Serviços',
            RADICALFIN.'_pg_invent_servicos',
            'inventarioservicos',
            RADICALFIN.'_pg_invent_servicos',
            plugins_url('myplugin/images/icon.png'),
            4
        );
        add_menu_page(
            'Lucros e Despesas',
            'Lucros e Despesas',
            RADICALFIN.'_pg_lucro_despesa',
            'lucrodespesa',
            RADICALFIN.'_pg_lucro_despesa',
            plugins_url('myplugin/images/icon.png'),
            5
        );
        add_menu_page(
            'Processar Lançamento',
            'Processar Lançamento',
            RADICALFIN.'_pg_processar_lancamento',
            'processarlancamento',
            RADICALFIN.'_pg_processar_lancamento',
            plugins_url('myplugin/images/icon.png'),
            6
        );
        add_menu_page(
            'Relatório Gerencial',
            'Relatório Gerencial',
            RADICALFIN.'_pg_rel_gerencial',
            'rel_gerencial',
            //RADICALFIN.'_pg_rel_gerencial',
            'hn_fin_gerar_boleto',
            plugins_url('myplugin/images/icon.png'),
            7
        );
        add_menu_page(
            'Gerar Boleto',
            'Gerar Boleto',
            RADICALFIN.'_pg_gera_boleto',
            'gera_boleto',
            RADICALFIN.'_pg_gera_boleto',
            plugins_url('myplugin/images/icon.png'),
            8
        );
        add_menu_page(
            'Mover Boletos',
            'Mover Boeltos',
            RADICALFIN.'_pg_move_boletos',
            'move_boletos',
            RADICALFIN.'_pg_move_boletos',
            plugins_url('myplugin/images/icon.png'),
            9
        );
        /*add_menu_page(
            'TEMPORARIO',
            'TEMPORARIO',
            RADICALFIN.'_pg_temporario',
            'temporario',
            RADICALFIN.'_pg_temporario',
            plugins_url('myplugin/images/icon.png'),
            9.2
        );*/
        
        /*add_menu_page(
            'Home',
            'Home',
            RADICALRAIZENF1.'_pg_pagehome',
            'f1home',
            RADICALRAIZENF1.'_pagehome',
            plugins_url('myplugin/images/icon.png'),
            2
            
        );
        add_menu_page(
            'Retirada de Convites',
            'Retirada de Convites',
            RADICALRAIZENF1.'_pg_pageretiradaconvite',
            'f1retiradaconvite',
            RADICALRAIZENF1.'_pageretiradaconvite',
            plugins_url('myplugin/images/icon.png'),
            3
        );
        add_menu_page(
            'Convite Criado',
            'Convite Criado',
            RADICALRAIZENF1.'_pg_convitecriado',
            'f1convitecriado',
            RADICALRAIZENF1.'_pageconvitecriado',
            plugins_url('myplugin/images/icon.png'),
            4
        );
        add_menu_page(
            'Auxilio2',
            'Auxilio2',
            RADICALRAIZENF1.'_pg_auxilio2',
            'f1auxilio2',
            RADICALRAIZENF1.'_pageauxilio2',
            plugins_url('myplugin/images/icon.png'),
            5
        );*/
    }
    add_action('admin_menu','create_'.RADICALFIN.'_pages');
}
?>