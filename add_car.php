<?php
require('top.php');

$preco = '';
$nome = '';
$status = '';
$avatar = '';
$concessionaria_id = '';
$id = '';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    if ($_SESSION['ROLE'] == 2 && $_SESSION['USER_ID'] != $id) {
        die('Acesso Negado');
    }
    $res = mysqli_query($con, "SELECT * FROM veiculos WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    $_UP['pasta'] = 'upload/';
    $avatar = $row['avatar'];
    $preco = $row['preco'];
    $nome = $row['nome'];
    $concessionaria_id = $row['concessionaria_id'];
}
if (isset($_POST['submit'])) {
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $preco = mysqli_real_escape_string($con, $_POST['preco']);
    $avatar = mysqli_real_escape_string($con, $_FILES['avatar']['name']);
    $concessionaria_id = mysqli_real_escape_string($con, $_POST['concessionaria_id']);
    if ($id > 0) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $_UP['pasta'] . $avatar);
        $sql = "UPDATE veiculos SET nome='$nome',preco='$preco',avatar='$avatar',concessionaria_id='$concessionaria_id' WHERE id='$id'";
    } else {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $_UP['pasta'] . $avatar);
        $sql = "INSERT INTO veiculos(nome,preco,avatar,concessionaria_id,role) values('$nome','$preco','$avatar','$concessionaria_id','2')";
    }
    mysqli_query($con, $sql);
    header('location:vehicle.php');
    die();
}
?>

<main class="content pb-0" role="main">
    <aside class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <section class="card-header">
                        <strong>Formulário</strong> <small>Usuário</small>
                    </section>

                    <article class="card-body card-block">
                        <form method="post" enctype="multipart/form-data">

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nome</span>
                                </div>
                                <input type="text" value="<?php echo $nome ?>" name="nome" class="form-control" placeholder="Placa do veículo" aria-label="Username" aria-describedby="basic-addon1" required>
                            </section>

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                </div>
                                <input type="currency" value="<?php echo $preco ?>" name="preco" class="form-control" placeholder="Preço do veículo" aria-label="Username" aria-describedby="basic-addon1" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </section>

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Avatar</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" value="<?php echo $avatar ?>" name="avatar" accept=".png,.gif,.jpg,.webp" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </section>

                            <?php if ($_SESSION['ROLE'] == 1) { ?>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block mt-4" style="border-radius:0.8rem">
                                    <span id="payment-button-amount">Cadastrar</span>
                                </button>
                            <?php } ?>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </aside>
</main>

<?php
require('footer.php');
?>