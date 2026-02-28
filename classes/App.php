<?php

class App
{
    public static function auth(){
        return new Auth();
    }

    public static function customer(){
        return new Customer();
    }

    public static function product(){
        return new Product();
    }

    public static function report(){
        return new Report();
    }

    public static function transaction(){
        return new Transaction();
    }

    public static function unit(){
        return new Unit();
    }

    public static function user(){
        return new User();
    }
}