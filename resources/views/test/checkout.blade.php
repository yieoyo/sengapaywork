@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
    <div class="about_us_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="about_lottery_content">
                        <form name="order" method="post" action="#">
                            <input type="text" name="detail" value="Lorel ipsum">
                            <input type="text" name="amount" value="100">
                            <input type="text" name="order_id" value="1">
                            <input type="text" name="name" value="John doe">
                            <input type="text" name="email" value="<?php echo $_POST['email']; ?>">
                            <input type="text" name="phone" value="<?php echo $_POST['phone']; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop