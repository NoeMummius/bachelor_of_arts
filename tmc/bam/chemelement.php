<?php
class Chemelement
{
    private $Symbol;
    private $Name;
    private $next;
    public function __constuctor()
    {
        $this->Symbol = null;
        $this->Name = null;
        $this->next = null;
    }
    public function setElement($Symbol, $Name)
    {
        $this->Symbol = $Symbol;
        $this->Name = $Name;
    }
    public function setNext($next)
    {
        $this->next = $next;
    }
    public function binSymbol()
    {
        $Symbol = array();
        for($i = 0; $i - 16 < 0; $i++)
        {
            $Symbol[] = 0;
        }
        $offset = 8 * strlen($this->Symbol);
        foreach(str_split($this->Symbol) as $letter)
        {
            $i = 0;
            $Tmp = array();
            $Data = unpack('H*', $letter);
            $Bytes = str_split(base_convert($Data[1], 16, 2));
            while(sizeof($Bytes) + $i - 8 < 0)
            {
                $Tmp[$i] = 0;
                $i++;
            }
            $k = sizeof($Tmp);
            foreach($Bytes as $bit)
            {
                $Tmp[$k] = $bit;
                $k++;
            }
            foreach($Tmp as $bit)
            {
                $Symbol[sizeof($Symbol) - $offset] = $bit;
                $offset--;
            }
        }
        return $Symbol;
    }
    public function binName($len)
    {
        $Name = array();
        for($i = 0; $i - ($len - 1) * 8 < 0; $i++)
        {
            $Name[] = 0;
        }
        $offset = 8 * (strlen($this->Name) - 1);
        foreach(str_split($this->Name) as $letter)
        {
            $i = 0;
            $Tmp = array();
            $Data = unpack('H*', $letter);
            if(hexdec($Data[1]) - 10 == 0)
            {
                break;
            }
            $Bytes = str_split(base_convert($Data[1], 16, 2));
            while(sizeof($Bytes) + $i - 8 < 0)
            {
                $Tmp[$i] = 0;
                $i++;
            }
            $k = sizeof($Tmp);
            foreach($Bytes as $bit)
            {
                $Tmp[$k] = $bit;
                $k++;
            }
            foreach($Tmp as $bit)
            {
                $Name[sizeof($Name) - $offset] = $bit;
                $offset--;
            }
        }
        return $Name;
    }
    function binaryToString($Bits)
    {
        $Bytes = array_chunk($Bits, 8, false);
        //echo implode($Bytes[1]);
        //echo base_convert(implode($Bytes[1]), 2, 16);
        $string = null;
        foreach($Bytes as $byte)
        {
            //echo base_convert(implode($byte), 2, 16).' ';
            $string .= pack('H*', dechex(bindec(implode($byte))));
        }
        return $string;
    }
}
?>