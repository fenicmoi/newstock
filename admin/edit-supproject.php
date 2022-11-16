<?php  
include("../library/database.php");
include("../library/function.php");
 $sid = $_POST['sid'];   //รหัสรายการครุภัณฑ์
 $sql = "SELECT * FROM subproject WHERE sid = $sid";
 $result = dbQuery($sql);
 $row = dbFetchAssoc($result);
 
?>
                <form method="post" >
                    <div class="form-group">
                        <div class="input-group">
                             <span class="input-group-addon" id="basic-addon1">ชื่อรายการ</span>
                             <input type="text" id="listname" name="listname"  class="form-control" value="<?=$row['listname'];?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">รหัสสินทรัพย์</span>
                            <input type="text" id="moneyID" name="moneyID"  class="form-control" value="<?=$row['moneyID'];?>">
                        </div>
                    </div>
             
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">รายละเอียด</span>
                            <input class="form-control" type="text" name="descript" id="descript" value='<?=$row['descript'];?>'>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">จำนวน</span>
                            <input type="text" id="amount" name="amount"  class="form-control col-4" value="<?=$row['amount'];?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">ราคา/หน่วย</span>
                            <input type="text" id="price" name="price"  class="form-control col-4" value="<?=$row['price'];?>">
                             <span class="input-group-addon" id="basic-addon1">บาท</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                             <span class="input-group-addon" id="basic-addon1">วิธีการได้มา</span>
                              <select name="howto" id="howto" class="form-control col-3" required>
                                <option value="0">-- เลือก --</option>
                                <option value="ประกาศเชิญชวน">ประกาศเชิญชวน</option>
                                <option value="คัดเลือก">คัดเลือก</option>
                                <option value="เฉพาะเจาะจง">เฉพาะเจาะจง</option>
                                <option value="อื่นๆ" selected>อื่นๆ</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">วันตรวจรับ</span>
                            <input type="date" id="reciveDate" name="reciveDate"  class="form-control col-3" value="<?=$row['reciveDate'];?>">
                        </div>
                    </div>
                       
                    <div class="form-group">
                        <div class="input-group">
                             <span class="input-group-addon" id="basic-addon1">เลขที่สัญญา</span>
                             <input type="text" id="lawID" name="lawID"  class="form-control" value="<?=$row['lawID']?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">อายุการใช้งาน</span>
                            <input type="text" id="age" name="age"  class="form-control" value="<?=$row['age'];?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">หน่วยงานที่ใช้</span>
                            <input type="text" id="reciveOffice" name="reciveOffice"  class="form-control" value='<?=$row['reciveOffice'];?>'>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">สภาพ</span>
                            <select name="status" id="status" class="form-control col-3" required>
                                <option value="0">-- เลือก --</option>
                                <option value="ดี" selected>ดี</option>
                                <option value="ชำรุด">ชำรุด</option>
                                <option value="ไม่ปรากฎ">ไม่ปรากฎ</option>
                                <option value="ระบุไม่ได้">ระบุไม่ได้</option>
                            </select>
                        </div>
                    </div>
                    <center>
                    <input type="hidden" name="sid" id="sid" value="<?=$row['sid'];?>">
                    <input type="hidden" name = "pid" id="pid" value="<?=$row['pid'];?>">  
                    <button class="btn btn-success  float-center" type="submit" name="btnEdit" id="btnEdit">
                        <i class="fa fa-save"></i> บันทึก
                    </button>
                    </center>
                </form>



