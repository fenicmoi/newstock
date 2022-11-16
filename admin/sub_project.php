<?php   
include "header.php"; 
$yid=chkYear();
$u_id=$_SESSION['ses_u_id'];


$pid = $_GET['pid'];
$sql = "SELECT p.*, y.yname FROM project  as p
        INNER JOIN sys_year as y  ON  p.yid = y.yid  
        WHERE p.pid = $pid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);

?>
<link rel="stylesheet" href="css/styleDelrow.css">

<div class="row">
    <div class="col-md-2">
        <?php
            $menu=  checkMenu($level_id);
            include $menu;
        ?>
    </div>
    <div class="col-md-10">
        <div class="panel panel-primary" style="margin: 10">
                <div class="panel-heading">ชื่อโครงการ : <strong><?php echo $row['name']?></strong>
                <button type="button" class="btn btn-warning  float-right" data-toggle="modal" data-target="#modelId">
                        <i class="fas fa-plus"></i> เพิ่มรายการ
                    </button>
				</div> 
                <table class="table table-striped table-bordered" id="myTable">
                       <thead class="thead-inverse">
                           <tr>
                               <th><h6>ที่</h6></th>
                               <th><h6>รหัสครุภัณฑ์</h6></th>
                               <th><h6>รายการ</h6></th>
                               <th><h6>รหัสสินทรัพย์</h6></th>
                               <th><h6>รายละเอียด</h6></th>
                               <th><h6>จำนวน</h6></th>
                               <th><h6>ราคา/หน่วย</h6></th>
                               <th><h6>วิธีการได้มา</h6></th>
                               <th><h6>วันตรวจรับ</h6></th>
                               <th><h6>เลขที่สัญญา</h6></th>
                               <th><h6>อายุการใช้งาน</h6></th>
                               <th><h6>หน่วยงานใช้ทรัพย์สิน</h6></th>
                               <th><h6>สถานะ</h6></th>
                               <th><i class="fas fa-edit"></i></th>
                               <th><i class="fas fa-trash"></i></th>
                           </tr>
                           </thead>
                           <tbody>
                                <?php   
                                    //เลือกรายการที่มีรหัสโครงการเดียวกันและสถานะต้องแสดง
                                    $sql = "SELECT * FROM subproject WHERE pid=$pid AND del = 1 ORDER BY sid ASC";
                                   // echo $sql;
                                    $result = dbQuery($sql);
                                    $count = 1;
                                    while ($row = dbFetchArray($result)) {
                                      echo "<tr>
                                                <td>".$count."</td>
                                                <td>".$row['fedID']."</td>
                                                <td>".$row['listname']."</td>
                                                <td>".$row['moneyID']."</td>
                                                <td>".$row['descript']."</td>
                                                <td>".$row['amount']."</td>
                                                <td>".number_format($row['price'])."</td>
                                                <td>".$row['howto']."</td>
                                                <td>".thaiDate($row['reciveDate'])."</td>
                                                <td>".$row['lawID']."</td>
                                                <td>".$row['age']."</td>
                                                <td>".$row['reciveOffice']."</td>
                                                <td>".$row['status']."</td>";?>
                                                <td>
                                                    <a class="btn btn-outline-warning btn-sm btn-block" 
                                                        onclick = "load_edit('<?php print $row['sid']?>')" 
                                                        data-toggle="modal" 
                                                        data-target="#modelEdit">
                                                        <i class="fas fa-pencil-alt"></i> 
                                                    </a> 
                                                </td>
                                                <td>
                                                    <span class='delete btn btn-danger btn-sm text-white' data-id='<?php echo $row['sid']; ?>'><i class="fas fa-trash"></i></span>
                                                </td>
                                            </tr>
                                    <?php         
                                        $count++;
                                    }
                                ?>
                           </tbody>
                   </table>

                
        </div> <!-- panel -->
    </div> <!-- col-md -->
    </div><!-- row -->

<!-- Modal Display Edit -->
<div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-pen"></i> แก้ไขรายการครุภัณฑ์ </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         <div id="divDataview"> </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
      

<?php 
 include("modal_subproject.php");
 include("subproject_managment.php");
 ?>

<script>
function load_edit(sid){
	 var sdata = {
         sid : sid,
     };
	$("#divDataview").load("admin/edit-supproject.php",sdata);
}
</script>



<script src="../js/tree-view.js"></script>
<script src="../js/delete-subproject.js"></script>

