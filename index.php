<?php

// require_once 'init/init.php';
require('top.php');

if(Session::exists('home'))
{
    //echo $_SESSION['home'].'<br>';

}

$user = new User();

if($user->isLoggedIn())
{
    ?>
    <ul>
        <li><a href="logout.php">logout</a></li>
        <?php if(Session::exists('admin')){
            ?>
        <li><a href="dashboard.php">Dashboard</a></li>
            <?php
        }
        ?>
    </ul>
<?php
}
else
{
    ?>
    <!-- <div>
        <p>You need to<a href="login.php">login</a> or <a href="register.php">register</a></p>
    </div> -->
<?php
}
$categories = DB::connect()->getAll('category')->fetchAll()->result();
?>

<?php

$id = (isset($_GET['id']))?$_GET['id'] : '';

if(!empty($id)){
    $products = DB::connect()->get('product',array('category_id'=>$id))->fetchAll()->result();
    }
    else{
        $products = DB::connect()->getAll('product')->fetchAll()->result();
    }
 ?>

<!-- 
 <table class="table table-striped">
   <thead>
     <tr>
       <th scope="col">product name</th>
       <th scope="col">price</th>
       <th scope="col">company</th>
       <th scope="col">generic</th>
       <th scope="col">type</th>
     </tr>
   </thead>
   <tbody>
     <?php foreach($products as $product): ?>
         <tr>  
         <td><?php echo $product->product_name; ?></td>
         <td><span>per pata </span><?php echo $product->price; ?><span> taka</span></td>
         <td><?php echo $product->company; ?></td>
         <td><?php echo $product->generic; ?></td>
         <td><?php echo $product->type; ?></td>
         </tr>
     <?php endforeach;?>
   </tbody>
 </table> -->





<div class="body__overlay"></div>

        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        
        
        <!-- Start Slider Area -->
        <div class="slider__container slider--one bg__cat--3">
            <div class="slide__container slider__activation__wrap owl-carousel">
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>Pharma to your home</h2>
                                        <h1>MediShop</h1>
                                        <div class="cr__btn">
                                            <a href="index.php">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/1.png" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                    <h2>30TK delivery charge only</h2>
                                        <h1>fastest delivery</h1>
                                        
                                        <div class="cr__btn">
                                            <a href="index.php">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/2.png" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- Start Slider Area -->

        <section class="ftr__product__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">All Products</h2>
                            <p>Any product including Medicine, Equipments and Others</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__wrap clearfix">
                    <?php foreach($products as $product): ?>

                        <!-- Start Single Category -->
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                
                                    <a href="product.php?id=<?php echo $product->id;?>">
                                        <img src="images/product/9.jpg" alt="product images">
                                    </a>
                                </div>
                                
                                <div class="fr__product__inner">
                                    <h5><?php echo $product->product_name; ?></h5>
                                    <h5><?php echo 'MRP '.$product->price; ?></h5>
                                    <h5><?php echo $product->company; ?></h5>
                                    <h5><?php echo $product->generic; ?></h5>
                                   
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>

                        <!-- End Single Category -->


                       

                         
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Area -->

<?php require 'footer.php'; ?>



