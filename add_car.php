<?php
require('top.php');
$preco = '';
$nome = '';
$status = '';
$concessionaria_id = '';
$id = '';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    if ($_SESSION['ROLE'] == 2 && $_SESSION['USER_ID'] != $id) {
        die('Acesso Negado');
    }
    $res = mysqli_query($con, "SELECT * FROM veiculos WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    $preco = $row['preco'];
    $nome = $row['nome'];
    $concessionaria_id = $row['concessionaria_id'];
}

if (isset($_POST['submit'])) {
    $preco = mysqli_real_escape_string($con, $_POST['preco']);
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $concessionaria_id = mysqli_real_escape_string($con, $_POST['concessionaria_id']);
    $avatar = $_FILES['avatar']['name'];

    if ($id > 0) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], '$avatar');

        $sql = "UPDATE veiculos SET nome='$nome',preco='$preco',concessionaria_id='$concessionaria_id',avatar='$avatar' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO veiculos(nome,preco,concessionaria_id,avatar,role) values('$nome','$preco','$concessionaria_id,'$avatar','2')";
    }

    mysqli_query($con, $sql);
    header('location:vehicle.php');
    die();
}
?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Formulário</strong> <small>Veiculos</small></div>
                    <div class="card-body card-block">

                        <form method="post" action="" enctype="multipart/form-data">
                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nome</span>
                                </div>
                                <input type="text" value="<?php echo $nome ?>" name="nome" class="form-control" placeholder="Nome do veículo" aria-label="Username" aria-describedby="basic-addon1" required>
                            </section>

                            <section class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="currency" value="<?php echo $preco ?>" name="preco" placeholder="Preço do veículo" class="form-control" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </section>

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Avatar</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" value="<?php echo $avatar ?>" name="avatar" placeholder="Avatar do veículo" required>
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </section>

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Concessionária</label>
                                </div>
                                <select class="custom-select" name="concessionaria_id" id="inputGroupSelect01" required>
                                    <option selected>Selecione a concessionária...</option>

                                    <?php
                                    $res = mysqli_query($con, "SELECT * FROM concessionaria ORDER BY concessionaria desc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if ($concessionaria_id == $row['id']) {
                                            echo "<option selected='selected' value=" . $row['id'] . ">" . $row['concessionaria'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['id'] . ">" . $row['concessionaria'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </section>

                            <?php if ($_SESSION['ROLE'] == 1) { ?>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block mt-4" style="border-radius:0.8rem">
                                    <span id="payment-button-amount">Cadastrar</span>
                                </button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.php');
?>