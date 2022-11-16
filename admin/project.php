



<?php
include "header.php"; 
$yid=chkYear();
$u_id=$_SESSION['ses_u_id'];
?>
<script>

//feach user  ใช้ในหน้าจอ  เพิ่ม  project
$(document).ready(function(){
    
    $("#sel_office").select2({ width: "760px", dropdownCssClass: "bigdrop"});
    $.ajax({
        url: 'feachUser.php',
        type: 'json',
        data: '',
        success: function(result){
            $.each(result, function(i,item){
                $('#sel_office').append('<option value='+item['dep_id']+'>'+item['dep_name']+'</option>');
            });
        }
    });
});

</script>

<div class="row">
    <div class="col-md-2">
        <?php
            $menu=  checkMenu($level_id);
            include $menu;
        ?>
    </div>
    <div class="col-md-10">
        <div class="panel panel-primary" style="margin: 10">
                <div class="panel-heading"><i class="fas fa-cart-plus fa-2x"></i>   <strong>เพิ่มโครงการ</strong>
                    <a href="add_object.php" class="btn btn-default  pull-right" data-toggle="modal" data-target="#modelId"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มโครงการ</a>
				</div> 
                 <table class="table table-bordered table-hover table-striped" id="tbProject">
                        <thead class="bg-secondary text-white">
                            <th>ID ระบบ</th>
                            <th>ชื่อโครงการ/กิจกรรม</th>
                            <th>งบประมาณ</th>
                            <th>ปีงบประมาณ</th>
                            <th>หน่วยรับผิดชอบ</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </thead>
                        <tbody>
                        <?php   

                                // $sql = "SELECT * FROM project ORDER BY pid  DESC";

                                $sql = "SELECT p.*, y.yname, d.dep_name FROM project as p 
                                        INNER JOIN  sys_year as y  ON (p.yid = y.yid)
                                        INNER JOIN  depart as d  ON (p.dep_id = d.dep_id)
                                        ORDER BY pid DESC";
                                /*
                                 $sql ="SELECT  p.*, y.yname, d.dep_name FROM project  p
                                 INNER JOIN  sys_year  y   ON (p.yid = y.yid) 
                                 INNER JOIN depart as d ON (p.dep_id = d.dep_id)
                                 WHERE del = 1 
                                 ORDER BY  pid DESC";
                                */
                             
                           // echo $sql;
                            $result = dbQuery($sql);
                            while ($row = dbFetchArray($result)) {?>
                                <tr>
                                         <td><?php echo $row['pid'];?></td>
                                         <td><a href="?menu=subproject&pid=<?=$row['pid']?>" class="text-secondary"><?php echo $row['name'];?></a></td>
                                         <td>
                                            <?php 
                                                if($row['money']==0){
                                                    echo "ไม่ระบุ";
                                                }else{
                                                  echo  number_format($row['money']);   
                                                }
                                                
                                            ?>
                                        </td>
                                         <td><?php echo $row['yname'];?></td>
                                         <td><?php echo $row['dep_name'];?></td>
                                         <td>
                                            <a class="btn btn-outline-warning btn-sm btn-block" 
                                                onclick = "load_edit('<?=$row['pid']?>')" 
                                                data-toggle="modal" 
                                                data-target="#modelEdit">
                                                <i class="fas fa-pencil-alt"></i> 
                                            </a>  
                                         </td>
                                         <td>
                                            <?php 
                                                if($level == "M"){?>
                                                <i class="fas fa-lock"></i>
                                               <?php }else{ ?>
                                                <span class='delete btn btn-danger btn-sm text-white' data-id='<?php echo $row['pid']; ?>'><i class="fas fa-trash"></i></span>
                                               <?php }
                                            ?>
                                        </td>
                                     </tr>
                           <?php } ?>
                        </tbody>
                   </table>
        </div> <!-- panel -->
</div> <!-- row -->

<?php   
        //ปีงบประมาณ  เพื่อใช้ใน modal  ต่าง ๆ
        $sql_y = "SELECT * FROM sys_year  ORDER BY yname DESC";
        $result_y = dbQuery($sql_y);

        //include("modal_project.php")   //รวบรวม modal  เกี่ยวกับการจัดการ project 
?>        
</div> <!-- end container -->

<?php //include("project_managment.php");?>    

<!-- ################## Modal #################### -->

<!-- Model Insert Recore -->
 <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" style="min-width: 800px">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white"> <i class="fas fa-plus"></i> เพิ่มโครงการ
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="post">
                            <!-- <div class="form-group">
                                <div class="input-group"> 
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list"></span></span>
                                    <input type="text" class="form-control" id="sel_year" name="sel_year"  placeholder="ปีงบประมาณ"  required="">
                                </div>
                            </div> -->

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-prepend">ปีงบประมาณ</span>
                                </div>
                                <select class="form-control col-4" name="sel_year" id="sel_year">
                                <?php    
                                    while($row_y = dbFetchArray($result_y)){?>
                                        <option  id='ylist' value='<?=$row_y['yid'];?>''><?=$row_y['yname']?></option>
                                <?php }?>
                                </select>

                                <div class="input-group-prepend">
                                    <span class="input-group-text">วันที่บันทึก</span>
                                </div>
                                <input type="text" name="txtDate" id="txtDate" class="form-control" value="<?php echo DateThai();?>" disabled>
                            </div>  

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">แหล่งงบประมาณ</span>
                                    </div>
                                    <select name="owner" id="owner">
                                        <option value="งบจังหวัด">งบจังหวัด</option>
                                        <option value="งบกลุ่มจังหวัด">งบกลุ่มจังหวัด</option>
                                        <option vlaue="งบเศรษฐกิจฐานราก">งบเศรษฐกิจฐานราก</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group"> 
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list"></span></span>
                                    <input type="text" class="form-control" id="sel_year" name="sel_year"  placeholder="ปีงบประมาณ"  required="">
                                </div>
                            </div>

                            <div class="form-group">            
                                <div class="input-group mb3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">ชื่อโครงการ</span>
                                    </div>
                                    <input type="text" name="prj_name" id="prj_name" class="form-control"  required="required" title="เพิ่มชื่อโครงการ">
                                </div>
                            </div>

                            <div class="form-group">            
                                <div class="input-group mb3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">งบประมาณ</span>
                                    </div>
                                    <input type="number" name="money" id="money" class="form-control" value=0 title="เพิ่มชื่อโครงการ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">บาท</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                        <select class="form-control" name="sel_office" id="sel_office" required> 
                                            <option></option>
                                        </select>
                                        <p class="form-text text-muted">
                                            เพิ่มหน่วยรับงบประมาณ
                                        </p>
                                </div>
                            </div>
                            <?php  
                                $u_id = $_SESSION['ses_u_id'];
                                $dep_id = $_SESSION['ses_dep_id'];
                                $sql = "SELECT * FROM user WHERE u_id = $u_id  ";
                                $result = dbQuery($sql);
                                $row = dbFetchAssoc($result);
                            
                            ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">เจ้าหน้าที่</span>
                                    </div>
                                    <input type="text" name="txtUser" id="txtUser" class="form-control" value="<?php echo $row['firstname'];?>" disabled>
                                </div>
                            </div>
                            <div id="lblWarning"></div>
                            <div id="lblWarning2"></div>  
                            <div class="card-footer">
                                    <center>
                                    <button class="btn btn-success  float-center" type="submit" name="save" id="save">
                                        <i class="fa fa-save"></i> บันทึก
                                    </button>
                                    </center>
                            </div>
                    </form>
                </div> <!-- main body -->
            </div> <!-- modal content -->
        </div>
</div>




<script>
function load_edit(pid){
	 var sdata = {
         pid : pid,
     };
	$("#divDataview").load("admin/edit-project.php",sdata);
}
</script>
<script src="js/delete-project.js"></script>
  

<!--################################ Database Management System ################################ -->
<?php 
//เพิ่ม project
    if(isset($_POST['save'])){
        $yid = $_POST['sel_year'];
        
        $sql =  "SELECT recid FROM project WHERE yid=$yid";
        $result = dbQuery($sql);
        $num = dbNumRows($result);
        $num++;

        $name = $_POST['prj_name'];
        $money = $_POST['money'];
        $dep_id = $_POST['sel_office'];
        $owner = $_POST['owner'];    //งบจังหวัด
        

        $sql = "INSERT INTO project(recid, name, money, yid, dep_id, owner) VALUES($num, '$name', $money, $yid, '$dep_id', '$owner')";
        print $sql;
        $result =  dbQuery($sql);

    
        if($result){
            echo "<script>alert('บันทึกโครงการเรียบร้อยแล้ว')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='?menu=project'>";
        }else{
            echo "<script>alert('มีบางอย่างผิดพลาด  กรุณาติดต่อ Admin')</script>";
        }
        
    }

?>