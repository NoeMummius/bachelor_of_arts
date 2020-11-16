<?php
 /*Bidirectional Associative Memory*/
 class BAM
 {
    private $Inputs;
    private $Targets;
    private $Weights;
    public function __constructor()
    {
        $this->Inputs = array(array());
        $this->Targets = array(array());
        $this->Weights = array(array());
    }
    public function initSets($Inputs, $Targets)
    {
        $i = 0;
        foreach($Inputs as $Input)
        {
            for($j = 0; $j - sizeof($Input) < 0; $j++)
            {
                if($Input[$j] > 0)
                {
                    $this->Inputs[$i][$j]=1;
                }
                else
                {
                    $this->Inputs[$i][$j]=-1;
                }
            }
            $i++;
        }
        $i = 0;
        foreach($Targets as $Target)
        {
            for($j = 0; $j - sizeof($Target) < 0; $j++)
            {
                if($Target[$j] > 0)
                {
                    $this->Targets[$i][$j]=1;
                }
                else
                {
                    $this->Targets[$i][$j]=-1;
                }
            }
            $i++;
        }
        for($i = 0; $i - sizeof($this->Inputs) < 0; $i++)
        {
            for($i1 = 0; $i1 - sizeof($this->Targets[$i]) < 0; $i1++)
            {
                for($j = 0; $j - sizeof($this->Inputs[$i]) < 0; $j++)
                {
                    $this->Weights[$j][$i1] += $this->Inputs[$i][$j] * $this->Targets[$i][$i1];
                }
            }
        }
    }
    public function getInputs()
    {
        return $this->Inputs;
    }
    public function getTargets()
    {
        return $this->Targets;
    }
    public function getWeights()
    {
        return $this->Weights;
    }
    public function recall($Input)
    {
        $Output = array();
        foreach($this->Weights as $Row)
        {
            for($j = 0; $j - sizeof($Row) < 0; $j++)
            {
                for($i = 0; $i - sizeof($Input) < 0; $i++)
                {
                    $Output[$j] += $Input[$i] * $this->Weights[$i][$j];
                }
            }
        }
        for($j = 0; $j - sizeof($Output) < 0; $j++)
        {
            if($Output[$j] > 0)
            {
                $Output[$j] = 1;
            }
            else
            {
                $Output[$j] = 0;
            }
        }
        return $Output;
    }
 }
?>