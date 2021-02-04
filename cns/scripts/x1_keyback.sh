#! /bin/bash
clear
read -p "Type any key: " key
clear
if  [test $key -eq [0-9]]; then
 echo "You've typed $key"
elif [test $key -eq [a-z]]; then
 echo "You've type $key"
elif [test $key -eq [A-Z]]; then
 echo "You've type $key"
else
 echo "You must type an alphanumeric character";
fi
