<?
            $con =  new mysqli('localhost','root','','lottery');
            if(!$con) trigger_error(mysqli_connect_error());
            $query = "select c.dataid,f.customer_name,f.customer_rd,f.phone,f.hayg,c.lottery_num,insert_date
            from customer_form f 
            right join customer c 
            on f.customer_id = c.cust_id 
           "
            ;

            $result = $con->query($query);

            $output='';
           
            $output .= '<div><table class="table" style="color:white;">
            <thead>
              <tr>
                <th width="10%" scope="col">Нэр</th>
                <th width="10%" scope="col">Регистр</th>
                <th width="20%" scope="col">Утасны дугаар</th>
                <th width="15%" scope="col">Хаяг</th>
                <th width="20%" scope="col">Сугалааны дугаар</th>
                <th width="25%" scope="col">Бүртгүүлсэн өдөр</th>
                <th width="30%  scope="col">Устгах</th>
              </tr>
            </thead>
            <tbody>
            ';

            while($row = $result->fetch_assoc()) {
      
               
               
               $output .= '<tr>
                                <td>'.$row['customer_name'].'</td>
                                <td>'.$row['customer_rd'].'</td>
                                <td>'.$row['phone'].'</td>
                                <td>'.$row['hayg'].'</td>
                                <td>'.$row['lottery_num'].'</td>
                                <td>'.$row['insert_date'].'</td>
                                <td><button class="btn btn-danger" id="btndelete" onclick="deleteData('.$row['dataid'].')">Устгах</button></td>
                           </tr>';
             

              
            }
            $output.='</tbody>
            </table></div>';
          
            echo $output;




    exit;
?>