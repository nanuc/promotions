<div>
    @if(!$codeWasRedeemed)
        <form wire:submit.prevent="redeemCode" class="sm:flex">
            <input wire:model="code" aria-label="Code" class="appearance-none w-full px-5 py-3 border border-grey-900 text-base leading-6 rounded-md text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 transition duration-150 ease-in-out sm:max-w-xs" placeholder="{{ __('promotions::promotions.code') }}">
            <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                <button class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:bg-yellow-500 transition duration-150 ease-in-out">
                    {{ __('promotions::promotions.redeem') }}
                </button>
            </div>
        </form>
    @endif
    @if($codeIsUnknown)
        <div class="text-red-700">
            {{ __('promotions::promotions.code-is-not-valid') }}
        </div>
    @endif
    @if($codeIsAlreadyRedeemed)
        <div class="text-red-700">
            {{ __('promotions::promotions.code-is-already-redeemed') }}
        </div>
    @endif
    @if($codeWasRedeemed)
        <div class="text-green-700">
            {{ __('promotions::promotions.code-was-redeemed') }}
        </div>
    @endif
</div>