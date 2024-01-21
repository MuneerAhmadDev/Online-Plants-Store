<?php

class IDGen
{
    public function generateID($id)
    {
        return $id . rand(100000, 999999);
    }
}
