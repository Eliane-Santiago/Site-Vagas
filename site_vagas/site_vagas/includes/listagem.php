<?php

   //TRATANDO A MENSAGENS DE RETORNO DAS AÇÕES
   $mensagem = '';

   if(isset($_GET['status'])){
      switch ($_GET['status']) {
         case 'success':
            $mensagem = '<div class="alert alert-success">Ação excutada com sucesso!</div>';
            break;
         
         case 'error':
            $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
            break;
      }
   }

   $resultados = '';

   foreach($vagas as $vaga){
      $resultados.='<tr>
                     <td>'.$vaga->id.'</td>
                     <td><textarea rows="3" cols="30" class="border border-0 form-group">'.$vaga->titulo.'</textarea></td>
                     <td><textarea rows="3" cols="50" class="border border-0 form-group">'.$vaga->descricao.'</textarea></td>
                     <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
                     <td>'.date('d/m/y à\s H:i:s',strtotime($vaga->data)).'</td>
                     <td>
                        <div class="form-group d-grid gap-2 d-md-flex justify-content-md">
                           <a href="editar.php?id='.$vaga->id.'">
                              <button type="button" class="btn btn-primary">Editar</button>
                           </a>
                           <a href="excluir.php?id='.$vaga->id.'">
                              <button type="button" class="btn btn-danger">Excluir</button>
                           </a>
                        </div>
                     </td>
                   </tr>';
   };

   $resultados = strlen($resultados) ? $resultados : 
   '<tr>
   <td colspan="6" class="text-center">Nenhuma vaga encontrada</td>
   </tr>'

?>


<main>

   <?=$mensagem?>

   <section>
      <a href="cadastrar.php">
         <button class="btn btn-success">Nova Vaga</button>
      </a>
   </section>
   <section>
      <table class="table bg-light mt-3">
         <thead>
            <tr>
               <th>ID</th>
               <th>Título</th>
               <th>Descrição</th>
               <th>Status</th>
               <th>Data</th>
               <th>Ações</th>
            </tr>
         </thead>
         <tbody>
            <?=$resultados?>
         </tbody>
      </table>
   </section>
</main>