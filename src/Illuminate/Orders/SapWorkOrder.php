<?php

namespace LumenInnovation\SAP\Illuminate\Orders;


use LumenInnovation\SAP\Facades\SAP;
use LumenInnovation\SAP\Functions\FunctionModule;
use LumenInnovation\SAP\Illuminate\Orders\Traits\InterfacesWithSap;
use LumenInnovation\SAP\Illuminate\Orders\Traits\InterfacesWithWorkOrderDates;

class SapWorkOrder
{
    use InterfacesWithSap;
    use InterfacesWithWorkOrderDates;

    public array $order;

    public array $operations;

    protected FunctionModule $update;

    public function find($order): static
    {
        $this->update = SAP::fm('BAPI_ALM_ORDER_MAINTAIN');

        $this->order = SAP::fm('BAPI_ALM_ORDER_GET_DETAIL')
            ->addParameter('NUMBER', str_pad($order, 12, '0', STR_PAD_LEFT))
            ->invoke();

        return $this;
    }

    public function getOperations()
    {
        return $this->order['ET_OPERATIONS'];
    }

    public function operation($op): SapOperation
    {
        $this->operations[str_pad($op, 4, '0', STR_PAD_LEFT)] = new SapOperation($this, str_pad($op, 4, '0', STR_PAD_LEFT));

        return $this->operations[str_pad($op, 4, '0', STR_PAD_LEFT)];
    }

    public function hasSystemStatus(array|string $status, $all = false)
    {
        $check = collect(array_values(array_filter(explode(' ', $this->order['ES_HEADER']['SYS_STATUS']))));

        if (is_array($status)) {
            return $all ? $check->intersect($status)->count() === sizeof($status) : $check->intersect($status)->count() > 0;
        }

        return $check->contains($status);
    }

    public function hasAllSystemStatuses(array $statuses)
    {
        return $this->hasSystemStatus($statuses, true);
    }

    public function update($key, $value)
    {
        $this->update->addParameter($key, $value);

        return $this;
    }


}
