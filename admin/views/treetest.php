<!-- Add start Header-->
<?php require("../header.php");?>
<!-- Add end Header-->
<?php 
    require("../models/commission.php");
    $gTotal = 0;
    $array = array();
    $gTotal = getTotalValue(1, $gTotal);
    $array = getParent(11, $array);
    var_dump($gTotal);
    
    $arrTest = array(1,7);
    $szTmp;
    foreach ($arrTest as $parentId) {
        $nodeL = getLeftNode($parentId);
        $nodeR = getRightNode($parentId);
        $totalL = 0;
        $totalR = 0;
        $totalL = getTotalValue($nodeL['nguoidung_id'], $totalL);
        $totalR = getTotalValue($nodeR['nguoidung_id'], $totalR);
        if($nodeL['nguoidung_sopindadung'] >= 1){
                        $totalL += 100;
                    }
                    
                    if($nodeR['nguoidung_sopindadung'] >= 1){
                        $totalR += 100;
                    }
                    
                    $tiencanbang = min($totalL,$totalR);
                    $giatricanbang = $root['nguoidung_giatricanbang'];
                    if($tiencanbang != 0 && $tiencanbang > $giatricanbang){
                        $hoahong = $root['nguoidung_sotienhoahong'] + ($tiencanbang - $giatricanbang)*10/100;
                        $giatricanbang = $tiencanbang;
        }
        var_dump($szTmp .= "ID:".$parentId."- Tien can bang:".$giatricanbang. "-Hoa hong".$hoahong);
    }
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- /#wrapper -->

</body>

</html>
<script type="text/javascript">
    
</script>
