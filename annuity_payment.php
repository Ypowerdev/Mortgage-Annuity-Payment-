<?php

function credit() {
   

    $S = $_POST['credit_sum']; 
    print_r("\n<br>Сумма кредита: " . $S);
    
    $P = $_POST['annual_percentage_rate']; 
    print_r("\n<br>Годовая процентная ставка: " . $P. '%');
   
    $P /= 100;
    
    $N = $_POST['year']; 
    print_r("\n<br>Срок кредитования: " . $N . ' года');

    $X = $S * ( $P + ( $P / ( pow(1+$P , $N) - 1 ) ) );
    print_r("\n<br>Ежегодный платеж: " . $X);
    print_r("\n<br>Ежемесячный платеж: " . $X/12);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
echo credit (); 
} 
?>


<form method="POST"> 
   <div class="row"> 
      <p>Сумма кредита:<br> <input type="number" name="credit_sum" value="<?= $S ?>"></p>
   </div> 
   <div class="row"> 
   <p>Годовая процентная ставка:<br><input type="number" name="annual_percentage_rate" value="<?= $P ?>"></p>
   </div> 
   <div class="row"> 
   <p>Срок кредитования:<br><input type="number" name="year" value="<?= $N ?>"></p>
   </div> 
   <div class="row">
     <input type="submit"> 
   </div> 
   </form>   