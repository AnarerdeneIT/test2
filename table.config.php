<?

              $con =  new mysqli('localhost','root','','lottery');
              if(!$con) trigger_error(mysqli_connect_error());
              
              

              $query = "select l.id,s.lottery_name,l.oron,l.winner,l.insert_date,l.photoUrl
              from lottery_config l
              left join  lottery_name s
              on s.lottery_id = l.id
              where l.status = 1
             "
              ;

  
              $result = $con->query($query);
  
              $output='';
             
              $output .= '<div><table class="table" style="background-color:#0095da;color:white;">
              <thead>
                <tr>
                  <th width="10%" scope="col">Төрлийн дугаар</th>
                  <th width="10%" scope="col">Төрлийн нэр</th>
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
                                  <td>'.$row['lottery_name'].'</td>
                                  <td>'.$row['oron'].'</td>
                                  <td>'.$row['winner'].'</td>
                                  <td>'.$row['insert_date'].'</td>
                                  <td><button class="btn btn-success" id="btnedit" onclick="editData('.$row['id'].')">Засах</button></td>
                                  <td><button class="btn btn-danger" id="btndelete" onclick="deleteData('.$row['id'].')">Устгах</button></td>
                             </tr>';
               
  
        
              }
              $output.='</tbody>
              </table> </div>';
            
              echo $output;
  
  
  
  
      exit()

            
            
           
?>