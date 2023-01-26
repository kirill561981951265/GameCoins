<?php

class Player{
    public $Name;
    public $CountCoins;

    public function __construct($Name,$CountCoins)
    {
        $this->Name=$Name;
        $this->CountCoins=$CountCoins;
    }
public function point(Player $player){
$this->CountCoins++;
$player->CountCoins--;
}
    function lose(){
        return $this->CountCoins<=0;
    }
    function chanswins(Player $player){
        return $this->CountCoins/($this->CountCoins+$player->CountCoins)*100;
    }
}
class Game {
    protected $player1;
    protected  $player2;
    public $flips=0;
    public function __construct(Player $player1,Player $player2)
    {
        $this->player1=$player1;
        $this->player2=$player2;
    }
    function flip(){
        return  rand(0, 1) ? "орёл" : "решка";
    }

    function play(){


        echo <<<EOT
игра началась </br>
шансы выиграть {$this->player1->Name}:{$this->player1->chanswins($this->player2)};</br>
шансы выиграть{$this->player2->Name}:{$this->player2->chanswins($this->player1)};
EOT;

$this->start();
    }


    function start()
    {

        while (true) {

            if($this->player1->lose() || $this->player2->lose()){
                return $this->end();
            }
            if ( $this->flip() == "орёл") {

                $this->player1->point( $this->player2);

            } else {
                $this->player2->point( $this->player1);
            }

            $this->flips++;

        }
    }
    function winner(){
        if($this->player2->CountCoins==0){
            return $this->player1;
        }else{
           return $this->player2;
        }
    }
    public function end(){
        echo <<<EOT
Игра окончена.</br>
{$this->player1->Name}:{$this->player1->CountCoins}</br>
{$this->player2->Name}:{$this->player2->CountCoins}</br>
Выйграл:{$this->winner()->Name}</br>
Колличество подбрасываний :{$this->flips}</br>

EOT;
    }
}


$game=new Game(new Player("Kir",100),new Player("Gleb",1) );
$game->play();