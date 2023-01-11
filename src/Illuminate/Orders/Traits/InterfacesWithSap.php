<?php

namespace Lumen\SAP\Illuminate\Orders\Traits;

use Lumen\SAP\Facades\SAP;

trait InterfacesWithSap
{
    public int $refNum = 1;

    public function invoke()
    {
        $this->update->addParameter('IT_METHODS',[
            [
                'REFNUMBER' => (string)$this->refNum++,
                'OBJECTTYPE' => 'HEADER',
                'METHOD' => 'CHANGE',
                'OBJECTKEY' => $this->order['ES_HEADER']['ORDERID']
            ],
            [
                'REFNUMBER' => (string)$this->refNum,
                'OBJECTTYPE' => '',
                'METHOD' => 'SAVE',
                'OBJECTKEY' => $this->order['ES_HEADER']['ORDERID']
            ]
        ]);

        $this->update->setParameter('IT_HEADER', 'ORDERID', $this->order['ES_HEADER']['ORDERID'], false);

        $call =  $this->update->invoke();

        $commit = SAP::fm('BAPI_TRANSACTION_COMMIT')->invoke();

        return [
            'call' => $call,
            'commit' => $commit
        ];
    }
}
