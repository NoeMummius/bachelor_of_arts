#! /bin/bash
clear
read -n 2 -p 'Type a key: ' key
if ($key -ge [0-9]) then
 echo "You typed: $key"
elif ($key -ge [a-zA-Z]) then
  echo "You typed: $key"
else
 echo "This isn't an alphanumeric character"
fi
