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
      <?php echo validation_errors(); ?>
    </div>
    
    <!-- Arrumar no CSS -->
    <br>
    <br>
    <br>
    <br>
    <h3>Cadastro de novo(a) médico(a) </h3>
    <?php echo form_open('Welcome/validarDados', ['action' => '' ,'method'=>'POST','class' => 'form-horizontal']); ?>
  <fieldset>
    <div class="form-group">
      <?php echo form_label('Nome do Médico', 'doc_nome', $attributes = array()); ?>
      <div class="col-lg-10">
        <?php echo form_input(['name'=>'doc_nome', 'placeholder' => 'Nome do Médico', 'class' => 'form-control']); ?>
    </div>
    </div>
    <div class="form-group">
      <?php echo form_label('Número do CRM', 'doc_crm', $attributes = array()); ?>
      <div class="col-lg-10">
       <?php echo form_input(['name'=>'doc_crm', 'placeholder' => 'Número do CRM', 'class' => 'form-control']); ?>
        <br>
        <div class="checkbox">
          <label>Sexo: 
           Masculino <?php echo form_checkbox("doc_sexo", "Mascúlino", set_checkbox('doc_sexo', 'Masculíno')); ?>
           Feminino <?php echo form_checkbox("doc_sexo", "Feminíno", set_checkbox('doc_sexo', 'Feminíno')); ?>
         </label>
        </div>
      </div>
    </div>
 <!-- Inicio Seleção de Estado -->
    <div class="form-group">
    <select name="estados" id="estados" class="selectpicker" data-live-search="true">
    <?php if(count($doc_users_estados)): ?>
    <?php foreach ($doc_users_estados as  $doc_estado): ?>
  <option data-tokens="<?php echo $doc_estado?>"><?php echo $doc_estado ?></option>
    <?php endforeach; ?>
      <?php endif; ?>
      </select>
      </div>
<!-- Fim Seleção de Estado -->
 <!-- Inicio Seleção de Cidades -->
    <div class="form-group">
    <select id="cidades" class="selectpicker" data-live-search="true" style="display:none;">
    
      </select>
      </div>
<!-- Fim Seleção de Cidades -->
    <div class="form-group">
      <label for="inputDocIdade" class="col-lg-2 control-label">Idade do Médico</label>
      <div class="col-lg-10">
        <?php echo form_input(['name'=>'doc_idade', 'placeholder' => 'Idade do Médico', 'class' => 'form-control']); ?>
      </div>
      <div class="form-group">
      <label for="inputDocTelefone" class="col-lg-2 control-label">Telefone do Médico</label>
      <div class="col-lg-10">
        <?php echo form_input(['name'=>'doc_telefone', 'placeholder' => 'Telefone do Médico', 'class' => 'form-control']); ?>
      </div>
      <div class="checkbox">
          <label>Seleciones suas especialidades:  
            <br>
          <?php if(count($doc_users_especialidade )): ?>
          <?php foreach($doc_users_especialidade as $doc_user_especialidades): ?>
          <br><?php echo $doc_user_especialidades->especialidades ?>
          <?php echo form_checkbox("doc_especialidades[]", $doc_user_especialidades->especialidades); ?>
         
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
  <?php if(isset($_POST['submit'])){
    var_dump($_POST);
  } ?>
  <?php// print_r($doc_users_cidades)?>
<?php echo form_close(); ?>

<!-- AJAX para controlar as Cidades ao Selecionar o Estado -->
<script>
$("#estados").on("change", function(){
    var idEstado = $("#estado").val();

    $.ajax({
      url: 'cidades.php',
      type: 'POST',
      data:{id:idEstado},
      beforeSend: function(){
        $("#cidades").css({'display':'block'});
        $("#cidades").html("Carregando...");
      },
      success: function(){
        $("#cidades").css({'display':'block'});
        $("#cidades").html(data);
      }
      error: function(){
        $("#cidades").css({'display':'block'});
        $("#cidades").html("Erro ao carregar as Cidades");
      }

    })
})


</script>



</body>
</html>