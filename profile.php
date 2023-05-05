<?php
include("db.php");
include("header.php");
include("sidebar.php");
?>




      <!-- wrapper part start here  -->
      <div class="content-wrapper"> 
        <div class="card m-2">
            <div class="row">
                <div class="col-md-10">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="images/logo.png" class="img-fluid pro_img" alt="">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      </div>
    
<?php
include("footer.php");
?>