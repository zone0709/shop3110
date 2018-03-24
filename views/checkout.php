<div class="page-container">
    <div data-bottom-top="background-position: 50% 50px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -50px;"
        class="page-title page-reservation">
        <div class="container">
            <div class="title-wrapper">
                <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(-5px);" data--50-top="transform: translateY(-15px);opacity:0.8;"
                    data--120-top="transform: translateY(-30px);opacity:0;" data-anchor-target=".page-title" class="title">Giỏ hàng của bạn</div>
                <div data-top="opacity:1;" data--120-top="opacity:0;" data-anchor-target=".page-title" class="divider">
                    <span class="line-before"></span>
                    <span class="dot"></span>
                    <span class="line-after"></span>
                </div>
                <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(5px);" data--50-top="transform: translateY(15px);opacity:0.8;"
                    data--120-top="transform: translateY(30px);opacity:0;" data-anchor-target=".page-title" class="subtitle">Just a few click to make the reservation online for saving your time and money</div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">
        <section class="section-reservation-form padding-top-100 padding-bottom-100">
            <div class="container"  id="addContent">
                <div class="section-content" >
                    
                    <?php if(isset($_SESSION['error'])):?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?=$_SESSION['error']; unset($_SESSION['error'])?>
                        </div>
                    <?php endif?>
                    <?php if(isset($_SESSION['success'])):?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?=$_SESSION['success']; unset($_SESSION['success'])?>
                        </div>
                    <?php endif?>

                    
                    <?php  if((isset($data['cart']) &&  $data['cart']->totalPrice==0) || !isset($data['cart'])){ ?>
                    <div class="swin-sc swin-sc-title style-2 light">
                        <h3 class="title">
                            <span style="color:#000">Giỏ hàng rỗng</span>
                        </h3>
                    </div>
                    <?php  }else{
            // echo "<pre>";
            // print_r($data['cart']);
            // echo "</pre>";
            ?>
                    <div class="swin-sc swin-sc-title style-2">
                        <h3 class="title">
                            <span>Chi tiết giỏ hàng</span>
                        </h3>
                    </div>
                    <div class="reservation-form">
                        <div class="swin-sc swin-sc-contact-form light mtl">
                            <table class="table table-bordered" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th width="30%" style="text-align: center;">Product</th>
                                        <th width="20%" style="text-align: center;">Price</th>
                                        <th width="20%" style="text-align: center;">Qty.</th>
                                        <th width="20%" style="text-align: center;">Total</th>
                                        <th width="10%" style="text-align: center;">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $cart = $data['cart'];
                                    foreach($cart->items as $id=>$sanpham):
                                    ?>
                                    <tr class="item-<?=$id?>">
                                        <td>
                                            <img src="public/source/assets/images/hinh_mon_an/<?=$sanpham['item']->image?>" width="250px">
                                            <p>
                                                <br>
                                                <b>
                                                    <?=$sanpham['item']->name?>
                                                </b>
                                            </p>
                                        </td>
                                        <td>
                                            <?=number_format($sanpham['item']->price,0,',','.')?> vnd</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="quanlity"  value="<?=$sanpham['qty']?>" class="form-control qty-<?=$id?> qty" dataid="<?=$id?>">
                                                
                                            </div>
                                            
                                        </td>
                                        <td class="price-<?=$id?>">
                                            <?= number_format($sanpham['price'],0,',','.') ?> vnd</td>
                                        <td>
                                            <a class="remove" data-id="<?=$id?>" title="Remove this item">
                                                <i class="fa fa-trash-o fa-2x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach?>
                                    <tr>
                                        <td colspan="3" style="text-align:right">
                                            <b>Tổng tiền:</b>
                                        </td>
                                        <td colspan="2" style="color:blue">
                                            <b id="tongtien">
                                                <?=number_format($cart->totalPrice,0,',','.')?> vnd</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="swin-sc swin-sc-contact-form light mtl style-full">
                            <div class="swin-sc swin-sc-title style-2">
                                <h3 class="title">
                                    <span>Đặt hàng</span>
                                </h3>
                            </div>
                            <form method="POST">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" placeholder="Fullname" class="form-control" name="fullname" required value="ádf">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="text" placeholder="Email" class="form-control" name="email" required value="huongnguyenak96@gmail.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <div class="fa fa-map-marker"></div>
                                        </div>
                                        <input type="text" placeholder="Address" class="form-control" name="address" value="ádf" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <div class="fa fa-phone"></div>
                                        </div>
                                        <input type="text" placeholder="Phone" class="form-control" name="phone" value="ádf" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea placeholder="Message" class="form-control" name="note">qưertyu</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="swin-btn-wrap center">
                                        <button class="swin-btn center form-submit" name="btnCheckout">Checkout</button>
                                       
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        <section data-bottom-top="background-position: 50% 100px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px;"
            class="section-reservation-service padding-top-100 padding-bottom-100">
            <div class="container">
                <div class="section-content">
                    <div class="swin-sc swin-sc-title style-2 light">
                        <h3 class="title">
                            <span>Fooday Best Service</span>
                        </h3>
                    </div>
                    <div class="swin-sc swin-sc-iconbox light">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="item icon-box-02 wow fadeInUpShort">
                                    <div class="wrapper-icon">
                                        <i class="icons swin-icon-dish"></i>
                                        <span class="number">1</span>
                                    </div>
                                    <h4 class="title">Reservation</h4>
                                    <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div data-wow-delay="0.5s" class="item icon-box-02 wow fadeInUpShort">
                                    <div class="wrapper-icon">
                                        <i class="icons swin-icon-dinner-2"></i>
                                        <span class="number">2</span>
                                    </div>
                                    <h4 class="title">Private Event</h4>
                                    <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div data-wow-delay="1s" class="item icon-box-02 wow fadeInUpShort">
                                    <div class="wrapper-icon">
                                        <i class="icons swin-icon-browser"></i>
                                        <span class="number">3</span>
                                    </div>
                                    <h4 class="title">Online Order</h4>
                                    <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div data-wow-delay="1.5s" class="item icon-box-02 wow fadeInUpShort">
                                    <div class="wrapper-icon">
                                        <i class="icons swin-icon-delivery"></i>
                                        <span class="number">4</span>
                                    </div>
                                    <h4 class="title">Fast Delivery</h4>
                                    <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.qty').keyup(function(){
            var idSP = $(this).attr('dataid')
            var soluong = $(this).val()
            if(isNaN(soluong) ){
                alert('Vui lòng nhập số')
                return false;
            }
            else if(parseInt(soluong)<=0 ){
                alert('Vui lòng nhập số lượng > 0')
                return false;
            }
            var delay = (function(){
                var timer = 0;
                return function(cb, ms){
                    clearTimeout (timer);
                    timer = setTimeout(cb, ms);
                };
            })();
            delay(function(){
                if(parseInt(soluong)>0){
                    $.ajax({
                        url: "cart.php",
                        data: {
                            qty: soluong,
                            id: idSP,
                            action: "update"
                        },
                        type: "GET",
                        dataType:"JSON",
                        success: function (result) {
                            console.log(result)
                            let total = result.total
                            let totalOneFood = result.totalOneFood
                            // console.log(totalOneFood)
                            // console.log(total)
                            $('.price-' + idSP).html(totalOneFood)
                            $('#tongtien').html(total)
                        }
                    })
                }
            },1000)
        })
        $('.quanlity-plus').click(function () {
            
        })
        $('.remove').on('click',function(){
            var idSP = $(this).attr('data-id');
            $.ajax({
                url: "cart.php",
                data: {
                    id: idSP,
                    action: "delete"
                },
                type: "GET",
                success: function (result) {
                    if($.trim(result)==0){
                        $('#addContent').html(`
                            <div class="section-content">
                                <div class="swin-sc swin-sc-title style-2 light">
                                    <h3 class="title">
                                        <span style="color:#000">Giỏ hàng rỗng</span>
                                    </h3>
                                </div>
                            </div>
                        `)
                    }
                    $('.item-'+idSP).hide(500)
                    //console.log(result)
                    $('#tongtien').html(result)
                }
            })
        })
    })
</script>