
<!--  จัดการกลุ่ม -->
<?php
include "header.php"; 
$yid=chkYear();
$u_id=$_SESSION['ses_u_id'];
?>
<script>

$(document).ready(function(){
   //check เลขกลุ่มซ้ำ
   $("#gnumber").keyup(function(){
      var gnumber = $(this).val().trim();

      if(gnumber != ''){
         $.ajax({
            url: 'chkGroup.php',
            type: 'post',
            data: {gnumber: gnumber},
            success: function(response){
                $('#gnumber_response').html(response);
             }
         });
      }else{
         $("#gnumber_response").html("");
      }
    });
 });

//Insert DB
$(document).ready(function(){
        $("#save").click(function(){
        
            var gnumber = $('#gnumber').val();
            var gname = $('#gname').val();
            var gstatus = $('#gstatus').val();

            if( gnumber != "" && gname != "" ){
                $.ajax({
                    url:'insertGroup.php',
                    type:'post',
                    data:{gnumber:gnumber, gname:gname, gstatus:gstatus},
                    success:function(response){
                        if(response == 1){
                            Swal.fire(
                            'Good job!',
                            'You clicked the button!',
                            'success'
                            )
                            window.location='manage_group.php';
                        }else if(response == 0) {
                            alert('no');
                        }
                    }
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
                <div class="panel-heading"><i class="fas fa-cart-plus fa-2x"></i>   <strong>จัดการกลุ่มครุภัณฑ์</strong>
                    <a href="add_object.php" class="btn btn-default  pull-right" data-toggle="modal" data-target="#modelId"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มกลุ่มครุภัณฑ์</a>
				</div> 
                <table class="table table-bordered table-hover" id="myTable">
                        <thead>
                            <th>หมายเลขกลุ่ม</th>
                            <th>ชื่อกลุ่ม (GROUP)</th>
                            <th>จำนวนชนิด (Class)</th>
                            <th><i class="fas fa-cog"></i></th>
                        </thead>
                        <tbody>
                        <?php   
                            $sql ="SELECT * FROM st_group ORDER BY gid DESC";
                            $result = dbQuery($sql);
                            while ($row = dbFetchArray($result)) {
                                $gid = $row['gid'];
                                $sqlcount = "SELECT gid FROM st_class WHERE gid = $gid";                  //นับจำนวน  class 
                                $resultCount = dbQuery($sqlcount);
                                $numrow = dbNumRows($resultCount);
                                echo "<tr>
                                         <td>".$row['gnumber']."</td>
                                         <td>".$row['gname']."</td>
                                         <td>".$numrow ."</td>
                                         <td><button class='btn btn-outline-dark btn-sm'><i class='fas fa-pencil-alt'></i></button></td>
                                     </tr>";
                            }
                        ?>
                        </tbody>
                </table>
                <div class="panel-footer">
				<center>
					<a href="index_admin.php" class="btn btn-primary">
						<i class="fas fa-home"></i> หน้าหลัก
					</a>
				</center>
				</div>
                
    </div> <!-- panel -->
</div> <!-- col-md-10 -->
</div> <!-- row -->

    
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="gname" id="gname" class="form-control" placeholder="ชื่อกลุ่มพัสดุ" aria-label="ชื่อกลุ่มพัสดุ">
                            <div id="gname_response" ></div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number" name="gnumber" id="gnumber" class="form-control" placeholder="เลขประจำกลุ่ม" aria-label="ชื่อกลุ่มพัสดุ" >
                            <input type="hidden" name="gstatus" id="gstatus" value=1>
                        </div>
                        <div id="gnumber_response"></div>
                            <center>
                                <button class="btn btn-success" type="submit" name="save" id="save">
                                    <i class="fa fa-save fa-2x"></i> บันทึก
                                </button>
                            </center>                                                         
                      
                  </div>
                  <div class="modal-footer bg-info">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </form>
            </div> <!-- main body -->
        </div> <!-- modal content -->
            </div>
        </div>
