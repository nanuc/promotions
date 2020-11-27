<?php

namespace Nanuc\Promotions\Http\Livewire;

use Livewire\Component;
use Nanuc\Promotions\Models\PromotionCode;

class RedeemCode extends Component
{
    public $code;

    public $codeIsUnknown;
    public $codeIsAlreadyRedeemed;
    public $codeWasRedeemed;

    public function render()
    {
        return view('promotions::livewire.redeem-code');
    }

    public function redeemCode()
    {
        $this->codeIsUnknown = false;
        $this->codeIsAlreadyRedeemed = false;
        $this->codeWasRedeemed = false;

        $promotionCode = PromotionCode::byCode($this->code);

        if(!$promotionCode) {
            $this->codeIsUnknown = true;
        }
        elseif($promotionCode->isAlreadyRedeemed) {
            $this->codeIsAlreadyRedeemed = true;
        }
        else {
            $this->codeWasRedeemed = true;
            return $promotionCode->redeem();
        }
    }
}
