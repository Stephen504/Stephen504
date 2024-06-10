<?php include('layouts/header.php');?>
<!--Home-->
<section id="home">
<div class="container">
  <h5>New Arrivals</h5>
  <h1>Best Prices this Season</h1>
  <p>Perfect Comfort Furniture  offers quality Furniture at the most affordable prices! </p>
  <a href="shop.php"><button>Shop Now</button></a>
</div>
</section>
   
<!--Brand-->

<section id="brand" class="container">
  <div class="row justify-content-start"> 
    <img class="img-fluid col-lg-1 col-md-6 col-sm-12" src="assets/imgs/brand1.png"/>
    <img class="img-fluid col-lg-1 col-md-6 col-sm-12" src="assets/imgs/brand2.png"/>
    <img class="img-fluid col-lg-1 col-md-6 col-sm-12" src="assets/imgs/brand3.jpg"/>
  </div>
</section>

<!--New Brand-->
<section id="new" class="w-100">
<div class="row p-0 m-0"> 
  <!--One-->
  <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
  <img class=" img-fluid" src="assets/imgs/couch10.jpg"/>
  <div class="details">
    <h2> Okamura Couch 2 seater</h2>
    <button class="text-uppercase">Buy Now</button>
  </div>
  </div>
  <!--two -->
  <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class=" img-fluid" src="assets/imgs/couch20.jpg"/>
    <div class="details">
      <h2>HNI 2 seater Lounge Suite</h2>
      <button class="text-uppercase">Buy Now</button>
    </div>
    </div>
  <!--three -->
  <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class=" img-fluid" src="assets/imgs/couch30.jpg"/>
    <div class="details">
      <h2>good Awesome shoes</h2>
      <button class="text-uppercase">Buy Now</button>
    </div>
    </div>
</div>

</section>


<!--fEAUTURED-->
<section ID="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured Products</h3>
    <hr class="red-line">
    <p>Here you can view our Featured products</p>
  </div>
  </div>

  <div class="row mx-auto container-fluid">

  <?php include('server/get_featured_products.php');?>
  

    <?php while($row= $featured_products->fetch_assoc()){ ?>
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
</section>

<!--Banner-->
<section id = "banner" class="my-5 py-5" >
  <div class="container">
    <h4>MID SEASON SALE</h4>
    <h1>Spring Sale Collection <br> Up to 30% Off</h1>
    <a href="shop.php"><button>Shop Now</button></a>
  </div>
</section>

<!--Chairs and stools-->
<section ID="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Chairs and Stools</h3>
    <hr class="red-line">
    <p>Here you can view our Chairs and Stools</p>
  </div>
  </div>

  <div class="row mx-auto container-fluid">

  <?php include('server/get_chairs_stools.php');?>

    <?php while($row= $chairs_products->fetch_assoc()){ ?>
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
</section>

<!--Office Chairs-->
<section ID="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Office Chairs</h3>
    <hr class="red-line">
    <p>Here you can view our Office Chairs</p>
  </div>
  </div>

  <div class="row mx-auto container-fluid">

  <?php include('server/get_office_chairs.php');?>

    <?php while($row= $office_products->fetch_assoc()){ ?>
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
</section>

<!--Camping Chairs-->
<section ID="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Camp Chairs</h3>
    <hr class="red-line">
    <p>Here you can view our Camp Chairs</p>
  </div>
  </div>

  <div class="row mx-auto container-fluid">

  <?php include('server/get_camp_chairs.php');?>

    <?php while($row= $camp_products->fetch_assoc()){ ?>
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
</section>

<?php include('layouts/footer.php');?>