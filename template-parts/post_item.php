<?php $lorem = array(
    "โปรดิวเซอร์แฟรนไชส์ ซิงซันตาคลอสซาร์ดีน เซนเซอร์วอลซ์คีตราชัน แพนด้าสะเด่าเอสเพรสโซเฟิร์ม",
    "โทรโค้กศิรินทร์ซูเปอร์ซาตาน อาว์เยอร์บีราเวิร์กตุ๊กมาร์ต ยากูซ่า",
    "ปูอัดมาราธอนออเดอร์ เฮอร์ริเคนบาบูนงั้น กระดี๊กระด๊าฟิวเจอร์คัตเอาต์ ว้อยฮ่องเต้เปราะบางเฟรมคอร์รัปชัน ซาตานบาร์บี้ดาวน์ ยอมรับอุปการคุณวิลเลจคีตราชัน เรตไอติมช็อต สเตชัน สโตร์แชมป์เจ๊ อะซาฟารีลาเต้ เบนโลเยนก๋ากั่น อาว์เดโมคาราโอเกะเปโซอาร์ติสต์ ลาติน กุมภาพันธ์หลวงปู่ ฮ่องเต้ ซาบะ"
); 

$img = array(
    "http://demo.themeton.com/pressgrid/wp-content/uploads/sites/73/2017/01/layer-2.jpg",
    "http://demo.themeton.com/pressgrid/wp-content/uploads/sites/73/2017/01/hanburger-double-400x171.jpg",
    "http://demo.themeton.com/pressgrid/wp-content/uploads/sites/73/2017/01/layer-6.jpg"
);
?>
<?php for ($i=0; $i<10; $i++) :?>

<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 grid-item" style="margin-bottom: 25px;">
    <div class="col card no-padding">
        <img class="card-img-top" src="<?php echo $img[$i%3]?>" alt="Card image cap">
        <div class="card-body">
            <p class="card-text"><?php echo $lorem[$i%3]?> <?php echo $i ?></p>
        </div>
    </div>
</div>
<?php endfor; ?>