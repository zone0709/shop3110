<!-- <style>
.slick-padding{
    clear:both;
    height:auto
}
</style> -->
<div class="page-container">
    <div data-bottom-top="background-position: 50% 50px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -50px;"
        class="page-title page-menu">
        <div class="container">
            <div class="title-wrapper">
                <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(-5px);" data--50-top="transform: translateY(-15px);opacity:0.8;"
                    data--120-top="transform: translateY(-30px);opacity:0;" data-anchor-target=".page-title" class="title">Tìm kiếm món ăn</div>
                <div data-top="opacity:1;" data--120-top="opacity:0;" data-anchor-target=".page-title" class="divider">
                    <span class="line-before"></span>
                    <span class="dot"></span>
                    <span class="line-after"></span>
                </div>
                <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(5px);" data--50-top="transform: translateY(15px);opacity:0.8;"
                    data--120-top="transform: translateY(30px);opacity:0;" data-anchor-target=".page-title" class="subtitle">The various dishes are waiting for your coming to enjoy its</div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">
        <section class="product-sesction-02 padding-top-100 padding-bottom-100">
            <div class="container">
                <div class="swin-sc swin-sc-title style-3">
                    <p class="title">
                        <span>Tìm kiếm món ăn</span>
                    </p>
                </div>
                <div class="swin-sc swin-sc-product products-02 carousel-02">
                    <div class="row ">
                        <label class="col-md-6 col-md-offset-3">Nhập tên món/mô tả/đơn giá:
                            <input type="text" class="form-control" id="keyword">
                        </label>
                    </div>

                    <div class="row"><button class="btn btn-success btnLoadMore">Xem thêm</button></div>
                    <div class="products nav-slider margin-top-50">
                        <div class="row slick-padding" id="show-data">
                            <?php foreach($data['promotionFoods'] as $f):?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="blog-item item swin-transition">
                                    <div class="block-img">
                                        <img src="public/source/assets/images/hinh_mon_an/<?=$f->image?>" alt="" class="img img-responsive" style="height:300px">
                                        <div class="block-circle price-wrapper">
                                            <span class="price woocommerce-Price-amount amount">
                                                <?=number_format($f->price)?>
                                                    <span class="price-symbol">vnd</span>
                                            </span>
                                        </div>
                                        <div class="group-btn">
                                            <a href="<?=$f->id?>-<?=$f->url?>.html" class="swin-btn btn-link">
                                                <i class="icons fa fa-link"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="swin-btn btn-add-to-card">
                                                <i class="fa fa-shopping-basket"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <h5 class="title">
                                            <a href="<?=$f->id?>-<?=$f->url?>.html">
                                                <?=$f->name?>
                                            </a>
                                        </h5>
                                        <div class="product-info">
                                            <?=$f->summary?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(document).ready(function(){

        var delay = (function(){
            var timer = 0;
            return function(cb, ms){
                clearTimeout (timer);
                timer = setTimeout(cb, ms);
            };
        })();
        var clickTime = 1
        $('#keyword').keyup(function() {
            delay(function(){
                var keyword = $('#keyword').val()
                if($.trim(keyword)!=''){
                    $.ajax({
                        type:'POST',
                        data:{
                            tukhoa: keyword,
                            clickTime:clickTime
                        },
                        url:'search.php',
                        
                        success:function(value){
                            if($.trim(value)!=''){
                                $('#show-data').html(value)
                                //$('#show-data').append(value)
                                //$('#show-data').prepend(value)
                            }
                            
                        }
                    })
                }
                //else alert("Vui lòng nhập từ khoá")
                
            }, 1000 );
        });
        
        // $('.btnLoadMore').click(function(){
        //     var keyword = $('#keyword').val()
        //     clickTime = clickTime+1
        //     if($.trim(keyword)!=''){
        //             $.ajax({
        //                 type:'POST',
        //                 data:{
        //                     tukhoa: keyword,
        //                     clickTime:clickTime
        //                 },
        //                 url:'search.php',
        //                 success:function(value){
        //                     console.log(value)
        //                     if($.trim(value)!=''){
        //                         $('#show-data').append(value)
        //                     }
                            
        //                 }
        //             })
        //         }
        // })

    })
</script>

