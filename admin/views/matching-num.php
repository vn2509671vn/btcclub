<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<!-- Add start Models-->
<?php 
require("../models/pd-gd.php");
    $user = $_SESSION['login_id'];
    $danhsachpd = danhsachpd();
    $danhsachgd = danhsachgd();
    $rowsPD = mysql_num_rows($danhsachpd);
    $rowsGD = mysql_num_rows($danhsachgd);
?>
<!-- Add end models -->
<!-- Add end Header-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header orange-color">
                            Matching PD - GD
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!-- Content of post -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class='orange-color'>List of Provide Donation (PD)</h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive padding-top-10">
                                            <table id="table-pd" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>ACCOUNT</th>
                                                        <th>DATE CREATED</th>
                                                        <th>PD NUMBER</th>
                                                        <th>FILLED</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php if($rowsPD <= 0):?>
                                                        <tr>
                                                            <td colspan='6' class="text-center">No item</td>
                                                        </tr>
                                                        <?php else:?>
                                                            <?php $pdSTT = 1;?>
                                                            <?php while($listPD = mysql_fetch_array($danhsachpd)):?>
                                                            <tr>
                                                                <td><?php echo $pdSTT;?></td>
                                                                <td><?php echo $listPD['nguoidung_taikhoan'];?></td>
                                                                <td><?php echo $listPD['pd_ngaytao'];?></td>
                                                                <td><?php echo $listPD['pd_mapd'];?></td>
                                                                <td class="pd_filled" data-id="<?php echo $listPD['pd_id'];?>"><?php echo $listPD['pd_notfilled'];?></td>
                                                                <td>---</td>
                                                            <?php $pdSTT++;?>
                                                            </tr>
                                                            <?php endwhile;?>
                                                        <?php endif;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class='orange-color'>List of GET Donation (GD)</h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive padding-top-10">
                                            <table id="table-gd" class="table table-striped table-bordered table-full-width" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>ACCOUNT</th>
                                                        <th>DATE CREATED</th>
                                                        <th>GD NUMBER</th>
                                                        <th>AMOUNT</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php if($rowsGD <= 0):?>
                                                        <tr>
                                                            <td colspan='6' class="text-center">No item</td>
                                                        </tr>
                                                        <?php else:?>
                                                            <?php $gdSTT = 1;?>
                                                            <?php while($listGD = mysql_fetch_array($danhsachgd)):?>
                                                            <tr>
                                                                <td><?php echo $gdSTT;?></td>
                                                                <td><?php echo $listGD['nguoidung_taikhoan'];?></td>
                                                                <td><?php echo $listGD['gd_ngaytao'];?></td>
                                                                <td><?php echo $listGD['gd_magd'];?></td>
                                                                <td class="amount" data-id="<?php echo $listGD['gd_id'];?>"><?php echo $listGD['gd_giatri'];?></td>
                                                                <td>---</td>
                                                            <?php $gdSTT++;?>
                                                        </tr>
                                                            <?php endwhile;?>
                                                        <?php endif;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Area of function-->
                                <div class="form-inline form-group">
                                    <label>Số lượng PD: </label>
                                    <input type=text maxlength=4 onkeypress='return isNumberKey(event)' id="inputPD" class="form-control">
                                    <button class="btn btn-warning" id="autoMatching">Matching</button>
                                </div>
                                <!-- End Content of post -->
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
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    
    function khoplenh($gd_id, $pd_id, $sotien, $pd_chuacho){
        $.ajax({
                url:"../models/pd-gd.php", 
                method:"post",  
                data:{
                    action: 'khoplenh',
                    gdid: $gd_id,
                    pdid: $pd_id,
                    sotien: $sotien,
                    pd_chuacho: $pd_chuacho,
                    matransfer: 'T<?php echo $user.date("YmdHs");?>'
                },  
                dataType:"text",  
                success:function(data)  
                {  
                    if(data){
                        //window.location.reload();
                    }
                    else {
                        alert("Có lỗi phát sinh!!! Vui lòng liên hệ admin");
                    }
                }  
        });
    }
    selectorMenu("matching-num");
    $(document).ready(function() {
      $('#table-pd').DataTable({
        "searching": true,
        "info": true,
      });
      $('#table-gd').DataTable({
        "searching": true,
        "info": true,
      });
      
      $('#autoMatching').click(function(){
         var numRowCho = $('#table-pd > tbody > tr').length;
         var numRowNhan = $('#table-gd > tbody > tr').length;
         var arrCho = new Array();
         var arrNhan = new Array();
         var numPD = $('#inputPD').val();
         if(numPD > numRowCho - 3){
            var tmp = numRowCho - 2;
            alert("Bạn chỉ có thể nhập số lượng PD nhỏ hơn: " + tmp);
            return;    
         }
         
         $('.pd_filled').each(function(numIndex) {
             var tiencho = parseInt($(this).html());
             var pdID = $(this).attr("data-id");
             if(numIndex < numPD){
                arrCho.push({
                    "pd_id": pdID,
                    "pd_filled": tiencho
                });
                numIndex++;
             }
         });
         
         $('.amount').each(function() {
             var tiennhan = parseInt($(this).html());
             var gdID = $(this).attr("data-id");
             arrNhan.push({
                 "gd_id": gdID,
                 "amount": tiennhan
             });
         });
         
         for(var i = 0; i < arrNhan.length; i++){
             var tiennhan = arrNhan[i].amount;
             var gd_id = arrNhan[i].gd_id;
             var sum = 0;
             
             for(var indexSum = 0; indexSum < arrCho.length; indexSum++){
                 sum += parseFloat(arrCho[indexSum].pd_filled);
             }
             if(sum < tiennhan){
                 continue;
             }
             
             var j = 0;
             while(j < arrCho.length){
                 var tiencho = arrCho[j].pd_filled;
                 var pd_id = arrCho[j].pd_id;
                 if(tiencho <= tiennhan){
                     arrCho.splice(j,1);
                     tiennhan -= tiencho;
                     //console.log(pd_id + "-" + gd_id + "=" + tiencho);
                     khoplenh(gd_id, pd_id, tiencho, 0);
                     j = 0;
                 }
                 else if(tiencho > tiennhan){
                     arrCho[j].pd_filled -= tiennhan;
                     //console.log(pd_id + "-" + gd_id + "=" + tiennhan);
                     khoplenh(gd_id, pd_id, tiennhan, arrCho[j].pd_filled);
                     break;
                 }
                 if(tiennhan == 0) break;
             }
         }
         
         setTimeout(function(){ 
             window.location.reload();
         }, 2000);
      });
    });
</script>