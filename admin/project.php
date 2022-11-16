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
                    <a href="add_object.php" class="btn btn-default  pull-right" data-toggle="modal" data-target="#modelId"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม=ชนิดครุภัณฑ์</a>
				</div> 
                 <table class="table table-bordered table-hover table-striped" id="myTable">
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

                               $sql = "SELECT * FROM project ORDER BY pid DESC";

                                
                                // $sql ="SELECT  p.*, y.yname, d.dep_name FROM project  p
                                // INNER JOIN  sys_year  y   ON (p.yid = y.yid) 
                                // INNER JOIN depart as d ON (p.dep_id = d.dep_id)
                                // WHERE del = 1 
                                // ORDER BY  pid DESC";
                                
                             
                          echo $sql;
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
                                         <td><?php echo $row['yid'];?></td>
                                         <td><?php echo $row['dep_id'];?></td>
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

        include("modal_project.php")   //รวบรวม modal  เกี่ยวกับการจัดการ project 
?>        
</div> <!-- end container -->

<?php include("project_managment.php");?>    

<script>
function load_edit(pid){
	 var sdata = {
         pid : pid,
     };
	$("#divDataview").load("admin/edit-project.php",sdata);
}
</script>
<script src="js/delete-project.js"></script>
  