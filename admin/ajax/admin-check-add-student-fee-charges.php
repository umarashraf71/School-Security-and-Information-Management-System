<?php

    session_start();
    include('../includes/config.php');



    if(!empty($_POST['feetype']) && !empty($_POST['studentClass']) )
    {

        $feeType = $_POST['feetype'];
        $studentClass = $_POST['studentClass'];


        $query = "select * from class where class_id = '$studentClass' ";
        $result = mysqli_query($con, $query);

        $row = mysqli_fetch_array($result);

        $admissionFee = $row['admission_fee'];
        $biseFee = $row['bise_fee'];
        $annualTestFee = $row['annual_test_fee'];
        $monthlyTestFee = $row['monthly_test_fee'];
        $monthlyTutionFee = $row['monthly_fee'];


        if($feeType == 'standard')
        {
?>

                <div class="form-group">
                    <label for="title">Student Admission Fee :</label>
                    <input readonly type="number" value="<?php echo $admissionFee ?>" name="sadmissionfee" class="form-control" id="sadmissionfee"
                        placeholder="Enter Student Admission Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




                <div class="form-group">
                    <label for="title">Student BISE Fee :</label>
                    <input readonly type="number" value="<?php echo $biseFee ?>" name="sbisefee" class="form-control" id="sbisefee"
                        placeholder="Enter Student BISE Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




                <div class="form-group">
                    <label for="title">Student Annual Test Fee :</label>
                    <input readonly type="number" value="<?php echo $annualTestFee ?>" name="sanuualtestfee" class="form-control" id="sanuualtestfee"
                        placeholder="Enter Student Annual Test Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>



                <div class="form-group">
                    <label for="title">Student Monthly Test Fee :</label>
                    <input readonly type="number" value="<?php echo $monthlyTestFee ?>" name="smonthlytestfee" class="form-control" id="smonthlytestfee"
                        placeholder="Enter Student Monthly Test Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




                <div class="form-group">
                    <label for="title">Student Monthly Tution Fee :</label>
                    <input readonly type="number" value="<?php echo $monthlyTutionFee ?>" name="smonthlytutionfee" class="form-control" id="smonthlytutionfee"
                        placeholder="Enter Student Monthly Tution fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




<?php
        }
               
        if($feeType == 'scholarship')
        {
?>

<div class="form-group">
                    <label for="title">Student Admission Fee :</label>
                    <input type="number" value="<?php echo $admissionFee ?>" name="sadmissionfee" class="form-control" id="sadmissionfee"
                        placeholder="Enter Student Admission Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




                <div class="form-group">
                    <label for="title">Student BISE Fee :</label>
                    <input type="number" value="<?php echo $biseFee ?>" name="sbisefee" class="form-control" id="sbisefee"
                        placeholder="Enter Student BISE Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




                <div class="form-group">
                    <label for="title">Student Annual Test Fee :</label>
                    <input type="number" value="<?php echo $annualTestFee ?>" name="sanuualtestfee" class="form-control" id="sanuualtestfee"
                        placeholder="Enter Student Annual Test Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>



                <div class="form-group">
                    <label for="title">Student Monthly Test Fee :</label>
                    <input type="number" value="<?php echo $monthlyTestFee ?>" name="smonthlytestfee" class="form-control" id="smonthlytestfee"
                        placeholder="Enter Student Monthly Test Fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>




                <div class="form-group">
                    <label for="title">Student Monthly Tution Fee :</label>
                    <input type="number" value="<?php echo $monthlyTutionFee ?>" name="smonthlytutionfee" class="form-control" id="smonthlytutionfee"
                        placeholder="Enter Student Monthly Tution fee" required 
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                </div>



<?php
        }
       

    }





















?>  


