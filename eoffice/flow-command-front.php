
<?php
include "header.php"; 
include "admin/function.php"; 

//ตรวจสอบปีเอกสาร
list($yid,$yname,$ystatus)=chkYear();  
$yid=$yid;
$yname=$yname;
$ystatus=$ystatus;
?>
<br><br><br>
        <div  class="col-md-12">
            <div class="panel panel-primary" style="margin: 20">
                <div class="panel-heading">
                        <i class="fas fa-clipboard-list  fa-2x" aria-hidden="true"></i>  <strong>ทะเบียนคำสั่งจังหวัด</strong>
                </div> <!-- panel -heading-->
                     <table class="table table-bordered table-hover" id="tbCommand">
                        <thead class="bg-info">
                             <tr >
                                <td colspan="6">
                                    <form class="form-inline" method="post">
                                        <div class="form-group">
                                            <input type="radio" name="number" id="number" value="1">ค้นหาด้วยเลข
                                            <input type="radio" name="number" id="number" value="2" checked>ค้นหาด้วยชื่อเรื่อง
                                            <div class="input-group">
                                            <span class="input-group-addon">แถวการแสดงผล:</span>
                                                <select class="form-control" name="Per_page">
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <input class="form-control" id="search" name="search" type="text" size=80 placeholder="พิมพ์ข้อความค้นหา">
                                            <button class="btn btn-success" type="submit" name="save">
                                                <i class="fas fa-search "></i> ตกลง
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th width="5%">เลขที่คำสั่ง</th>
                                <th width="60%">เรื่อง</th>
                                <th width="5%">ไฟล์แนบ</th>
                                <th width="10%">ลงวันที่</th>
                                <th width="20%">เจ้าของเรื่อง</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                $sql = "SELECT cid FROM flowcommand  ";
                                $result=dbQuery($sql);
                                $Num_Rows = dbNumRows($result);

                                @$txt_search=$_POST['search'];    //รับค่าจากกล่องข้อความ
                                @$type_search=$_POST['number'];   // รับค่าจากการเลือกวิธีสืบค้น
                                //$Per_Page=10;

                                if(isset($_POST['Per_page'])){    //ตรวจสอบตัวแปร perpage เพื่อหาจำนวนรายการที่จะนำไปแสดงผล
                                    $Per_Page = $_POST['Per_page'];  //รับค่า
                                }else{
                                    $Per_Page = 10;                //ถ้าไม่มีให้ใช้ 10
                                }

                                 
                                if (isset($_GET['Page'])) {    //ถ้ามีการรับค่า Page มา
                                    $Page = $_GET['Page'];     //กำหนดตัวแปร page
                                }else{
                                    $Page = 1;                 //ถ้าไม่มีการกำหนด  ตัวแปรเท่ากับ 1
                                }

                                $Prev_Page = $Page-1;          //ก่อนหน้า
                                $Next_Page = $Page+1;          //5yfwx

                                $Page_Start = (($Per_Page*$Page)-$Per_Page);    //หน้าเริ่มต้น เท่ากับจำนวนหน้าแสดงผล * หน้า

                                if($Num_Rows<=$Per_Page){
                                    $Num_Pages =1;
                                }else if(($Num_Rows % $Per_Page)==0)
                                {
                                    $Num_Pages =($Num_Rows/$Per_Page) ;
                                }else{
                                    $Num_Pages =($Num_Rows/$Per_Page)+1;
                                    $Num_Pages = (int)$Num_Pages;
                                }

                                $sql .=" ORDER  by cid ASC LIMIT $Page_Start , $Per_Page";
                                $objQuery  = dbQuery($sql);

                                if(isset($_POST['save'])){    //กรณีที่มีการกดปุ่มค้นหา
                                      if($type_search==1){    //ถ้าค้นหาด้วยเลขคำสั่ง
                                         $sql="SELECT c.*,y.yname,d.dep_name,u.firstname
                                                FROM  flowcommand as c
                                                INNER JOIN sys_year as y ON y.yid = c.yid
                                                INNER JOIN user as u ON  u.u_id = c.u_id
                                                INNER JOIN depart as d ON d.dep_id =c.dep_id
                                                WHERE rec_id LIKE '%$txt_search%'  AND c.doc_status <> 2 AND c.file_upload <> ''
                                                ORDER BY cid DESC
                                                limit $Page_Start , $Per_Page  ";
                                      }else if($type_search==2){    //ถ้าค้นหาด้วยชื่อคำสั่ง
                                           $sql="SELECT c.*,y.yname,d.dep_name,u.firstname
                                                FROM  flowcommand as c
                                                INNER JOIN sys_year as y ON y.yid=c.yid
                                                INNER JOIN user as u ON  u.u_id = c.u_id
                                                INNER JOIN depart as d ON d.dep_id =c.dep_id
                                                WHERE title LIKE '%$txt_search%' AND c.doc_status <> 2 AND c.file_upload <> ''
                                                ORDER BY cid DESC
                                                limit $Page_Start , $Per_Page  ";  
                                      }

                                      //print $sql;
                                     
                                }else{  //กรณีทั่วไป  ไม่ได้ค้นหาด้วยค่าใด ๆ  โดยกำนดแสดงผลให้แสดงเฉพาะไฟล์ที่กำหนดให้แสดงผล  และ มีไฟล์แนบเท่านั้น
                                     $sql="SELECT c.*,y.yname,d.dep_name,u.firstname
                                            FROM  flowcommand as c
                                            INNER JOIN sys_year as y ON y.yid=c.yid
                                            INNER JOIN user as u ON  u.u_id = c.u_id
                                            INNER JOIN depart as d ON d.dep_id =c.dep_id
                                            WHERE c.doc_status <> 2  AND c.file_upload <> ''
                                            ORDER BY c.cid 
                                            DESC LIMIT $Page_Start,$Per_Page";
                                }
                    
                                $result = dbQuery($sql);
                                while($row=dbFetchArray($result)){?>
                                    <?php 
                                        $cid=$row['cid'];
                                        $file_upload=$row['file_upload'];
                                     ?>
                                    <tr>
                                        <td>
                                         <?php echo $row['rec_id'];?>/<?php echo $row['yname'];?>
                                         </td> 
                                      
                                        <td> <a class="text-success" href="#" onclick="load_leave_data('<?php print $cid; ?>');" data-toggle="modal" data-target=".bs-example-modal-table"> 
                                            <?php echo iconv_substr($row['title'],0,100,"UTF-8")."...";?> </a> <i class="fas fa-eye"> <?=$row['hit'];?></i></td>
                                        <td>
                                            <?php
                                                if($file_upload==''){
                                                    echo "No file";
                                                }else{
                                                     echo "<a class=\"btn btn-info btn-sm\" href='admin/$file_upload' target='_blank'><i class='fas fa-file-alt'></i> ไฟล์แนบ</a>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo thaiDate($row['dateout']); ?></td>
                                        <td><?=$row['firstname']?> </td>
                                    </tr>
                                    <?php }?>
                                  <tr>

                                    <?php
                                        if($Num_Rows<=$Per_Page){
                                            $Num_Pages =1;
                                        }else if(($Num_Rows % $Per_Page)==0){
                                            $Num_Pages =($Num_Rows/$Per_Page) ;
                                        }else{
                                            $Num_Pages =($Num_Rows/$Per_Page)+1;
                                            $Num_Pages = (int)$Num_Pages;
                                        }
                                    ?>
                                        <td colspan=5>
                                            <center>
                                             <nav>
                                                <ul class="pagination">
                                                    <?php 
                                                        if($Prev_Page){
                                                            echo " 
                                                                <li>
                                                                    <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'>ก่อนหน้า</a> 
                                                                    <span aria-hidden=\"true\"><i class=\"fas fa-arrow-alt-circle-left\"></i>
                                                                </li>";
                                                        }

                                                        for($i=1; $i<=$Num_Pages; $i++){
                                                                $Page1 = $Page-2;
                                                                $Page2 = $Page+2;
                                                                if($i != $Page && $i >= $Page1 && $i <= $Page2){
                                                                    echo "<li><a href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</a></li>";
                                                                }
                                                        }
                                                        
                                                        if($Page!=$Num_Pages){
                                                            echo " 
                                                                <li>
                                                                    <span aria-hidden=\"true\"><i class=\"fas fa-arrow-alt-circle-right\"></i>
                                                                    <a href='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>ถัดไป</a> 
                                                                </li>";
                                                        }
                                                        ?>
                                                </ul>
                                            </nav>
                                            </center>
                                        </td>
                                    </tr>
                        </tbody>
                    </table>
            </div>
        </div>  <!-- col-md-10 -->
    </div>  <!-- container -->


 <!-- Modal แสดงรายละเอียด -->
  <div  class="modal fade bs-example-modal-table" tabindex="-1" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-info"></i> รายละเอียดคำสั่ง</h4>
        </div>
        <div class="modal-body no-padding">
            <div id="divDataview"></div>     <!-- สวนสำหรับแสดงผลรายละเอียด   อ้างอิงกับไฟล์  show_command_detail.php -->
        </div> <!-- modal-body -->
        <div class="modal-footer bg-primary">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end Modal  -->
<script type="text/javascript">
function load_leave_data(cid) {
                    var sdata = {
                      cid: cid,
                    };
                    $('#divDataview').load('show_command_detail-front.php', sdata);
                  }
</script>
