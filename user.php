<?php
require('top.php');

if ($_SESSION['ROLE'] != 1) {
    header('location:add_users.php?id=' . $_SESSION['USER_ID']);
    die();
}

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "DELETE FROM usuarios where id='$id'");
}

$res = mysqli_query($con, "SELECT * FROM usuarios WHERE role=2 order by id desc");
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Central de Usuários </h4>
                        <h4 class="box-title-link">
                            <a href="add_users.php"><i class="fa fa-plus"></i> Registrar Usuários</a>
                        </h4>
                    </div>

                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="5%">ID</th>
                                        <th width="10%">Nome</th>
                                        <th width="10%">Email</th>
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
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td class="row">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-success btn-block">
                                                        <a href="add_users.php?id=<?php echo $row['id'] ?>"><span style="color:white; font-size:15px">Editar</span></a>
                                                    </button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button class="btn btn-danger btn-block">
                                                        <a href="user.php?id=<?php echo $row['id'] ?>&type=delete"><span style="color:white; font-size:15px">Deletar</span></a>
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