




<?php for ($i = 0; $i < 27; $i++): ?>
    <?php if(count($doc_users_cidades)): ?>
    <?php foreach ($doc_users_cidades as  $doc_cidades): ?>
    <?php foreach ($doc_cidades as  $doc_cidade): ?>
    <option data-tokens="<?php echo $i?>"><?php echo $doc_cidade ?></option>
    <?php endforeach; ?>
    <?php endforeach; ?>
      <?php endif; ?>
      <?php endfor; ?>