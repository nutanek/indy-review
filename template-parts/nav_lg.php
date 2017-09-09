<nav class="row headernav--lg justify-content-center">
    <div class="col-md-11">
        <ul class="row justify-content-center font-theme">
            <li class="headernav--lg__menu --color-0">
                <?php echo __indy('home'); ?>
            </li>
            <?php for ($i=1; $i<6; $i++) : ?>
            <li class="headernav--lg__menu --dotted --color-<?php echo ($i%5); ?>">
                <?php echo __indy('หน้าแรก'); ?>
            </li>
            <?php endfor; ?>
        </ul>
    </div>
</nav>
