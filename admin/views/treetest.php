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
    foreach ($arrTest as $parentId) {
        $nodeL = getLeftNode($parentId);
        $nodeR = getRightNode($parentId);
        $totalL = 0;
        $totalR = 0;
        $totalL = getTotalValue($nodeL['nguoidung_id'], $totalL);
        $totalR = getTotalValue($nodeR['nguoidung_id'], $totalR);
        var_dump($nodeL['nguoidung_id']);
        var_dump($nodeR['nguoidung_id']);
        var_dump($totalL);
        var_dump($totalR);
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
