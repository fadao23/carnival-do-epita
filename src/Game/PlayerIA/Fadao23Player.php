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
      $this->bar = array(0 => 'rock', 1 => 'scissors', 2 => 'paper');
      $this->numbers_uses = array(0, 0, 0);
    }

    public function calcul_proba(){

      /*
      
        The first Round rock is default
        Until the 100th round :
          The algorithm counts the previous moves of the opponent to determine if the opponent prefers playing one type of move over the others.
        After the 100th round :
          I tryed to know how much times the 'scissors', 'rock', 'paper' has been played and I play the opponent to win
      */

      if ($this->result->getNbRound() == 0)
        return parent::rockChoice();
      else if ($this->result->getNbRound() > 100)
      {
        if (($this->result->getStatsFor($this->opponentSide)['scissors'] / $this->numbers_uses[1]) > 0.5){
          return parent::rockChoice();
        }
        if (($this->result->getStatsFor($this->opponentSide)['rock'] / $this->numbers_uses[0]) > 0.5){
          return parent::paperChoice();
        }
        if (($this->result->getStatsFor($this->opponentSide)['paper'] / $this->numbers_uses[2]) > 0.5){
          return parent::scissorsChoice();
        }
      } 

      if ($this->numbers_uses[0] > $this->numbers_uses[2] && $this->numbers_uses[0] > $this->numbers_uses[1])
      {
        return parent::paperChoice();
      } elseif ($this->numbers_uses[2] > $this->numbers_uses[1] ) {
        return parent::scissorsChoice();
      } else {
        return parent::rockChoice();
      }

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
