<?php
require('top.php');
if ($_SESSION['ROLE'] != 1) {
    header('location:add_user.php?id=' . $_SESSION['USER_ID']);
    die();
}

$concessionaria = '';
$id = '';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM concessionaria WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);

    $concessionaria = $row['concessionaria'];
}

if (isset($_POST['concessionaria'])) {
    $concessionaria = mysqli_real_escape_string($con, $_POST['concessionaria']);

    if ($id > 0) {
        $sql = "UPDATE concessionaria SET concessionaria='$concessionaria' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO concessionaria(concessionaria) VALUES('$concessionaria')";
    }

    mysqli_query($con, $sql);
    header('location:index.php');
    die();
}
?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><small>Formulário</small><strong>Concessionária</strong></div>
                    <div class="card-body card-block">
                        <form method="post">
                            <div class="form-group">
                                <label for="department" class=" form-control-label">Nome da Concessionária</label>
                                <input type="text" value="<?php echo $concessionaria ?>" name="concessionaria" placeholder="Entre com o nome da concessionária" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success btn-block" style="border-radius:0.8rem">
                                <span id="payment-button-amount">Cadastrar</span>
                            </button>
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