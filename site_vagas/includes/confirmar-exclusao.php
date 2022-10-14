<main>

   <h2 class="mt-3">Excluir Vaga</h2>

   <form method="post">
        <div class="form-group">
            <p>Você deseja realmente excluir a vaga <strong><textarea rows="2" cols="80" class="border border-0"><?=$obVaga->titulo?></textarea></strong>?</p>
        </div>

        <div class="form-group d-grid gap-2 d-md-flex justify-content-md">
            <a href="index.php">
            <button type="button" class="btn btn-success mt-3">Cancelar</button>
            </a>
            <a href="excluir.php">
            <button type="submit" name="excluir" class="btn btn-danger mt-3">Excluir</button>
            </a>
        </div>
   </form>

</main>