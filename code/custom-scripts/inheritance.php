<?php 

class A
{

    public function __construct()
    {
        echo 'A constructor';
    }

    public function __destruct()
    {
        echo 'A destructor';
    }
}

class B extends A
{
    public function __construct()
    {
        echo 'B constructor';
    }

    public function __destruct()
    {
        echo 'B destructor';
        #parent::__destruct();
    }
}

class C extends B
{
    public function __construct()
    {
        echo 'C constructor';
    }

    public function __destruct()
    {
        echo 'C destructor';
        #parent::__destruct();
    }
}

$objC = new C();
