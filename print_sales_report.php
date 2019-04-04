<?php
 include 'stockist_session.php';
include 'header.php';
  include 'functions.php';
  $user=$_SESSION['store'];
  $company_name = '';
  $phone = '';
  $mail = '';
  $sql = mysqli_query($conn, "SELECT * FROM settings");
  $result = mysqli_num_rows($sql);
  if($result > 0){
    $rw = mysqli_fetch_array($sql);
    $company_name = $rw['companyName'];
    $phone = $rw['companyTelephone'];
    $company_name = $rw['companyEmail'];
  }else{
    $company_name = 'Easy Inventory';
    $phone = '0784156404';
    $mail = 'info@easyinventory.com';

  }

    $sql1=mysqli_query($conn,"SELECT c.idcustomer,c.fname,c.lname,p.idstock,s.cost_price,s.sales_price,s.chasis_number,s.engine_number,k.name,k.details FROM customer c,payment p, sales_order d,stock s,stocklist k WHERE s.idstockList=k.idstockList AND c.idcustomer=d.idcustomer AND p.idcustomer=c.idcustomer AND p.idstock=s.idstock GROUP BY s.idstock"); 
    if (isset($_POST['search'])) {
        if (empty($_POST['date_from']) || empty($_POST['date_to'])) {
          $sql1=mysqli_query($conn,"SELECT c.idcustomer,c.fname,c.lname,p.idstock,s.cost_price,s.sales_price,s.chasis_number,s.engine_number,k.name,k.details FROM customer c,payment p, sales_order d,stock s,stocklist k WHERE s.idstockList=k.idstockList AND c.idcustomer=d.idcustomer AND p.idcustomer=c.idcustomer AND p.idstock=s.idstock GROUP BY s.idstock"); 
        }else{
          $sql1=mysqli_query($conn,"SELECT c.idcustomer,c.fname,c.lname,p.idstock,s.cost_price,s.sales_price,s.chasis_number,s.engine_number,k.name,k.details FROM customer c,payment p, sales_order d,stock s,stocklist k WHERE s.idstockList=k.idstockList AND c.idcustomer=d.idcustomer AND p.idcustomer=c.idcustomer AND p.idstock=s.idstock AND DATE(d.occured_on) BETWEEN '".$_POST['date_from']."' AND '".$_POST['date_to']."' GROUP BY s.idstock");
        }
    }
        ?>
        <script type="text/javascript">
        	window.print();
        </script>
        <div class="box-header">
        <?php
            echo '<h3>'.$company_name.'</h3>';
        ?>
        </div>
    <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th><small>ID</small></th>
                  <th><small>Customer Name</small></th>
                  <th><small>Item</small></th>
                  <th><small>Cost price(UGX)</small></th>
                  <!-- <th><small>Expenses(UGX)</small></th> -->
                  <th><small>Sell price(UGX)</small></th>
                  <th><small>Amount paid(UGX)</small></th>         
                  <th><small>Balance(UGX)</small></th>
                  <th><small>Gross profit(UGX)</small></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                if(mysqli_num_rows($sql1) > 0){
                while ($row=mysqli_fetch_array($sql1)) {
                  $idcustomer=$row['idcustomer'];
                  $id=$row['idstock'];
                  // echo $idcustomer;
                  $amount= selectTotalPayment($row['idcustomer'],$row['idstock']);
                  echo '<tr>';
                  echo '<td>'.$i.'</td>';
                    echo '<td>'.$row['fname'].' '.$row['lname'].'</td>';
                    echo '<td>'.$row['name'].' '.$row['details'].' CH:'.$row['details'].''.$row['chasis_number'].' EN:'.$row['engine_number'].'</td>';
                    echo '<td>'.$row['cost_price'].'</td>';
                    echo '<td>'.$row['sales_price'].'</td>';
                    echo '<td>'.$amount.'</td>';
                    $bal = $row['sales_price'] - $amount;
                    if($bal>0){

                    }elseif ($bal<0) {
                      $bal=$bal.'(Refund)';
                      # code...
                    }
                    $gross = $row['sales_price']-$row['cost_price']; 
                    echo '<td>'.$bal.'</td>';
                    echo '<td>'.$gross.'</td>';
                    // $bal = $row['balance'];
                    // if($bal>0){
                    // echo '<td>'.$bal.'</td>';
                    // }else{
                    //   echo '<td>'.'0.00'.'</td>';
                    // }

                  echo'</tr>';
                  $i++;
                }
              }
                ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>