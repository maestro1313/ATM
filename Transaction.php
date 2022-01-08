<?php
$balance = $_POST['balance'];
$deposit = $_POST['deposit'];
$withdrawal = $_POST['withdrawal'];

class Transaction{
    public $balance;
    public $deposit;
    public $withdrawal;
    public $isOverdrawn;
    
    function __construct($balance, $deposit, $withdrawal){
        $this->balance = $balance;
        $this->deposit = $deposit;
        $this->withdrawal = $withdrawal;
    }
    public function convertToInt($balance,$deposit,$withdrawal){
        $this->balance = (int)$balance;
        $this->deposit = (int)$deposit;
        $this->withdrawal = (int)$withdrawal;
    }
    public function get_balance(){
        return $this->balance;
    }
    public function get_deposit(){
        return $this->deposit;
    }
    public function get_withdrawal(){
        return $this->withdrawal;
    }
    public function make_transaction($deposit, $withdrawal){
        if (!empty($deposit) && empty($withdrawal)){
            $this->balance += $this->deposit;
            return '<br>Your balance is '.$this->balance;
        }
        elseif (empty($deposit) && !empty($withdrawal)){
            $this->balance -= $this->withdrawal;
            return '<br>Your balance is '.$this->balance;
            }
        
        elseif (!empty($deposit) && !empty($withdrawal)){
            $this->balance = $this->balance + $this->deposit - $this->withdrawal;
            return '<br>Please make one transaction at a time.'.
            '  Your balance is '.$this->balance;
        }
    }
    public function is_overdrawn($balance){
        if($this->balance < 0){
            $isOverdrawn = true;
            $this->balance -= 35;
            return '<br>Your account is overdrawn.  <br>You will be charged a 
            $35 overdrawn fee.  Your new balance is '.$this->balance. '<br>You will
            now be referred to credit counseling.';
        }
        
    }
    public function print_receipt(){
        return '<br><br>Receipt<br>Your amount deposited: '.$this->deposit.
            '<br>Your withdrawal amount '.$this->withdrawal.
            '<br>Your balance '.$this->balance;
        
    }
    
}



$newDeposit = new Transaction($balance, $deposit, $withdrawal);

$newDeposit->convertToInt($balance, $deposit, $withdrawal);

echo 'Your balance is '.$newDeposit->get_balance();

echo '<br>You deposited '.$newDeposit->get_deposit();

echo '<br>You withdrew '.$newDeposit->get_withdrawal();

echo $newDeposit->make_transaction($deposit, $withdrawal, $balance);

echo $newDeposit->is_overdrawn($balance);

echo $newDeposit->print_receipt();