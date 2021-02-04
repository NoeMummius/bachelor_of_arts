#! /bin/bash
clear
echo "What is your favourite OS?"
echo "1) GNU/Linux"
echo "2) GNU/Hurd"
echo "3) Free BSD"
echo "4) Others"
read answer
case $answer in
1) echo "You've chosen GNU/Linux";;
2) echo "You've chosen GNU/Hurd";;
3) echo "You've chosen Free BSD";;
4) echo "You've chosen another";;
*) echo "You must enter an integer from 1 to 4";;
esac
