<?php
class User
{
    public function showMessage()
    {
        echo "Hello";
    }
}

class Administrator extends User
{
}

$person = new Administrator();

echo $person->showMessage();