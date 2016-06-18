<?php
/**
 * classe abtrata para criação de post types
 */
if(!class_exists('PostType')){
	abstract class PostType {
		/*
		 * Variáveis
		 * hook 	- string -
		 * argument - array
		 * 		label				-	string
		 * 		singular_label		-	string
		 * 		public				-	boolean
		 * 		show_ui				-	boolean
		 * 		capability_type		-	string
		 * 		exclude_from_search	-	boolen
		 * 		hierarchical		-	boolean
		 * 		rewrite				-	boolean
		 * 		supports 			-	array
		 */	
		private $hook;
		private $argument;
		
		private function __construct(String $hook, Array $argument) {
			if(!is_string($hook)){
				throw new Exception('Erro 11 - O parametro "hook" de PostType deve ser uma string');
			}else{
				if(count_chars($hook) > 20){
					throw new Exception('Erro 12 - O parametro "hook" de PostType deve ser uma string com no máximo');
				}
			}
			if(!is_array($argument)){
				throw new Exception('Erro 1 - O parametro "argument" de PostType deve ser um array para criação de um post type');
			}else{
				if(!isset($argument['label'])){
					throw new Exception('Erro 2 - A lista de parametros do array deve conter "label"  para criação de um post type');
				}
				if(!isset($argument['singular_label'])){
					throw new Exception('Erro 3 - A lista de parametros do array deve conter "singular_label"  para criação de um post type');
				}
				if(!isset($argument['public'])){
					throw new Exception('Erro 4 - A lista de parametros do array deve conter "public"  para criação de um post type');
				}
				if(!isset($argument['show_ui'])){
					throw new Exception('Erro 5 - A lista de parametros do array deve conter "show_ui"  para criação de um post type');
				}
				if(!isset($argument['capability_type'])){
					throw new Exception('Erro 6 - A lista de parametros do array deve conter "capability_type"  para criação de um post type');
				}
				if(!isset($argument['exclude_from_search'])){
					throw new Exception('Erro 7 - A lista de parametros do array deve conter "exclude_from_search"  para criação de um post type');
				}
				if(!isset($argument['hierarchical'])){
					throw new Exception('Erro 8 - A lista de parametros do array deve conter "hierarchical"  para criação de um post type');
				}
				if(!isset($argument['rewrite'])){
					throw new Exception('Erro 9 - A lista de parametros do array deve conter "rewrite"  para criação de um post type');
				}
				if(!isset($argument['supports'])){
					throw new Exception('Erro 10 - A lista de parametros do array deve conter "supports"  para criação de um post type');
				}
			}
			$this->hook = $hook;
			$this->argument = $argument;
			$this->register();
		}
		protected function addAction(){
			add_action('init', array($this, 'register'));
		}
		protected function register()
		{
			register_post_type($this->hook, $this->fin_args);
		}
		abstract protected function configure(); 
	}
}
?>