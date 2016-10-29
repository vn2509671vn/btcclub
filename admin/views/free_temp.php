<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $array_id = mysql_fetch_array(getid($user_check));
    $id = $array_id[0];
    $user = danhsach($id);
    $rowUser = 1;
    if(!$user || mysql_num_rows($user) == 0){
        $rowUser = 0;
    }
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Quản Lí Cây F1
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member_f1.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Quản lý Cây F1 </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="options">
                            		<div class="btn-toolbar">
                            			<!--<a href="register.php" class="btn btn-default"><i class="fa fa-fw fa-plus"></i>Tạo người dùng mới</a>-->
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive padding-top-10">
                                    <?php
                                        $new_array = array();
                                        while ($row = mysql_fetch_array($user)) 
                                            {
                                                $new_array[$row['nguoidung_id']]['nguoidung_id'] = $row['nguoidung_id'];
                                                $new_array[$row['nguoidung_id']]['nguoidung_taikhoan'] = $row['nguoidung_taikhoan'];
                                                $new_array[$row['nguoidung_id']]['nguoidung_parent_id'] = $row['nguoidung_parent_id'];
                                            }
                                        $newString = recursive($new_array, $id, $newString);
                                        $newString = str_replace('<ul></ul>', '', $newString);
                                        $newString = trim($newString);
                                        echo $newString;
                                        // $ds = explode(',',$newString);
                                        // echo "<ul>";
                                        // for($i=0; $i < count($ds)-1;$i++){
                                        //     $dem = $ds[$i];
                                        //     $k = getparent($dem);
                                        //     $tem = mysql_num_rows($k);
                                        //     if($tem < 2){
                                        //         echo "<li>" . $dem ."</li>";
                                        //     }
                                        //     else{
                                        //         echo '';
                                        //     }
                                        // }
                                        // echo "</ul>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
<script type="text/javascript">
    selectorMenu("tree_member");
    $('#table-user').DataTable({
        "searching": true,
        "info": true,
    });
    var menu = new menuTree(menuData);
		function init() {
			menu.show('menu');
		}
		window.onload = init;
</script>