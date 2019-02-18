<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Link bootstrap for Layout Page  -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Link css for Layout Page  -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
  </head>
  <body>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
          <div class="dropdown show">
              <a class="nav-link active dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="doc-relation">
              <span data-feather="home"></span>
              Consultar Médicos<span class="sr-only">(current)</span>
              </div>
              </a>
              <!-- Busca de Médicos no banco de dados pelo nome-->
              <?php echo form_open('welcome/procuraUsersNome'); ?>
              <p>Buscar Médicos pelo Nome</p>
              <select class="selectpicker" data-live-search="true">
            <?php if(count($doc_users_info )): ?>
            <!-- Retorna os valores do array -->
            <?php foreach($doc_users_info as $doc_user_info): ?>
              <option data-tokens="doc_nome"><?php echo $doc_user_info->doc_nome ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
            <br>
            <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-primary', 'id' => 'submit')); ?>
            </select>
            <?php echo form_close(); ?>
            <?php echo form_open('welcome/procuraUsersCrm'); ?>
            <p>Buscar Médicos pelo CRM</p>
            <select class="selectpicker" data-live-search="true">
            <?php if(count($doc_users_info )): ?>
            <!-- Retorna os valores do array -->
            <?php foreach($doc_users_info as $doc_user_info): ?>
              <option data-tokens="doc_crm"><?php echo $doc_user_info->doc_crm ?></option>
               <?php endforeach; ?>
            <?php endif; ?>
            <br>
            <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-primary', 'id' => 'submit')); ?>
            </select>
            <?php echo form_close(); ?>
            

             <?php if(isset($_POST['submit'])): ?>
            <?php echo print_r('submit') ;    ?>
            <?php endif;?>
        </div>
        </li>
      </div>
    </nav>
    

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<h2>Relação de Médicos cadastrados</h2>
<h2>  <?php if($msg = $this->session->flashdata('msg')): ?>
      <?php echo $msg; ?>
      <?php endif; ?>
</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Nome</th>
              <th>CRM</th>
              <th>Telefone</th>
              <th>Estado</th>
              <th>Cidade</th>
              <th>Sexo</th>
              <th>Idade</th>
              <th>Especialidades</th>
              <th>Data de cadastro</th>
              <th>Data de edição</th>
              <th>EDIT</th>
              <th>NEW</th>
              <th>DELETE</th>
              <th>READ</th>
            </tr>
          </thead>
          <!-- Verifica se há linhas armazenadas na variavel(array) -->
          <tbody>
            <?php if(count($doc_users_info )): ?>
            <!-- Retorna os valores do array -->
            <?php foreach($doc_users_info as $doc_user_info): ?>
            <?php foreach($doc_users_especialidade as $user_especialidade): ?>
            <?php foreach($doc_users_roles as $user_role): ?>
                  
            <tr>
              <td><?php echo $doc_user_info->doc_nome; ?></td>
              <td><?php echo $doc_user_info->doc_crm;  ?></td>
              <td><?php echo $doc_user_info->doc_telefone;  ?></td>
              <td><?php echo $doc_user_info->doc_estados_id;  ?></td>
              <td><?php echo $doc_user_info->doc_cidades_id;  ?></td>
              <td><?php echo $doc_user_info->doc_sexo;  ?></td>
              <td><?php echo $doc_user_info->doc_idade;  ?></td>
              <td><?php echo $user_especialidade->doc_especialidade_id ; ?></td>
              <td><?php echo $doc_user_info->created_at;  ?></td>
              <td><?php //echo $doc_user_info->uptadet_at;  ?></td>
              <td><?php echo anchor('Welcome/create', 'Adicionar novo médico', ['class' => 'doc-new']); ?></td>
              <td><?php echo anchor("Welcome/editarUsuario/{$doc_user_info->id}", 'Editar  médico', ['class' => 'doc-edit']); ?></td>
              <td><?php echo anchor("Welcome/showEspecialidades/{$doc_user_info->id}", 'Ver  médico', ['class' => 'doc-read']); ?></td>
              <td><?php echo anchor("Welcome/delete/{$doc_user_info->id}", 'Excluir médico', ['class' => 'doc-delete']); ?></td>
            </tr>
            
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
           
              <?php else: ?>
              <tr>
              <td>Sem dados inseridos!</td>
              </tr>
            <?php endif;?>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>elit</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td>odio</td>
              <td>Praesent</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>libero</td>
              <td>Sed</td>
              <td>cursus</td>
              <td>ante</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>dapibus</td>
              <td>diam</td>
              <td>Sed</td>
              <td>nisi</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>Nulla</td>
              <td>quis</td>
              <td>sem</td>
              <td>at</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>nibh</td>
              <td>elementum</td>
              <td>imperdiet</td>
              <td>Duis</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>sagittis</td>
              <td>ipsum</td>
              <td>Praesent</td>
              <td>mauris</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>Fusce</td>
              <td>nec</td>
              <td>tellus</td>
              <td>sed</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>augue</td>
              <td>semper</td>
              <td>porta</td>
              <td>Mauris</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>massa</td>
              <td>Vestibulum</td>
              <td>lacinia</td>
              <td>arcu</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>eget</td>
              <td>nulla</td>
              <td>Class</td>
              <td>aptent</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>taciti</td>
              <td>sociosqu</td>
              <td>ad</td>
              <td>litora</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>torquent</td>
              <td>per</td>
              <td>conubia</td>
              <td>nostra</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>per</td>
              <td>inceptos</td>
              <td>himenaeos</td>
              <td>Curabitur</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>sodales</td>
              <td>ligula</td>
              <td>in</td>
              <td>libero</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
</html>
