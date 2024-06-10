<?php
include('server/connection.php');


$stmt=$conn->prepare("SELECT * FROM products");
$stmt->execute();
$products=$stmt->get_result();

?>



<?php include('layouts/header.php');?>

      <section ID="featured" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
          <h3>All Our Products</h3>
          <hr class="red-line">
          <p>Here you can browse all products in our catalogue</p>
        </div>
        </div>
      
        <div class="row mx-auto container-fluid">


  

    <?php while($row= $products->fetch_assoc()){ ?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
      <div class="star">
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price"> R <?php echo $row['product_price']; ?></h4>
     <a href= "<?php echo "single_products.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy now</button> </a> 
    </div>
    <?php } ?> 

 
</div>
    
</div>
























          
                  
              <!--Put inside this div-->

              <nav aria-label="page navigation">
                <ul class="pagination mt-5">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
            </div>

    </section>

   



    <?php include('layouts/footer.php');?>