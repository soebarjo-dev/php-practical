<?php

class TransactionController
{
    public function index(){
        return App::transaction()->getAll();
    }

    public function lists($selectedList=''){
        $list = [
            'units' => App::unit()->getAll(),
            'customers' => App::customer()->getAll(),
            'products' => App::product()->getAll(),
        ];

        $output = $list;
        if(!empty($selectedList)){
            $output = [];
            if (isset($list[$selectedList])){
                $output = $list[$selectedList];
            }
        }

        return $output;
    }

    public function store(){}
    public function detail(){}
}