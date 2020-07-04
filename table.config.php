<?
            
            if(isset($_REQUEST['id'])) {
              $id = $_REQUEST['id'];
            
            }
            
            
            
            $con =  new mysqli('localhost','root','','lottery');
            if(!$con) trigger_error(mysqli_connect_error());
            $query = "select * from lottery_config
            ";
            ;

            $result = $con->query($query);

            $output='';
           
            $output .= '<table class="table table-dark">
            <thead>
              <tr>
                <th width="10%" scope="col">#</th>
                <th width="10%" scope="col">Төрлийн дугаар</th>
                <th width="10%" scope="col">Оронгын тоо</th>
                <th width="15%" scope="col">Ялагчийн тоо</th>
                <th width="20%" scope="col">Бүртгүүлсэн огноо</th>
                <th width="10%  scope="col">Засах</th>
                <th width="10%  scope="col">Устгах</th>
              </tr>
            </thead>
            <tbody>
            ';

            while($row = $result->fetch_assoc()) {
      
               
               
               $output .= '<tr id='.$row['id'].'>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['type'].'</td>
                                <td>'.$row['oron'].'</td>
                                <td>'.$row['winner'].'</td>
                                <td>'.$row['insert_date'].'</td>
                                <td><button class="btn btn-success" id="btnedit" onclick="editData('.$row['id'].')">Засах</button></td>
                                <td><button class="btn btn-danger" id="btndelete" onclick="deleteData('.$row['id'].')">Устгах</button></td>
                           </tr>';
             

      
            }
            $output.='</tbody>
            </table>';
          
            echo $output;




    exit;
?>