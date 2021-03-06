<?php
require('top.php');
if ($_SESSION['ROLE'] != 1) {
    header('location:add_user.php?id=' . $_SESSION['USER_ID']);
    die();
}
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "DELETE FROM concessionaria WHERE id='$id'");
}
$res = mysqli_query($con, "SELECT * FROM concessionaria order by id desc");
?>

<main class="content pb-0" role="main">
    <aside class="dealerships">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

                    <section class="card-body">
                        <h4 class="box-title">Central das ConcessionĂ¡ria</h4>
                        <h4 class="box-title-link">
                            <a href="add_dealership.php"><i class="fa fa-plus"></i>
                                Registrar ConcessionĂ¡ria
                            </a>
                        </h4>
                    </section>

                    <article class="card-body--">
                        <section class="table-stats dealership-table ov-h">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="5%">ID</th>
                                        <th width="70%">ConcessionĂ¡ria</th>
                                        <th width="0%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['concessionaria'] ?></td>
                                            <td class="row">

                                                <section class="col-lg-6">
                                                    <button class="btn btn-success btn-block">
                                                        <a href="add_dealership.php?id=<?php echo $row['id'] ?>">
                                                            <span style="color:white; font-size:15px">Editar</span>
                                                        </a>
                                                    </button>
                                                </section>

                                                <section class="col-lg-6">
                                                    <button class="btn btn-danger btn-block">
                                                        <a href="index.php?id=<?php echo $row['id'] ?>&type=delete">
                                                            <span style="color:white; font-size:15px">Deletar</span>
                                                        </a>
                                                    </button>
                                                </section>

                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </section>
                    </article>
                </div>
            </div>
        </div>
    </aside>
</main>

<?php
require('footer.php');
?>