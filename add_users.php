<?php
require('top.php');
$email = '';
$password = '';
$name = '';
$concessionaria_id = '';
$id = '';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    if ($_SESSION['ROLE'] == 2 && $_SESSION['USER_ID'] != $id) {
        die('Acesso Negado');
    }

    $res = mysqli_query($con, "SELECT * FROM usuarios WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);

    $email = $row['email'];
    $password = $row['password'];
    $name = $row['name'];
    $concessionaria_id = $row['concessionaria_id'];
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $concessionaria_id = mysqli_real_escape_string($con, $_POST['concessionaria_id']);

    if ($id > 0) {
        $sql = "UPDATE usuarios SET name='$name',password='$password',email='$email',concessionaria_id='$concessionaria_id' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO usuarios(name,password,email,concessionaria_id,role) values('$name','$password','$email','$concessionaria_id','2')";
    }

    mysqli_query($con, $sql);
    header('location:user.php');
    die();
}
?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Formulário</strong> <small>Usuário</small></div>
                    <div class="card-body card-block">
                        <form method="post" enctype="multipart/form-data">

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nome</span>
                                </div>
                                <input type="text" value="<?php echo $name ?>" name="name" class="form-control" placeholder="Nome do usuário" aria-label="Username" aria-describedby="basic-addon1" required>
                            </section>

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Senha</span>
                                </div>
                                <input type="password" value="<?php echo $password ?>" name="password" class="form-control" placeholder="Senha do usuário" aria-label="Username" aria-describedby="basic-addon1" required>
                            </section>

                            <section class="input-group mb-3 mt-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Senha</span>
                                </div>
                                <input type="email" value="<?php echo $email ?>" name="email" class="form-control" placeholder="Email do usuário" aria-label="Username" aria-describedby="basic-addon1" required>
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