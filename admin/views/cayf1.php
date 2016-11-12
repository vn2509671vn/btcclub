<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
    require("../models/member_f1.php");
    $id = $_SESSION['login_id'];
    $user = danhsach();
    $status = sttaccount($id);
    $lstStatus = $status[0];
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">
                <input style="display:none" class="form-control" id="status" type="text" readonly value="<?php echo strtolower($lstStatus);?>">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Cây Thành Viên
                        </h1>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Bảng điều khiển</a></li>
                                <li><a href="member.php"><i class="fa fa-list"></i>Thành viên</a></li>
                                <li class="active">Cây Thành Viên</li>
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
                            			<div id="dis"></div>
                            		</div>
                            	</div>
                            </div>
                            <div class="panel-body">
                            	<div id="treecontrol">
											<a title="Collapse the entire tree below" href="#"><img src="../tree_images/minus.gif" /> Collapse All</a>
											<a title="Expand the entire tree below" href="#"><img src="../tree_images/plus.gif" /> Expand All</a>
											<a title="Toggle the tree below, opening closed branches, closing open branches" href="#">Toggle All</a>
										</div>
                                <div id="xulystatus" class="panel panel-default" style="display:none">
                                    <div class="panel panel-info">
                                     	
										<!--<ul id="gray" class="treeview-gray">-->
										<!--	<li>-->
										<!--		<span>Item 2</span>-->
										<!--		<ul>-->
										<!--			<li class="closed">-->
										<!--				<span>Item 2.1 (closed at start)</span>-->
										<!--				<ul>-->
										<!--					<li>Item 2.1.1</li>-->
										<!--					<li>Item 2.1.2</li>-->
										<!--				</ul>-->
										<!--			</li>-->
										<!--			<li class="closed">-->
										<!--				<span>Item 2.3</span>-->
										<!--				<ul>-->
										<!--					<li>Item 2.3.1</li>-->
										<!--					<li>Item 2.3.2</li>-->
															
										<!--				</ul>-->
										<!--			</li>-->
										<!--		</ul>-->
										<!--	</li>-->
										<!--</ul>-->
										
										<?php
										$newString .= '<ul  id="gray" class="treeview-gray">';
										$newString .= '<li> <span>' . $status['nguoidung_taikhoan'] . '</span>';
                                        $new_array = array();
                                        while ($row = mysql_fetch_array($user)) 
                                            {
                                                $new_array[$row['nguoidung_id']]['nguoidung_id'] = $row['nguoidung_id'];
                                                $new_array[$row['nguoidung_id']]['nguoidung_taikhoan'] = $row['nguoidung_taikhoan'];
                                                $new_array[$row['nguoidung_id']]['nguoidung_parent_id'] = $row['nguoidung_parent_id'];
                                                $new_array[$row['nguoidung_id']]['nguoidung_loainhanh'] = $row['nguoidung_loainhanh'];
                                                $new_array[$row['nguoidung_id']]['nguoidung_giatricanbang'] = $row['nguoidung_giatricanbang'];
                                            }
                                        $newString = cayf1($new_array, $id, $newString);
                                        // $newString = str_replace('<ul></ul>', '', $newString);
                                        $newString .= '</li>';
                                        $newString .= '<ul>';
                                        // $newString = trim($newString);
                                        // $ds = explode(',',$newString);
                                        echo $newString;
                                    ?>
                                    </div>
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
    selectorMenu("register");
    var status =$('#status').val();
    window.onload = function()
    {
        if(status == 'freeze'){
            $("#xulystatus").fadeOut('slow', function()
			 {
				$("#xulystatus").fadeIn('slow');
				$("#xulystatus").show();
				$("#xulystatus").html('<div class="alert alert-danger" id="error_login">' +
                                            '<a href="#" class="close" data-dismiss="alert">×</a>' +
                                            '<strong>Error :</strong>' + 
                                            '<div> Tài khoản của ban đã bị đóng băng. Vui lòng liên hệ Admin để được mở khoá. </div>' + 
                                      '</div>');
			});
        }
        else{
            $("#xulystatus").show();
        }
    };
</script>