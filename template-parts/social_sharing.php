<div class="col-12 widget" ng-controller="sharingController">
    <div class="row">
        <div class="btn-group share" role="group">
            <a role="button" class="btn btn-secondary share__button share__button--facebook"
                data-toggle="tooltip" data-placement="top" title="{{shareTo}} Facebook" target="_bank"
                href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $data['url']; ?>">
                <i class="fa fa-facebook-f" aria-hidden="true"></i>
            </a>
            <a role="button" class="btn btn-secondary share__button share__button--twitter"
                data-toggle="tooltip" data-placement="top" title="{{tweetTo}} Twitter" target="_bank"
                href="https://twitter.com/intent/tweet?text=&url=<?php echo $data['url']; ?>">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a role="button" class="btn btn-secondary share__button share__button--google"
                data-toggle="tooltip" data-placement="top" title="{{shareTo}} Google Plus" target="_bank"
                href="https://plus.google.com/share?url=<?php echo $data['url']; ?>">
                <i class="fa fa-google-plus" aria-hidden="true"></i>
            </a>
            <a role="button" class="btn btn-secondary share__button share__button--line"
                data-toggle="tooltip" data-placement="top" title="{{shareTo}} Line" target="_bank"
                href="http://line.me/R/msg/text/?<?php echo $data['title']; ?>%0D%0A<?php echo $data['url']; ?>">
                <i class="fa fa-comment" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>