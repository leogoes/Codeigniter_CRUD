<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */






	/*
	*****************************************************
	***********Função para retorno Info from DB**********
	*****************************************************
	*/
	public function index()
	{




		
		$this->load->model('Doc_info');
		$doc_users_info = $this->Doc_info->showDocs();
		$doc_users_especialidade = $this->Doc_info->getEspecialidades();
		$doc_users_roles = $this->Doc_info->getRoles();
		$doc_users_estados = $this->Doc_info->getEstados();
		$doc_users_cidades = $this->Doc_info->getCidades();
		
		
		$this->load->view('welcome_message', 
		['doc_users_info' => $doc_users_info, 
		 'doc_users_especialidade' => $doc_users_especialidade,
		 'doc_users_roles' => $doc_users_roles,
		 'doc_users_estados' => $doc_users_estados,
		 'doc_users_cidades' => $doc_users_cidades,
		]);

	}

	/*
	************************************************************************************
	***********Função para pegar especialidades info from DB e retornar para ***********
	************************************************************************************
	*/

	public function create()
	{
		$this->load->model('Doc_info');
		$doc_users_especialidade = $this->Doc_info->getEspecialidades();
		$doc_users_estados = $this->Doc_info->getEstados();
		$doc_users_cidades = $this->Doc_info->getCidades();
		$this->load->view('doc-form-newuser',['doc_users_especialidade' => $doc_users_especialidade,
											  'doc_users_estados' => $doc_users_estados,
											  'doc_users_cidades' => $doc_users_cidades,] );
		
	}
	
	/*
	*****************************************************
	***********Função para validação de dados ***********
	*****************************************************
	*/
	public function validarDados()
	{

		// Validação dos dados do formulário
		$this->form_validation->set_rules(
			'doc_nome', 
			'', 'required', array("required" => "Necessário inserir o nome para o cadastro do(a) médico(a)")
		 );
		$this->form_validation->set_rules(
			'doc_crm', 
			'', 'required|min_length[4]|max_length[10]', array("required" => "Inserir o numero para o cadastro do(a) médico(a)",
															   'required|min_length[4]' => 'Mínimo de 4 digítos',
															   'require|max_length[10]' => 'Máximo de 10 digítos')
		 );
		
		 $this->form_validation->set_rules(
			'doc_sexo', 
			'', 'required', array("required" => "Inserir o sexo para o cadastro do(a) médico(a)")
		 );
		$this->form_validation->set_rules(
			'doc_idade', 
			'', 'required', array("required" => "Inserir a idade para o cadastro do(a) médico(a)")
		 );
		$this->form_validation->set_rules(
			'doc_telefone', 
			'', 'required', array("required" => "Inserir o telefone para o cadastro do(a) médico(a)")
		 );
		$this->form_validation->set_rules(
			'doc_especialidades[]', 
			'', 'required', array("required" => "Inserir as especialidades para o cadastro do(a) médico(a)")
		 );
		 
		 /**
		 *  Carregar o modelo para integrar informaçoes da tabela 'doc_especialidades' 
		 *  para criar um checkbox dinâmico
		 * 
		 **/
		 $this->load->model('Doc_info');
		 $doc_users_especialidade = $this->Doc_info->getEspecialidades();
		//  $this->load->view('doc-form-newuser', ['doc_users_especialidade' => $doc_users_especialidade] );


		/**
		 * Statement para a validação dos dados
		 * preenchidos no formulário de novo usuario
		 * 
		 */
		
		 if ($this->form_validation->run()) {
			//informações do formulario preenchido em => 'doc-form-newuser'
			$doc_new_user = array(
			  		'doc_nome' => $this->input->post('doc_nome'),
			  		'doc_crm' => $this->input->post('doc_crm'),
			  		'doc_sexo' => $this->input->post('doc_sexo'),
			  		'doc_idade' => $this->input->post('doc_idade'),
			  		'doc_telefone' => $this->input->post('doc_telefone'),
			  		// 'doc_especialidades' => implode(",",$this->input->post('doc_especialidades[]')),
			);

			/**
			 * 
			 * unset(submit) pro debugg
			 * 
			 */
			unset($doc_new_user['submit']);
			$this->load->model('Doc_info');
			if($this->Doc_info->getDocs($doc_new_user)){
				$this->session->set_flashdata('msg', 'Cadastro salvo com sucesso!'); 
			}else{

				$this->session->set_flashdata('msg', 'Cadastro falhou ao ser salvo!');
			}
			return redirect('welcome');
		}
		else
		{
			$this->load->view('doc-form-newuser', ['doc_users_especialidade' => $doc_users_especialidade]);
		}
				
	}

	/*
	*****************************************************
	***********Função para trazer dados pelo nome********
	*****************************************************
	*/

	public function procuraUsersNome($doc_nome){


		$this->load->model('Doc_info');
		$doc_user_info = $this->Doc_info->getOneDoc($doc_nome);
		return $doc_user_info;
	}
	
	public function procuraUsersCrm($doc_crm){


		$this->load->model('Doc_info');
		$doc_user_info = $this->Doc_info->getOneDoc($doc_crm);
		return $doc_user_info;
	}

	/*
	*****************************************************
	***********Função para editar dados dos usuarios*****
	*****************************************************
	*/

	 public function editarUsuario($id){

		$this->load->model('Doc_info');
		$doc_user_info = $this->Doc_info->getOneDoc($id);
		$doc_users_especialidade = $this->Doc_info->getEspecialidades();
		$doc_users_roles = $this->Doc_info->getRoles();
		$this->load->view('doc-form-edituser', ['doc_user_info' => $doc_user_info,
												'doc_users_especialidade' => $doc_users_especialidade,
												'doc_users_roles' => $doc_users_roles]
											);

	 }

/**
 * 
 * Associative table, 
 * 
 */
	public function showEspecialidades()
	{
		$this->db->select('doc_especialidades.especialidades'); 
		$this->db->from('doc_users', 'doc_especialidades');
		$this->db->join('doc_especialidades','doc_users = doc_especialidades');
		$doc_user_especialidade = $this->db->get();
		$this->load->view('welcome_message', ['doc_user_especialidade' => $doc_user_especialidade]);

	
		
	}




	public function setEstado(){


		$doc_estados = array(
			'1' => 'AC - ACRE',
			'2' => 'AL - ALAGOAS',
			'3' => 'AP - AMAPÁ',
			'4' => 'AM - AMAZONAS',
			'5' => 'BA - BAHIA',
			'6' => 'CE - CEARÁ',
			'7' => 'DF - DISTRITO FEDERAL',
			'8' => 'ES - ESPÍRITO SANTO',
			'9' => 'RR - RORAIMA',
			'1' => 'GO - GOIÁS',
			'1' => 'MA - MARANHÃO',
			'1' => 'MT - MATO GROSSO',
			'1' => 'MS - MATO GROSSO DO SUL',
			'1' => 'MG - MINAS GERAIS',
			'1' => 'PA - PARÁ',
			'1' => 'PB - PARAÍBA',
			'1' => 'PR - PARANÁ',
			'1' => 'PE - PERNAMBUCO',
			'1' => 'PI - PIAUÍ',
			'2' => 'RJ - RIO DE JANEIRO',
			'2' => 'RN - RIO GRANDE DO NORTE',
			'2' => 'RS - RIO GRANDE DO SUL',
			'2' => 'RO - RONDÔNIA',
			'2' => 'TO - TOCANTINS',
			'2' => 'SC - SANTA CATARINA',
			'2' => 'SP - SÃO PAULO',
			'2' => 'SE - SERGIPE'
			);

			$this->load->view('doc-form-newuser', ['doc_estados' => $doc_estados]);
		}	
		
	public function setCidades(){
	
	
	
	}
		
}









