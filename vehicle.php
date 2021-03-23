<?php
require('top.php');

if ($_SESSION['ROLE'] != 1) {
    header('location:add_car.php?id=' . $_SESSION['USER_ID']);
    die();
}

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "DELETE FROM veiculos where id='$id'");
}

$res = mysqli_query($con, "SELECT * FROM veiculos WHERE role=2 order by id desc");
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Catálogo de Veiculos </h4>
                        <h4 class="box-title-link">
                            <a href="add_car.php"><i class="fa fa-plus"></i> Cadastrar novos veiculos</a>
                        </h4>
                    </div>

                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="5%">ID</th>
                                        <th width="10%">Avatar</th>
                                        <th width="10%">Nome</th>
                                        <th width="10%">Preço</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>

                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row['id'] ?></td>

                                            <td class="avatar">
                                                <img class="rounded-circle" style="width:6rem; height:5rem" src="<?php echo $row['avatar'] ?>" alt="Avatar">
                                            </td>

                                            <td><?php echo $row['nome'] ?></td>
                                            <td>R$<?php echo $row['preco'] ?></td>
                                            <td class="row">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-success btn-block">
                                                        <a href="add_car.php?id=<?php echo $row['id'] ?>"><span style="color:white; font-size:15px">Editar</span></a>
                                                    </button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button class="btn btn-danger btn-block">
                                                        <a href="vehicle.php?id=<?php echo $row['id'] ?>&type=delete"><span style="color:white; font-size:15px">Deletar</span></a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.php');
?>