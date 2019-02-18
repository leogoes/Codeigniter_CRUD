<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nav-bar.css'); ?>">
</head>
<body>
    <?php $this->load->view('nav-bar'); ?>
    <div class="alert alert-danger" role="alert">
    <!-- Printa os errors da validação criada em Welcome Controller -->
      <?php echo validation_errors(); ?>
    </div>
    
    <!-- Arrumar no CSS -->
    <br>
    <br>
    <br>
    <br>
    <h3>Edição de cadastro do(a) médico(a) </h3>
    <!-- Call editar usuario function from welcome controller -->
    <?php echo form_open('Welcome/editarUsuario', ['action' => '' ,'method'=>'POST','class' => 'form-horizontal']); ?>
  <fieldset>
    <div class="form-group">
      <?php echo form_label('Nome do Médico', 'doc_nome', $attributes = array()); ?>  
      <div class="col-lg-10">
        <?php echo form_input(['name'=>'doc_nome', 'placeholder' => 'Nome do Médico', 'class' => 'form-control', 'value' =>set_value( 'doc_nome',$doc_user_info->doc_nome)]); ?>
    </div>
    </div>
    <div class="form-group">
      <?php echo form_label('Número do CRM', 'doc_crm', $attributes = array()); ?>
      <div class="col-lg-10">
       <?php echo form_input(['name'=>'doc_crm', 'placeholder' => 'Número do CRM', 'class' => 'form-control', 'value' =>set_value( 'doc_crm',$doc_user_info->doc_crm)]); ?>
        <br>
        <div class="checkbox">
          <label>Sexo:                                                
              <!-- Retorna valores from DB usando getDocs()-->
           Masculino <?php echo form_checkbox("doc_sexo", "Mascúlino", set_checkbox( $doc_user_info->doc_sexo)); ?>
           Feminino <?php echo form_checkbox("doc_sexo", "Femínino", set_checkbox( $doc_user_info->doc_sexo)); ?>
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="inputDocIdade" class="col-lg-2 control-label">Idade do Médico</label>
      <div class="col-lg-10">
      <!-- Retorna valores from DB usando getDocs()-->
        <?php echo form_input(['name'=>'doc_idade', 'placeholder' => 'Idade do Médico', 'value' =>set_value( 'doc_idade',$doc_user_info->doc_idade), 'class' => 'form-control']); ?>
      </div>
      <div class="form-group">
      <!-- Retorna valores from DB usando getDocs()-->
      <label for="inputDocTelefone" class="col-lg-2 control-label">Telefone do Médico</label>
      <div class="col-lg-10">
        <?php echo form_input(['name'=>'doc_telefone', 'placeholder' => 'Telefone do Médico', 'value' =>set_value('doc_telefone',$doc_user_info->doc_telefone), 'class' => 'form-control']); ?>
      </div>
      <div class="checkbox">
          <label>Seleciones suas especialidades:  
            <br>
            <!-- Retorna valores das especialidades via checkbox -->
          <?php if(count($doc_users_especialidade )): ?>
          <?php foreach($doc_users_especialidade as $doc_user_especialidades): ?>
          <br><?php echo $doc_user_especialidades->especialidades ?>
          <?php echo form_checkbox("doc_especialidades",  $doc_user_info->doc_especialidade_id, set_value('doc_especialidades', $doc_user_info->doc_especialidade_id)); ?>

           <?php endforeach; ?>
          <?php else: ?>
          <?php endif; ?>
         </label>
        </div>
      </div>
    </div>         
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default"name="reset">Cancel</button>
        <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-primary', 'id' => 'submit')); ?>
      </div>
    </div>
  </fieldset>
  <!-- debuggar -->
  <?php //if(isset($_POST['submit'])){
    //var_dump($_POST);
   ?>
<?php echo form_close(); ?>
</body>
</html>