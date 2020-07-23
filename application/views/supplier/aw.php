<?php
for ($i = 1; $i <= 100; $i++) { ?>
    <li>Menu <?php echo $i?></li>
<?php
}
?>


<?php
$babi = 'ayam';
for ($i = 1; $i <= 100; $i++) { 
    // echo "<li>Menu $i</li>";
    echo '<li>Menu $i</li>';
    echo $babi.'_'.$i;
?>
