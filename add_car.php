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

    $avatar = $_FILES["avatar"]["name"];
    $tempname = $_FILES["avatar"]["tmp_name"];
    $folder = "image/" . $avatar;

    if ($id > 0) {
        $sql = "UPDATE veiculos SET nome='$nome',preco='$preco',avatar='$avatar',concessionaria_id='$concessionaria_id' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO veiculos(nome,preco,avatar,concessionaria_id,role) values('$nome','$preco','$avatar','$concessionaria_id','2')";
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
                    <div class="card-header"><strong>Formulário</strong><small>Veiculos</small></div>
                    <div class="card-body card-block">

                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-control-label">Nome</label>
                                <input type="text" value="<?php echo $nome ?>" name="nome" placeholder="Entre com o nome do imóvel" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Preço</label>
                                <input type="currency" value="<?php echo $preco ?>" name="preco" placeholder="Entre com o preço do imóvel" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Avatar</label>
                                <input type="file" value="<?php echo $avatar ?>" name="avatar" placeholder="Entre com o avatar do imóvel" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Concessionária</label>
                                <select name="concessionaria_id" required class="form-control">
                                    <option value="">Selecione a concessionária</option>

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
                            </div>

                            <?php if ($_SESSION['ROLE'] == 1) { ?>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block" style="border-radius:0.8rem">
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