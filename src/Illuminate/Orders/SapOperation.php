<?php

namespace LumenInnovation\SAP\Illuminate\Orders;

class SapOperation
{
    public $op_number;

    protected $order;

    public $operation;

    protected $operation_up;

    protected $methods;

    protected $map = [
        'start_constraint_type' => 'CONSTRAINT_TYPE_START',
        'finish_constraint_type' => 'CONSTRAINT_TYPE_FINISH',
        'start_constraint_date' => 'START_CONS',
        'start_constraint_time' => 'STRTTIMCON',
        'finish_constraint_date' => 'FIN_CONSTR',
        'finish_constraint_time' => 'FINTIMCONS',
    ];


    public function __construct(SapWorkOrder $order, $op)
    {
        $this->order = $order;

        $this->op_number = $op;
    }

    public function update(array $update)
    {
        collect($update)->each(function ($item, $key) {
            $this->operation['ACTIVITY'] = $this->op_number;
            $this->operation[$this->map[$key]] = $item;

            $this->operation_up['ACTIVITY'] = 'X';
            $this->operation_up[$this->map[$key]] = 'X';
        });

        $this->methods = [
            'REFNUMBER' => (string)$this->order->refNum++,
            'OBJECTTYPE' => 'OPERATION',
            'METHOD' => 'CHANGE',
            'OBJECTKEY' => $this->order->order['ES_HEADER']['ORDERID'] . $this->op_number
        ];
    }

    public function getItMethods()
    {
        return $this->methods;
    }

    public function getItOperations()
    {
        return $this->operation;
    }

    public function getItOperationsUp()
    {
        return $this->operation_up;
    }
}
