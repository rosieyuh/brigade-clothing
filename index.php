<?php


session_start();

if (isset($_SESSION["user_id"])) 
{
    
    $mysqli = require __DIR__ . "/admin_panel/database.php";
    
    $sql = "SELECT * FROM customer
            WHERE customerid = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user_id = $result->fetch_assoc();
}

?>
<!doctype html>
<html>

<head>
    <title>BRIGADE</title>
    <?php include 'include/head.php';?>
    
</head>

<body>
    
    <?php include 'include/nav.php';?>
    
     <section class="banner_part">
        <div class="container">
            <div class="banner_slider">
                <div class="single_banner_slider">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5>BRIGADE CLOTHING</h5>
                            <h1>FASHION CLOTHING 2023</h1>
                            <a href="shop.php" class="btn_1">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature_part start-->
    <section class="feature_part pt-4">
        <div class="container-fluid p-lg-0 overflow-hidden">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature_post_text">
                        <img src="img/feature_1.jpg" alt="#">
                        <div class="hover_text">
                            <a href="shop.php" class="btn_2">SHOP FOR SHIRTS</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature_post_text">
                        <img src="img/feature_2.jpg" alt="#">
                        <div class="hover_text">
                            <a href="shop.php" class="btn_2">SHOP FOR BAGS</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_feature_post_text">
                        <img src="img/feature_3.jpg" alt="#">
                        <div class="hover_text">
                            <a href="shop-item-image" class="btn_2">SHOP FOR HOODIES</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- upcoming_event part start-->

    <!-- new arrival part here -->
    <section class="new_arrival section_padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="arrival_tittle">
                        <h2>NEW ARRIVAL</h2>
                    </div>
                </div> 
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="new_arrival_iner filter-container">
                        <div class="single_arrivel_item weidth_1 mix men">
                            <img src="img/arrivel/arrivel_5.jpg" alt="#">
                            <div class="hover_text">
                                <p>NEW</p>
                                <a href="single-product.html"><h3>GUIDANCE SHIRT</h3></a>
                                <div class="rate_icon">
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                </div>
                                <h5>₱550.00</h5>
                            </div>
                        </div>
                        <div class="single_arrivel_item weidth_2 mix women">
                            <img src="img/arrivel/arrivel_2.jpg" alt="#">
                            <div class="hover_text">
                                <p>NEW</p>
                                <a href="single-product.html"><h3>DYE HOODIE</h3></a>
                                <div class="rate_icon">
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                </div>
                                <h5>₱850.00</h5>

                            </div>
                        </div>
                        <div class="single_arrivel_item weidth_3 mix women" >
                            <img src="img/arrivel/arrivel_3.jpg" alt="#">
                            <div class="hover_text">
                                <p>NEW</p>
                                <a href="single-product.html"><h3>MIRAGE PULL OVER</h3></a>
                                <div class="rate_icon">
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                </div>
                                <h5>₱1000.00</h5>

                            </div>
                        </div>
                        <div class="single_arrivel_item weidth_3 mix men">
                            <img src="img/arrivel/arrivel_4.jpg" alt="#">
                            <div class="hover_text">
                                <p>NEW</p>
                                <a href="single-product.html"><h3>HELLO SHIRT</h3></a>
                                <div class="rate_icon">
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                </div>
                                <h5>₱550.00</h5>
   
                            </div>
                        </div>
                        <div class="single_arrivel_item weidth_2 mix men">
                            <img src="img/arrivel/arrivel_1.jpg" alt="#">
                            <div class="hover_text">
                                <p>NEW</p>
                                <a href="single-product.html"><h3>STRAY WHITE SHIRT</h3></a>
                                <div class="rate_icon">
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                </div>
                                <h5>₱550.00</h5>
   
                            </div>
                        </div>
                        <div class="single_arrivel_item weidth_1 mix men">
                            <img src="img/arrivel/arrivel_6.jpg" alt="#">
                            <div class="hover_text">
                                <p>NEW</p>
                                <a href="single-product.html"><h3>WORLDWIDE SHIRT</h3></a>
                                <div class="rate_icon">
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                    <a href="#"> <i class="fas fa-star"></i> </a>
                                </div>
                                <h5>₱550.00</h5>
     
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <!-- new arrival part end -->

    <?php include 'include/footer.php';?>

