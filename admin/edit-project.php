
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- <script src="js/jquery-3.5.1.min.js"></script> -->



<?php  
include("../library/database.php");
include("function.php");
$pid = $_POST['pid'];
//echo "hellojava";

$sql = "SELECT p.*, d.dep_name FROM project as p
        INNER JOIN  depart as d  ON (p.dep_id = d.dep_id)
        WHERE pid = $pid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);

$sqlYear = "SELECT * FROM sys_year ORDER BY  yname DESC";
$resultYear = dbQuery($sqlYear);

?>

            <form method="post" action="project.php">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">ปีงบประมาณ</span>
                            <select class="form-control col-4" name="sel_year" id="sel_year">
                                <?php    
                                    while($row_y = dbFetchArray($resultYear)){?>
                                        <option  id='ylist' value='<?=$row_y['yid'];?>''><?=$row_y['yname']?></option>
                                <?php }?>
                            </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">วันที่บันทึก</span>
                        <input type="text" name="txtDate" id="txtDate" class="form-control" value="<?php echo DateThai();?>" disabled>
                    </div>  
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">ชื่อโครงการ</span>
                        <input type="text" name="prj_name" id="prj_name" class="form-control" title="เพิ่มชื่อโครงการ" value="<?=$row['name'];?>">                            
                    </div>
                </div>

                <div class="form-group">            
                    <div class="input-group">
                        <span class="input-group-addon">งบประมาณ</span>
                        <input type="number" name="money" id="money" class="form-control" value="<?=$row['money'];?>" title="เพิ่มชื่อโครงการ">
                        <span class="input-group-addon">บาท</span>                     
                    </div>
                </div>
                <?php  //เลือกหน่วยรับผิดชอบ 
                    $sql = "SELECT * FROM depart ORDER BY dep_id ASC";
                    $result = dbQuery($sql);
                ?>
                <div class="form-group">            
                    <div class="input-group">                         
                        <span class="input-group-addon">หน่วยรับผิดชอบ</span>   
                        <select class="form-control" name="sel_office" id="sel_office"  required> 
                            <?php 
                                 while ($row = dbFetchArray($result)) { ?>
                                    <option value='<?php echo $row['dep_id'];?>'><?php echo $row['dep_name'];?></option>
                                 <?php } ?>
                        </select>                        
                    </div>
                </div>

                    <input type="hidden" name="pid" id="pid" value="<?=$pid;?>">
                    </div>
                    </div>
                    <div class="card-footer">
                            <center>
                            <button class="btn btn-success  float-center" type="submit" name="btnEdit" id="btnEdit">
                                <i class="fa fa-save"></i> บันทึก
                            </button>
                            </center>
                    </div>
                </form>
