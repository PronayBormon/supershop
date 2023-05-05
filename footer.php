</div>
    
   
    
    
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- tolltips -->
    <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

      // data table javascript file 
      $(document).ready(function () {
          $('#User_table').DataTable();
      });

      // sass 
      
    </script>

    <!-- search  -->
    <script type="text/javascript">
    $(document).ready(function(){
      $("#live_search").keyup(function(){
        var input = $(this).val();
        //alert(input);
        if(input != ""){
          $.ajax({
            url:"livesearch.php",
            method:"post",
            data:{input:input}, 

            success:function(data){
              $("#search_result").html(data);
            }
          });
        }else{
          $("#search_result").html(data);
        }
      });
    });
    //modal 
    
    </script>
 

    </body>
</html>
<?php ob_end_flush();
?>