<?php

class AnnuityPayment
{ 
    private float $creditSum; 
    private float $annualPercentageRate; 
    private float $creditForYears; 
    private const MONTHS_IN_YEAR = 12; 
    private const COEFFICIENT = 1200;
    private const INIT_NUMBER = 0; 
    private $testCases = [
            [
            'creditSum' => 6000000,
            'annualPercentageRate' => 8, 
            'creditForYears' => 10
            ],
            [
            'creditSum' => 5000000,
            'annualPercentageRate' => 10, 
            'creditForYears' => 12
            ],
            [
            'creditSum' => 4000000,
            'annualPercentageRate' => 8, 
            'creditForYears' => 10
            ]
        ];  
      
    public function __construct(array $creditData = []) 
    { 
        if (!empty($creditData)) { 
            $this->creditSum = $creditData['creditSum']; 
            $this->annualPercentageRate = $creditData['annualPercentageRate']; 
            $this->creditForYears = $creditData['creditForYears'];
        } else {
            echo 'Пожалуйста, введите данные в форму!'."\n";
            echo "</br>"; 
            echo 'Вот примерные данные!'."\n";
            echo "</br>"; 
            
            $indexTestCreditData = rand(0,2); 
            $this->creditSum = $this->testCases[$indexTestCreditData]['creditSum'];
            $this->annualPercentageRate = $this->testCases[$indexTestCreditData]['annualPercentageRate'];
            $this->creditForYears =  $this->testCases[$indexTestCreditData]['creditForYears'];
        }
        
        $this->creditForMonths = $this->creditForYears * self::MONTHS_IN_YEAR; 
        $this->percentageCoefficient = $this->annualPercentageRate / self::COEFFICIENT;
    }
    
    public function getForm(): string 
    {                     
        $form = '';
        <form method="POST">
        <div class="row">
            <p>Сумма кредита:<br> <input type="number" name="creditSum" value="'. self::INIT_NUMBER . '"></p>
        </div>
        <div class="row">
        <p>Годовая процентная ставка:<br><input type="number" name="annualPercentageRate" value="'. self::INIT_NUMBER . '"></p>
        </div>
        <div class="row">
            <p>Срок кредитования:<br><input type="number" name="creditForYears" value="' . self::INIT_NUMBER . '"></p>
        </div>
        <div class="row">
            <input type="submit">
        </div>';
        
        $form .= '</form>';
        return $form; 
    } 
    
    private function getAnnPayment(): float
    { 
        
        $credit1 = $this->creditSum * $this->percentageCoefficient; 
        $credit2 = 1 - pow(1 + $this->percentageCoefficient, -$this->creditForMonths); 
        $annuityPayment = $credit1 / $credit2; 
        return $annuityPayment; 
    }
    
    private function getOverpaymentInfo(): float
    {
        $getOverpaymentInfo = $this->getAnnPayment() * $this->creditForMonths - $this->creditSum;
        return $getOverpaymentInfo; 
    }  
    
    
    public function printAllCreditInfo(): void 
    { 
       echo 'Общая сумма кредита: ' .  $this->creditSum . ' рублей' . '<br>';
       echo 'Годовая процентная ставка: ' . $this->annualPercentageRate . ' процентов' . '<br>'; 
       echo 'Срок кредитования: ' . $this->creditForYears . ' лет' . '<br>'; 
       echo 'Ежемесячный платёж: ' . round ($this->getAnnPayment(), 2) . ' рублей' . '<br>'; 
       echo 'Переплата: ' . round ($this->getOverpaymentInfo(), 2) . ' рублей' . '<br>';             
    }
    
    public function printAllCreditInfoHTML(): string 
    { 
        $allCreditInfo =           
            '<p><br> Общая сумма кредита: '. $this->creditSum . ' рублей </p>
            <p>Годовая процентная ставка: ' . $this->annualPercentageRate . ' процентов </p>
            <p>Годовая процентная ставка: ' . $this->annualPercentageRate . ' процентов </p> 
            <p>Срок кредитования: ' . $this->creditForYears . ' лет </p> 
            <p>Ежемесячный платёж: ' . round ($this->getAnnPayment(), 2) .  ' рублей </p> 
            <p>Переплата: ' . round ($this->getOverpaymentInfo(), 2) . ' рублей </p>';  
                    
        return $allCreditInfo;         
    }
}

$credit = new AnnuityPayment($_POST); 
$credit->printAllCreditInfo(); 
echo $credit->getForm(); 

