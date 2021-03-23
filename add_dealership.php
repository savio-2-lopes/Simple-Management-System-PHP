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

<main class="content pb-0" role="main">
    <aside class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <section class="card-header">
                        <strong>Formulário</strong> <small>Concessionária</small>
                    </section>

                    <article class="card-body card-block">
                        <form method="post">

                            <section class="input-group mb-3 mt-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nome</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $concessionaria ?>" name="concessionaria" placeholder="Nome da concessionária" required>
                            </section>

                            <button type="submit" class="btn btn-lg btn-success btn-block mt-4" style="border-radius:0.8rem">
                                <span id="payment-button-amount">Cadastrar</span>
                            </button>
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