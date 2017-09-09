<div class="row indy_slide d-none d-sm-block">
<?php
    $imgArr = array(
        "http://www.planwallpaper.com/static/images/Beauty-of-nature-random-4884759-1280-800.jpg",
        "http://localhost/wp/wp-content/uploads/2017/06/19-2015-By-Stephen-Comments-Off-on-Hot-Air-Balloons-Wallpapers-1024x640.jpg",
        "https://www.w3schools.com/css/img_fjords.jpg",
    );
?>

<?php for ($i=0; $i<3; $i++) : ?>
<div indy-img ng-style="wrapSize" class="item text-center">
    <div class="row align-items-center" ng-show="loading" ng-style="{'height': hFrame}">
        <div class="col"><slide-loader/></div>
    </div>
    <img class="fideIn" ng-hide="loading" ng-style="imgSize" ng-src="<?php echo $imgArr[$i]; ?>" alt="">
</div>
<?php endfor; ?>
</div>

<script>
$(".indy_slide").responsiveSlides({
    auto: true,
    speed: 500,
    timeout: 4000,
    pause: false,
    pauseControls: true,
    nav: true,
    prevText: "Previous",
    nextText: "Next",
});
</script>