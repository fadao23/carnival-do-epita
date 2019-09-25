<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class PaperPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class Fadao23Player extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;
    protected $bar;
    protected $numbers_uses; // [rock, scissors, paper]

    function __construct() {
      $this->bar = array("rock");
      $this->numbers_uses = array(0, 0, 0);
    }

    public function calcul_proba(){
      $tmp = 0;
      $index = 0;
      foreach ($this->numbers_uses as $value){
        if ($value > $tmp) {
          $tmp = $value;
          $index++;
        }
      }
      
      if ($index == 0)
        return parent::rockChoice();
      if ($index == 1)
        return parent::scissorsChoice();
      if ($index == 2)
        return parent::paperChoice();
    } 

    public function fill_array_numbers(){
      if ( $this->result->getLastChoiceFor($this->opponentSide) == "scissors"){
        $this->numbers_uses[1] = $this->numbers_uses[1] + 1;
      }
      if ( $this->result->getLastChoiceFor($this->opponentSide) == "rock"){
        $this->numbers_uses[0] = $this->numbers_uses[0] + 1;
      }
      if ( $this->result->getLastChoiceFor($this->opponentSide) == "paper"){
        $this->numbers_uses[2] = $this->numbers_uses[2] + 1;
      }
    }

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
       // How to get my Last Score            ?     $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        //echo $this->result->getLastChoiceFor($this->opponentSide);
        //array_push($this->bar, $this->result->getLastChoiceFor($this->opponentSide));
        //array_push($this->bar, $this->result->getLastChoiceFor($this->opponentSide) );
        self::fill_array_numbers();
        //print_r($this->numbers_uses);
        return self::calcul_proba();
       // return parent::paperChoice();            
  }
};
