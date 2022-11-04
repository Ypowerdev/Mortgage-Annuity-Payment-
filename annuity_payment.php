<?php

function credit(float $S, float $P, float $N): array
{
    $P /= 1200;
    $N *= 12;
    $X = $S * $P / (1 - pow(1 + $P, -$N));
    return [$X, $X * $N - $S];
}

$credit_sum = 0;
$annual_percentage_rate = 0;
$year = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $credit_sum = (float) $_POST['credit_sum'];
    $annual_percentage_rate = (float) $_POST['annual_percentage_rate'];
    $year = (float) $_POST['year'];

    list($X, $overpayment) = credit($credit_sum, $annual_percentage_rate, $year);

    print_r("\n<br>Сумма кредита: " . $credit_sum);
    print_r("\n<br>Годовая процентная ставка: " . $annual_percentage_rate . '%');
    print_r("\n<br>Срок кредитования: " . $year . ' года');
    print_r("\n<br>Ежемесячный платеж: " . round($X, 2));
    print_r("\n<br>Переплата: " . round($overpayment, 2));
}

?>


<form method="POST">
   <div class="row">
      <p>Сумма кредита:<br> <input type="number" name="credit_sum" value="<?=$credit_sum?>"></p>
   </div>
   <div class="row">
   <p>Годовая процентная ставка:<br><input type="text" name="annual_percentage_rate" value="<?=$annual_percentage_rate?>"></p>
   </div>
   <div class="row">
   <p>Срок кредитования:<br><input type="number" name="year" value="<?=$year?>"></p>
   </div>
   <div class="row">
     <input type="submit">
   </div>
   </form>
